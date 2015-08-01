<?php namespace App\Http\Controllers\Admin;

use Auth, Input, \Illuminate\Support\MessageBag, Validator, Exception, App;

class AdminController extends Controller {

	protected $model;
	protected $view_name = 'admin';
	protected $route_name = 'admin';

	public function __construct(\App\User $model)
	{
		parent::__construct();

		$this->model = $model;

		$this->layout->view_name = $this->view_name;
		$this->layout->route_name = $this->route_name;
		
		$this->layout->content_title = strtoupper($this->view_name);

	}

	public function getIndex()
	{
		// ---------------------------------------- GENERATE PAGE ----------------------------------------
		$this->layout->content = view('admin.pages.'.$this->view_name.'.index')->with('route_name', $this->route_name)->with('view_name', $this->view_name);

		return $this->layout;
	}

	public function getCreate($data = null)
	{
		// ---------------------------------------- GENERATE PAGE ----------------------------------------
		$this->layout->content = view('admin.pages.'.$this->view_name.'.create')->with('route_name', $this->route_name)->with('view_name', $this->view_name)->with('data', $data);

			return $this->layout;
	}

	public function postStore($id = null)
	{
		// ---------------------------------------- HANDLE REQUEST ----------------------------------------
		// handle id
		if (!is_null($id))
		{
			$data = $this->model->isAdmin(true)->find($id);
		}
		else
		{
			$data 				= $this->model->newInstance();
		}

		// ---------------------------------------- HANDLE SAVE ----------------------------------------
		$input = Input::all();
		if (!$input['password'])
		{
			unset($input['password']);
			unset($input['password_confirmation']);
		}
		else
		{
			$rules['password'] = ['confirmed'];
			$validator = Validator::make($input, $rules, ['password.confirmed' => "Please ensure the confirmation password is the same with the password"]);
			if ($validator->fails())
			{
				return redirect()->back()->withInput()->withErrors($validator);
			}
		}
		$input['is_admin'] = true;

		$data->fill($input);

		if ($data->save())
		{
			return redirect()->route('admin.'.$this->view_name.'.show', ['id' => $data->id])->with('alert_success', '"' . $data->name . '" has been saved successfully');
		}
		else
		{
			return redirect()->back()->withInput()->withErrors($data->errors);
		}
	}

	public function getShow($id, $mode = '')
	{
		$data = $this->model->isAdmin(true)->where('id', '=', $id)->first();

		if (!$data)
		{
			App::abort(404);
		}

		// ---------------------------------------- GENERATE PAGE ----------------------------------------
		$this->layout->content = view('admin.pages.'.$this->view_name.'.show')
											->with('route_name', $this->route_name)->with('view_name', $this->view_name)
											->with('data', $data);

		return $this->layout;		
	}

	public function getEdit($id)
	{
		// ---------------------------------------- HANDLE REQUEST ----------------------------------------
		$data = $this->model->isAdmin(true)->findorfail($id);

		return $this->getCreate($data);
	}

	public function getDelete($id)
	{
		// ---------------------------------------- HANDLE REQUEST ----------------------------------------
		$data = $this->model->isAdmin(true)->findorfail($id);

		// ---------------------------------------- GENERATE PAGE ----------------------------------------
		$this->layout->content = view('admin.pages.'.$this->view_name.'.delete')
											->with('route_name', $this->route_name)->with('view_name', $this->view_name)
											->with('data', $data);

		return $this->layout;		
	}


	public function postDelete($id)
	{
		// ---------------------------------------- HANDLE REQUEST ----------------------------------------
		// handle id
		$data = $this->model->isAdmin(true)->findorfail($id);

		// ---------------------------------------- PREPARE VIEW ----------------------------------------
		if (!$data->delete())
		{
			return redirect()->back()->withErrors($data->getErrors());
		}
		else
		{
			return redirect()->route('admin.' . $this->route_name . '.index')->with('alert_success', '"' .$data->name. '" has been deleted successfully' );
		}
	}
}