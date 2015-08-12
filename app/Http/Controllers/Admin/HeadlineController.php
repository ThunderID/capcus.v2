<?php namespace App\Http\Controllers\Admin;

use Auth, Input, \Illuminate\Support\MessageBag, Validator, Exception, App;
use \App\Headline;
use \App\Article;
use \App\User;

class HeadlineController extends Controller {

	use Traits\RequireImagesTrait;

	protected $model;
	protected $view_name = 'headlines';
	protected $route_name = 'headlines';

	public function __construct(\App\Headline $model)
	{
		parent::__construct();

		$this->model = $model;
		$this->user_model = $user_model;

		$this->layout->view_name = $this->view_name;
		$this->layout->route_name = $this->route_name;
		$this->page_base_dir .= $this->view_name . '.';

		$this->required_images = [
									'SmallImage' 	=> 'Small Image',
									'MediumImage'	=> 'Medium Image',
									'LargeImage'	=> 'Large Image',
								];
		
		$this->layout->content_title = strtoupper($this->view_name);
	}

	public function getIndex()
	{
		// ------------------------------------------------------------------------------------------------------------
		// FILTER
		// ------------------------------------------------------------------------------------------------------------
		$filters = Input::only('filter_headline_month', 'filter_headline_year');
		$filters['filter_headline_year'] = $filters['filter_headline_year'] ? $filters['filter_headline_year'] : date('Y')*1;
		$filters['filter_headline_month'] = $filters['filter_headline_month'] ? $filters['filter_headline_month'] : date('m')*1;

		$filters['filter_headline_since'] = \Carbon\Carbon::createFromDate($filters['filter_headline_year'], $filters['filter_headline_month'], 1);
		$filters['filter_headline_until'] = \Carbon\Carbon::createFromDate($filters['filter_headline_year'], $filters['filter_headline_month'], 1)->endofmonth();

		$data = Headline::ActiveBetween($filters['filter_headline_since'], $filters['filter_headline_until'])->get();

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'index')->with('route_name', $this->route_name)->with('view_name', $this->view_name);
		$this->layout->page->data 			= $data;
		$this->layout->page->writer_list 	= $writer_list;
		$this->layout->page->status_list 	= $status_list;
		$this->layout->page->filters 		= $filters;

		return $this->layout;
	}

	public function getCreate($data = null)
	{
		// ------------------------------------------------------------------------------------------------------------
		// DESTINATIONS
		// ------------------------------------------------------------------------------------------------------------
		$travel_agents = \App\TravelAgent::orderBy('name')->get();

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'create')->with('route_name', $this->route_name)->with('view_name', $this->view_name);
		$this->layout->page->data			= $data;
		$this->layout->page->travel_agents	= $travel_agents;
		$this->layout->page->required_images= $this->required_images;
		$this->layout->page->destinations	= $destinations;

		return $this->layout;
	}

	public function postStore($id = null)
	{
		// ---------------------------------------- HANDLE REQUEST ----------------------------------------
		// handle id
		if (!is_null($id))
		{
			$data = $this->model->find($id);
		}
		else
		{
			$data = $this->model->newInstance();
		}

		// ---------------------------------------- HANDLE SAVE ----------------------------------------
		$input = Input::all();
		try {
			$input['priority'] = $input['priority'] + 1;
			if (!$input['active_since'])
			{
				unset($input['active_since']);
			}
			else
			{
				$input['active_since'] = \Carbon\Carbon::createFromFormat('d/m/Y H:i', $input['active_since'])->format('Y-m-d H:i:s');
			}

			if (!$input['active_until'])
			{
				unset($input['active_until']);
			}
			else
			{
				$input['active_until'] = \Carbon\Carbon::createFromFormat('d/m/Y H:i', $input['active_until'])->format('Y-m-d H:i:s');
			}

		} catch (Exception $e) {
			
		}
		$data->fill($input);

		if ($data->save())
		{
			if (!$this->save_required_images($data, $input))
			{
				return redirect()->back()->withInput()->withErrors($data->getErrors());
			}

			return redirect()->route('admin.'.$this->view_name.'.show', ['id' => $data->id])->with('alert_success', '"' . $data->title . '" has been saved successfully');
		}
		else
		{
			return redirect()->back()->withInput()->withErrors($data->getErrors());
		}
	}

	public function getShow($id)
	{
		$data = $this->model->findorfail($id);

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'show')->with('route_name', $this->route_name)->with('view_name', $this->view_name);
		$this->layout->page->data			= $data;
		
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
		$this->layout->page->data			= $data;

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
			return redirect()->route('admin.' . $this->view_name . '.index')->with('alert_success', '"' .$data->title. '" has been deleted successfully' );
		}
	}
}