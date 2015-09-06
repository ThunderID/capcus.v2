<?php 

namespace App\Http\Controllers\Admin;

use Auth, Input, \Illuminate\Support\MessageBag, Validator, Exception, App;

class TravelAgentController extends Controller {

	use Traits\RequireImagesTrait;

	protected $model;
	protected $view_name = 'travel_agents';
	protected $route_name = 'travel_agents';

	public function __construct(\App\TravelAgent $model)
	{
		parent::__construct();

		$this->model = $model;

		$this->layout->view_name = $this->view_name;
		$this->layout->route_name = $this->route_name;
		$this->page_base_dir .= $this->view_name . '.';

		$this->required_images = [
									'SmallLogo'	=> 'Small Logo (200x150) - transparent background',
									'LargeLogo'	=> 'Large Logo (400x300) - transparent background',
		];
		
		$this->layout->content_title = "Travel Agents";

	}

	public function getIndex()
	{
		// ------------------------------------------------------------------------------------------------------------
		// FILTERS
		// ------------------------------------------------------------------------------------------------------------
		$filters['name'] = Input::get('filter_travel_agent_name');

		// ------------------------------------------------------------------------------------------------------------
		// QUERY
		// ------------------------------------------------------------------------------------------------------------
		$travel_agents = $this->model->NameLike('*' . str_replace(' ', '*', $filters['name']) . '*')->orderBy('name')->paginate(30);

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'index')->with('route_name', $this->route_name)->with('view_name', $this->view_name);
		$this->layout->page->filters 		= $filters;
		$this->layout->page->travel_agents	= $travel_agents;

		return $this->layout;
	}

	public function getCreate($data = null)
	{
		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'create')->with('route_name', $this->route_name)->with('view_name', $this->view_name);
		$this->layout->page->data 			= $data;
		$this->layout->page->required_images= $this->required_images;

		return $this->layout;
	}

	public function postStore($id = null)
	{
		// ---------------------------------------- HANDLE REQUEST ----------------------------------------
		// handle id
		if (!is_null($id))
		{
			$data = $this->model->findorfail($id);
		}
		else
		{
			$data = $this->model->newInstance();
		}

		// ---------------------------------------- HANDLE SAVE ----------------------------------------
		$input = Input::all();
		$data->fill($input);

		if ($data->save())
		{
			if (!$this->save_required_images($data, $input))
			{
				return redirect()->back()->withInput()->withErrors($data->getErrors());
			}
			return redirect()->route('admin.'.$this->view_name.'.show', ['id' => $data->id])->with('alert_success', '"' . $data->{$data->getNameField()} . '" has been saved successfully');
		}
		else
		{
			return redirect()->back()->withInput()->withErrors($data->getErrors());
		}
	}

	public function getShow($id, $mode = '')
	{
		$data = $this->model->findorfail($id);

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'show')->with('route_name', $this->route_name)->with('view_name', $this->view_name);
		$this->layout->page->data 			= $data;

		return $this->layout;
	}

	public function getEdit($id)
	{
		// ---------------------------------------- HANDLE REQUEST ----------------------------------------
		$data = $this->model->findorfail($id);

		return $this->getCreate($data);
	}

	public function getDelete($id)
	{
		// ---------------------------------------- HANDLE REQUEST ----------------------------------------
		$data = $this->model->findorfail($id);

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'delete')->with('route_name', $this->route_name)->with('view_name', $this->view_name);
		$this->layout->page->data 			= $data;

		return $this->layout;
	}


	public function postDelete($id)
	{
		// ---------------------------------------- HANDLE REQUEST ----------------------------------------
		// handle id
		$data = $this->model->findorfail($id);

		// ---------------------------------------- PREPARE VIEW ----------------------------------------
		if (!$data->delete())
		{
			return redirect()->back()->withErrors($data->getErrors());
		}
		else
		{
			return redirect()->route('admin.' . $this->view_name . '.index')->with('alert_success', '"' .$data->{$data->getNameField()}. '" has been deleted successfully' );
		}
	}

	// ------------------------------------------------------------------------------------------------------------------------ 
	// SCHEDULES
	// ------------------------------------------------------------------------------------------------------------------------ 
	public function getPackage($travel_agent_id, $package_id = null)
	{
		$data = $this->model->findorfail($travel_agent_id);

		// ------------------------------------------------------------------------------------------------------------
		// Current Package
		// ------------------------------------------------------------------------------------------------------------
		if ($package_id)
		{
			$package = \App\PackageTravelAgent::find($package_id);
			if (!$package || $package->travel_agent_id != $travel_agent_id)
			{
				App::abort(404);
			}
		}

		// ------------------------------------------------------------------------------------------------------------
		// Package list
		// ------------------------------------------------------------------------------------------------------------
		$package_list = \App\Package::orderBy('priority', 'desc')->get();

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'package')->with('route_name', $this->route_name)->with('view_name', $this->view_name);
		$this->layout->page->data 			= $data;
		$this->layout->page->package_list 	= $package_list;
		$this->layout->page->package 		= $package;	

		return $this->layout;		
	}

	public function postPackage($travel_agent_id, $package_id = null)
	{
		$travel_agent = $this->model->findorfail($travel_agent_id);
		if ($package_id)
		{
			$package = \App\PackageTravelAgent::find($package_id);
			if (!$package || $package->travel_agent_id != $travel_agent_id)
			{
				return App::abort(404);
			}
		}
		else
		{
			$package = new \App\PackageTravelAgent;
		}

		$input = Input::all();
		if ($input['active_since'])
		{
			$input['active_since'] = \Carbon\Carbon::createFromFormat('d/m/Y', $input['active_since']);
		}

		if ($input['active_until'])
		{
			$input['active_until'] = \Carbon\Carbon::createFromFormat('d/m/Y', $input['active_until']);
		}
		$input['travel_agent_id'] = $travel_agent_id;
		$input['package_id'] = $input['package'];
		$package->fill($input);

		// schedule
		if ($package->save())
		{
			$success_message = 'Package: ' . $package->name . ' has been added succesfully to ' . $travel_agent->name;
			return redirect()->route('admin.'.$this->route_name.'.package', ['tour_id' => $travel_agent_id])->with('alert_success', $success_message) ;
		}
		else
		{
			return redirect()->back()->withInput()->withErrors($package->getErrors());
		}

		return $this->layout;		
	}

	public function getDeleteSchedule($travel_agent_id, $schedule_id)
	{
		$tour = $this->model->findorfail($travel_agent_id);
		if ($schedule_id)
		{
			$schedule = $this->schedule_model->findorfail($schedule_id);

			if ($schedule->tour_id != $travel_agent_id)
			{
				App::abort(404);
			}
		}

		if (!$schedule->delete())
		{
			return redirect()->back()->withErrors($schedule->getErrors());
		}
		else
		{
			return redirect()->route('admin.'.$this->route_name.'.schedules', ['tour_id' => $travel_agent_id])->with('alert_success', '"Schedule ' .$schedule->departure->format('d-m-Y') . '- has been deleted successfully') ;
		}
	}
}