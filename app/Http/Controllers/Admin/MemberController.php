<?php namespace App\Http\Controllers\Admin;

use Auth, Input, \Illuminate\Support\MessageBag, Validator, Exception, App;
use \App\Member as User;

class MemberController extends Controller {

	protected $model;
	protected $view_name = 'members';
	protected $route_name = 'members';

	public function __construct(User $model)
	{
		parent::__construct();

		$this->model = $model;

		$this->layout->view_name = $this->view_name;
		$this->layout->route_name = $this->route_name;
		$this->page_base_dir .= $this->view_name . '.';
		
		$this->layout->content_title = 'MEMBERS';
	}

	public function getIndex()
	{
		// ------------------------------------------------------------------------------------------------------------
		// FILTERS
		// ------------------------------------------------------------------------------------------------------------
		$filters['name'] = Input::get('filter_admin_name');

		// ------------------------------------------------------------------------------------------------------------
		// QUERY
		// ------------------------------------------------------------------------------------------------------------
		$data = $this->model->NameLike('*'.$filters['name'].'*')->orderBy('name')->paginate(30);

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'index')->with('route_name', $this->route_name)->with('view_name', $this->view_name);
		$this->layout->page->data 			= $data;
		$this->layout->page->filters 		= $filters;

		return $this->layout;
	}

	public function getCreate($data = null)
	{
		return App::abort(404);
		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'create')->with('route_name', $this->route_name)->with('view_name', $this->view_name);
		$this->layout->page->data			= $data;
		$this->layout->page->destinations	= $destinations;

		return $this->layout;
	}

	public function postStore($id = null)
	{
		return App::abort(404);
		// ---------------------------------------- HANDLE REQUEST ----------------------------------------
		// handle id
		if (!is_null($id))
		{
			$data = $this->model->find($id);
		}
		else
		{
			$data 				= $this->model->newInstance();
		}

		// ---------------------------------------- HANDLE SAVE ----------------------------------------
		$input = Input::all();

		// validate password confirmation
		$rules['password'] = ['min:8', 'confirmed'];
		$validator = Validator::make($input, $rules);
		if ($validator->fails())
		{
			dd($validator->messages());
			return redirect()->back()->withInput()->withErrors($validator->messages());
		}

		$data->fill($input);

		if ($data->save())
		{
			return redirect()->route('admin.'.$this->view_name.'.show', ['id' => $data->id])->with('alert_success', '"' . $data->{$data->getNameField()} . '" has been saved successfully');
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
		return App::abort(404);
		// ---------------------------------------- HANDLE REQUEST ----------------------------------------
		$data = $this->model->findorfail($id);
		return $this->getCreate($data);
	}

	public function getDelete($id)
	{
		return App::abort(404);
		
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
		return App::abort(404);
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