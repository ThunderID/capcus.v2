<?php namespace App\Http\Controllers\Admin;

use Auth, Input, \Illuminate\Support\MessageBag, Validator, Exception, App;

class TourController extends Controller {

	use Traits\RequireImagesTrait;

	protected $model;
	protected $schedule_model;
	protected $view_name = 'tours';
	protected $route_name = 'tours';

	public function __construct(\App\Tour $model, \App\TourSchedule $schedule_model)
	{
		parent::__construct();

		$this->model = $model;
		$this->schedule_model = $schedule_model;

		$this->layout->view_name = $this->view_name;
		$this->layout->route_name = $this->route_name;
		$this->page_base_dir .= $this->view_name . '.';

		$this->required_images = [ 
			'SmallThumbnail'		=> 'Small Thumbnail',
			'LargeThumbnail'		=> 'Large Thumbnail',
		];
		
		$this->layout->content_title = strtoupper($this->view_name);
	}

	public function getIndex()
	{
		// ------------------------------------------------------------------------------------------------------------
		// FILTERS
		// ------------------------------------------------------------------------------------------------------------
		$filters['name'] 			= Input::get('filter_tour_name');
		$filters['travel_agent'] 	= Input::get('filter_tour_travel_agent');

		// ------------------------------------------------------------------------------------------------------------
		// QUERY DATA
		// ------------------------------------------------------------------------------------------------------------
		$tours = $this->model->NameLike('*' . str_replace(' ', '*', $filters['name']) . '*')->TravelAgentByIds($filters['travel_agent'])->latest()->paginate(30);

		// ------------------------------------------------------------------------------------------------------------
		// QUERY TRAVEL AGENTS
		// ------------------------------------------------------------------------------------------------------------
		$travel_agents = \App\TravelAgent::orderBy('name')->get();
		$filters['travel_agent_name']	= $travel_agents->find($filters['travel_agent'])->name;

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'index')->with('route_name', $this->route_name)->with('view_name', $this->view_name);
		$this->layout->page->filters 		= $filters;
		$this->layout->page->tours 			= $tours;
		$this->layout->page->travel_agents 	= $travel_agents;

		return $this->layout;
	}

	public function getCreate($data = null)
	{
		// ------------------------------------------------------------------------------------------------------------
		// GET TRAVEL AGENTS
		// ------------------------------------------------------------------------------------------------------------
		$travel_agents = \App\TravelAgent::orderBy('name')->get();

		// ------------------------------------------------------------------------------------------------------------
		// GET DESTINATIONS
		// ------------------------------------------------------------------------------------------------------------
		$destinations = \App\Destination::orderBy('path')->get();

		// ------------------------------------------------------------------------------------------------------------
		// GET PLACES
		// ------------------------------------------------------------------------------------------------------------
		$places = \App\Place::orderBy('long_name')->get();

		// ------------------------------------------------------------------------------------------------------------
		// GET TOUR OPTIONS
		// ------------------------------------------------------------------------------------------------------------
		$tour_options = \App\TourOption::orderBy('name')->get();


		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'create')->with('route_name', $this->route_name)->with('view_name', $this->view_name);
		$this->layout->page->data 			= $data;
		$this->layout->page->travel_agents 	= $travel_agents;
		$this->layout->page->destinations 	= $destinations;
		$this->layout->page->places 		= $places;	
		$this->layout->page->tour_options 	= $tour_options;
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

		// tour travel agent
		$input['travel_agent_id'] 	= $input['travel_agent'];

		// tour destinations
		$input['destination_ids'] 	= $input['destinations'];

		// tour places
		$input['place_ids'] 		= $input['places'];

		// tour options
		foreach ($input['tour_options'] as $x)
		{
			$input['option_ids'][$x] = ['description' => $input['tour_options_description_' . $x]];
		}

		// published_at
		if ($input['published_at'])
		{
			$input['published_at'] = \Carbon\Carbon::createFromFormat('d/m/Y H:i', $input['published_at'])->format('Y-m-d H:i:s');
		}
		else
		{
			$input['published_at'] = null;
		}
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
	public function getSchedules($tour_id, $schedule_id = null)
	{
		$data = $this->model->findorfail($tour_id);

		if ($schedule_id)
		{
			$schedule = $data->schedules->find($schedule_id);
			if ($schedule->tour_id != $tour_id)
			{
				App::abort(404);
			}
		}

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'schedules')->with('route_name', $this->route_name)->with('view_name', $this->view_name);
		$this->layout->page->data 			= $data;
		$this->layout->page->schedule 		= $schedule;

		return $this->layout;		
	}

	public function postSchedules($tour_id, $schedule_id = null)
	{
		$tour = $this->model->findorfail($tour_id);
		if ($schedule_id)
		{
			$schedule = $this->schedule_model->findorfail($schedule_id);

			if ($schedule->tour_id != $tour_id)
			{
				App::abort(404);
			}
		}
		else
		{
			$schedule = $this->schedule_model->newInstance();
		}

		$input = Input::all();
		if ($input['departure'])
		{
			$input['departure'] = \Carbon\Carbon::createFromFormat('d/m/Y', $input['departure']);
		}

		if ($input['departure_until'])
		{
			$input['departure_until'] = \Carbon\Carbon::createFromFormat('d/m/Y', $input['departure_until']);
		}
		$input['tour_id'] = $tour_id;

		// schedule
		$schedule->fill($input);

		if ($schedule->save())
		{
			if ($schedule_id)
			{
				$success_message = 'Schedule has been updated: ' . $schedule->departure->format('d/m/Y') . ' - ' . $schedule->arrival->format('d/m/Y');
			}
			else
			{
				$success_message = 'Schedule has been added: ' . $schedule->departure->format('d/m/Y') . ' - ' . $schedule->arrival->format('d/m/Y');
			}
			return redirect()->route('admin.'.$this->route_name.'.schedules', ['tour_id' => $tour_id])->with('alert_success', $success_message) ;
		}
		else
		{
			return redirect()->back()->withInput()->withErrors($schedule->errors);
		}

		return $this->layout;		
	}

	public function getDeleteSchedule($tour_id, $schedule_id)
	{
		$tour = $this->model->findorfail($tour_id);
		if ($schedule_id)
		{
			$schedule = $this->schedule_model->findorfail($schedule_id);

			if ($schedule->tour_id != $tour_id)
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
			return redirect()->route('admin.'.$this->route_name.'.schedules', ['tour_id' => $tour_id])->with('alert_success', '"Schedule ' .$schedule->departure->format('d-m-Y') . '-'. $schedule->arrival->format('d-m-Y') . '" has been deleted successfully') ;
		}
	}
}