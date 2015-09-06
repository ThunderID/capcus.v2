<?php namespace App\Http\Controllers\Admin;

use Auth, Input, \Illuminate\Support\MessageBag, Validator, Exception, App;
use \App\Headline;
use \App\Setting;
use \App\HomegridSetting;

class SettingHomeController extends Controller {

	use Traits\RequireImagesTrait;

	protected $model;
	protected $view_name = 'settings.home';
	protected $route_name = 'settings.home';

	public function __construct(\App\Headline $headline_model, \App\Setting $setting_model)
	{
		parent::__construct();

		$this->headline_model = $headline_model;
		$this->setting_model = $setting_model;

		$this->layout->view_name = $this->view_name;
		$this->layout->route_name = $this->route_name;
		$this->page_base_dir .= $this->view_name . '.';


		// HOMEGRID INIT
		foreach (HomegridSetting::getType() as $x)
		{
			$this->homegrid_types[$x] = ucwords(str_replace('_', ' ', $x));
		}
		
		$this->layout->content_title = "HOMEPAGE";
	}

	public function index()
	{
		// ------------------------------------------------------------------------------------------------------------
		// HEADLINE
		// ------------------------------------------------------------------------------------------------------------
		$current_headlines = Headline::ActiveOn(\Carbon\Carbon::now())->orderBy('priority')->get();

		// ------------------------------------------------------------------------------------------------------------
		// HOMEGRID
		// ------------------------------------------------------------------------------------------------------------
		$homegrids = HomegridSetting::orderBy('name')->get();

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'index')->with('route_name', $this->route_name)->with('view_name', $this->view_name);
		$this->layout->page->current_headlines = $current_headlines;
		$this->layout->page->homegrids 		= $homegrids;
		$this->layout->page->writer_list 	= $writer_list;
		$this->layout->page->status_list 	= $status_list;
		$this->layout->page->filters 		= $filters;

