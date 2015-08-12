<?php 

namespace App\Http\Controllers\Admin;

use Auth, Input, \Illuminate\Support\MessageBag, Validator, Exception, App;
use \App\Place;

class PlaceController extends Controller {

	use Traits\RequireImagesTrait;

	protected $model;
	protected $view_name = 'places';
	protected $route_name = 'places';

	public function __construct(\App\Place $model)
	{
		parent::__construct();

		$this->model = $model;

		$this->layout->view_name = $this->view_name;
		$this->layout->route_name = $this->route_name;
		$this->page_base_dir .= $this->view_name . '.';
		$this->required_images = [
									'Gallery1'	=> 'Gallery 1', 
									'Gallery2' 	=> 'Gallery 2', 
									'Gallery3' 	=> 'Gallery 3', 
									'Gallery4' 	=> 'Gallery 4', 
									'Gallery5' 	=> 'Gallery 5', 
									'SmallThumbnail' 	=> 'Small Thumbnail', 
									'MediumThumbnail' 	=> 'Medium Thumbnail'
								];
		
		$this->layout->content_title = strtoupper($this->view_name);

	}

	public function getIndex()
	{
		// ------------------------------------------------------------------------------------------------------------
		// FILTERS
		// ------------------------------------------------------------------------------------------------------------
		$filters['name'] = Input::get('filter_place_name');
		$filters['destination'] = Input::get('filter_destination_id');

		// ------------------------------------------------------------------------------------------------------------
		// QUERY PLACE
		// ------------------------------------------------------------------------------------------------------------
		$places = $this->model->NameLike('*' . str_replace(' ', '*', $filters['name']) . '*')->InDestinationByIds(\App\Destination::withSubtreeById($filters['destination'])->get()->lists('id')->toArray())->latest()->paginate(30);

		// ------------------------------------------------------------------------------------------------------------
		// QUERY DESTINATION
		// ------------------------------------------------------------------------------------------------------------
		$destinations = \App\Destination::orderBy(\App\Destination::getPathField());
		if ($filters['destination'])
		{
			$filtered_destination = \App\Destination::find($filters['destination']);
		}

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'index')->with('route_name', $this->route_name)->with('view_name', $this->view_name);
		$this->layout->page->filters 		= $filters;
		$this->layout->page->places 		= $places;
		$this->layout->page->required_images= $this->required_images;
		$this->layout->page->destinations 	= $destinations;
		$this->layout->page->filtered_destination 	= $filtered_destination;

		return $this->layout;
	}

	public function getCreate($data = null)
	{
		// ------------------------------------------------------------------------------------------------------------
		// DESTINATION
		// ------------------------------------------------------------------------------------------------------------
		$destinations = \App\Destination::orderBy(\App\Destination::getPathField());

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'create')->with('route_name', $this->route_name)->with('view_name', $this->view_name);
		$this->layout->page->data 			= $data;
		$this->layout->page->required_images= $this->required_images;
		$this->layout->page->destinations 	= $destinations;

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
		if (!empty($input['published_at']))
		{
			$input['published_at'] = \Carbon\Carbon::createFromFormat('d/m/Y H:i', $input['published_at'])->format('Y-m-d H:i:s');
		}
		else
		{
			$input['published_at'] = null;
		}

		unset($input['longlat']);
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
}