		return $this->layout;
	}

	// ------------------------------------------------------------------------------------------------------------
	// HEADLINES
	// ------------------------------------------------------------------------------------------------------------
	public function HeadlineIndex()
	{
		// ------------------------------------------------------------------------------------------------------------
		// FILTER
		// ------------------------------------------------------------------------------------------------------------
		$filters = Input::only('filter_headline_month', 'filter_headline_year');
		$filters['filter_headline_year'] = $filters['filter_headline_year'] ? $filters['filter_headline_year'] : date('Y')*1;
		$filters['filter_headline_month'] = $filters['filter_headline_month'] ? $filters['filter_headline_month'] : date('m')*1;

		$filters['filter_headline_since'] = \Carbon\Carbon::createFromDate($filters['filter_headline_year'], $filters['filter_headline_month'], 1);
		$filters['filter_headline_until'] = \Carbon\Carbon::createFromDate($filters['filter_headline_year'], $filters['filter_headline_month'], 1)->endofmonth();

		$data = Headline::ActiveBetween($filters['filter_headline_since']->startOfDay(), $filters['filter_headline_until']->endofday())->orderBy('priority')->latest()->get();

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . '.headlines.index')->with('route_name', $this->route_name)->with('view_name', $this->view_name);
		$this->layout->page->data 			= $data;
		$this->layout->page->writer_list 	= $writer_list;
		$this->layout->page->status_list 	= $status_list;
		$this->layout->page->filters 		= $filters;

		return $this->layout;
	}

	public function HeadlineCreate($data = null)
	{
		$this->required_images = [
									'LargeImage'	=> 'Large Image (1524x896 - center image 1524x600)',
								];
		// ------------------------------------------------------------------------------------------------------------
		// DESTINATIONS
		// ------------------------------------------------------------------------------------------------------------
		$travel_agents = \App\TravelAgent::orderBy('name')->get();

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'headlines.create')->with('route_name', $this->route_name)->with('view_name', $this->view_name);
		$this->layout->page->data			= $data;
		$this->layout->page->travel_agents	= $travel_agents;
		$this->layout->page->required_images= $this->required_images;
		$this->layout->page->destinations	= $destinations;

		return $this->layout;
	}

	public function HeadlineStore($id = null)
	{
		$this->required_images = [
								'LargeImage'	=> 'Large Image (400x400)',
							];
		// ---------------------------------------- HANDLE REQUEST ----------------------------------------
		// handle id
		if (!is_null($id))
		{
			$data = $this->headline_model->find($id);
		}
		else
		{
			$data = $this->headline_model->newInstance();
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

			return redirect()->route('admin.'.$this->route_name.'.index', ['id' => $data->id])->with('alert_success', '"' . $data->title . '" has been saved successfully');
		}
		else
		{
			return redirect()->back()->withInput()->withErrors($data->getErrors());
		}
	}

	public function HeadlineShow($id)
	{
		$data = $this->headline_model->findorfail($id);

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'headlines.show')->with('route_name', $this->route_name)->with('view_name', $this->view_name);
		$this->layout->page->data			= $data;
		
		return $this->layout;		
	}

	public function HeadlineEdit($id)
	{
		// ---------------------------------------- HANDLE REQUEST ----------------------------------------
		$data = $this->headline_model->findorfail($id);

		return $this->HeadlineCreate($data);
	}

	public function HeadlineDelete($id)
	{
		// ---------------------------------------- HANDLE REQUEST ----------------------------------------
		$data = $this->headline_model->findorfail($id);

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'headlines.delete')->with('route_name', $this->route_name)->with('view_name', $this->view_name);
		$this->layout->page->data			= $data;

		return $this->layout;		
	}


	public function HeadlinePostDelete($id)
	{
		// ---------------------------------------- HANDLE REQUEST ----------------------------------------
		// handle id
		$data = $this->headline_model->findorfail($id);

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

	// ------------------------------------------------------------------------------------------------------------
	// HOME GRID
	// ------------------------------------------------------------------------------------------------------------
	public function HomegridsEdit($homegrid_no)
	{
		// ------------------------------------------------------------------------------------------------------------
		// EDIT HOME GRID
		// ------------------------------------------------------------------------------------------------------------
		if (!$homegrid_no || !is_numeric($homegrid_no)|| $homegrid_no < 1 || $homegrid_no > 12)
		{
			return App::abort(404);
		}

		// ------------------------------------------------------------------------------------------------------------
		// LOAD HOMEGRID
		// ------------------------------------------------------------------------------------------------------------
		$homegrid = HomegridSetting::homegrid($homegrid_no)->first();
		if (!$homegrid)
		{
			$homegrid = new HomegridSetting(['name' => 'homegrid_' . $homegrid_no, 'since' => \Carbon\Carbon::now()]);
		}
		// ------------------------------------------------------------------------------------------------------------
		// Destination List
		// ------------------------------------------------------------------------------------------------------------
		$destination_list = \App\Destination::orderBy('path')->get()->lists('path', 'id')->toArray();

		// ------------------------------------------------------------------------------------------------------------
		// TAG List
		// ------------------------------------------------------------------------------------------------------------
		$tag_list = \App\Tag::Has('tours')->orderBy('tag')->get()->lists('tag', 'id')->toArray();

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'homegrids.create')->with('route_name', $this->route_name)->with('view_name', $this->view_name);
		$this->layout->page->homegrid 		= $homegrid;
		$this->layout->page->homegrid_no 	= $homegrid_no;
		$this->layout->page->homegrid_types = $this->homegrid_types;
		$this->layout->page->destination_list = $destination_list;
		$this->layout->page->tag_list 		= $tag_list;

		return $this->layout;

	}

	public function HomegridsStore($homegrid_no)
	{
		// ------------------------------------------------------------------------------------------------------------
		// EDIT HOME GRID
		// ------------------------------------------------------------------------------------------------------------
		if (!$homegrid_no || !is_numeric($homegrid_no)|| $homegrid_no < 1 || $homegrid_no > 12)
		{
			return App::abort(404);
		}

		// ------------------------------------------------------------------------------------------------------------
		// LOAD HOMEGRID
		// ------------------------------------------------------------------------------------------------------------
		$homegrid = HomegridSetting::homegrid($homegrid_no)->first();
		if (!$homegrid)
		{
			$homegrid = new HomegridSetting(['name' => 'homegrid_' . $homegrid_no, 'since' => \Carbon\Carbon::now()]);
		}

		// ------------------------------------------------------------------------------------------------------------
		// PROCESS INPUT
		// ------------------------------------------------------------------------------------------------------------
		$rules['type']		= ['required', 'in:' . implode(',', \App\HomegridSetting::getType())];
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails())
		{
			return redirect()->back()->withInput()->withErrors($validator);
		}
		else
		{
			$homegrid->type 			= Input::get('type');
			$homegrid->title 			= Input::get('title');
			$homegrid->destination 		= '';
			$homegrid->image_url 		= '';
			$homegrid->script 			= '';
			$homegrid->tag 				= '';
			$homegrid->is_featured 		= Input::get('featured');

			switch (Input::get('type'))
			{

				case 'destination' : case 'featured_destination' : 
					$homegrid->destination 		= Input::get('destination');
					$homegrid->image_url 		= Input::get('image_url');
					break;
				case 'tour_tags':
					$homegrid->tag 		= Input::get('tag');
					$homegrid->image_url 		= Input::get('image_url');
				case 'script' :
					$homegrid->script 		= Input::get('script');
					break;
			}

			if (!$homegrid->save())
			{
				return redirect()->back()->withInput()->withErrors($homegrid->getErrors());
			}
			else
			{
				return redirect()->route('admin.'.$this->route_name.'.index', ['id' => $data->id])->with('alert_success', '"Grid #'.$homegrid_no.'" has been saved successfully');
			}
		}

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'homegrids.create')->with('route_name', $this->route_name)->with('view_name', $this->view_name);
		$this->layout->page->homegrid 		= $homegrid;

		return $this->layout;

	}

}