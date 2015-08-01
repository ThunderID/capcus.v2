<?php namespace App\Http\Controllers\Admin;

use Auth, Input, \Illuminate\Support\MessageBag, Validator, Exception, App;

class MemberController extends Controller {

	protected $model;
	protected $view_name = 'member';
	protected $route_name = 'member';

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
		$this->layout->content = view('admin.pages.'.$this->view_name.'.index')->with('route_name', $this->route_name);

		return $this->layout;
	}

	public function getCreate($data = null)
	{
		return App::abort(404);

		// ---------------------------------------- GENERATE PAGE ----------------------------------------
		$this->layout->content = view('admin.pages.'.$this->view_name.'.create')->with('route_name', $this->route_name)->with('data', $data);

			return $this->layout;
	}

	public function postStore($id = null)
	{
		return App::abort(404);

		// ---------------------------------------- HANDLE REQUEST ----------------------------------------
		// handle id
		if (!is_null($id))
		{
			$data = $this->model->isAdmin(false)->find($id);
		}
		else
		{
			$data 				= $this->model->isAdmin(false)->newInstance();
			$data->user_id 		= Auth::id();
		}

		// ---------------------------------------- HANDLE SAVE ----------------------------------------
		$input = Input::all();
		$input['category_ids'] = $input['category'];
		$input['subarticle_ids'] = $input['subarticle'];

		if (!empty($input['published_at']))
		{
			$input['published_at'] = \Carbon\Carbon::createFromFormat('d/m/Y H:i', $input['published_at'])->format('Y-m-d H:i:s');
		}
		else
		{
			unset($input['published_at']);
		}
		$data->fill($input);

		if ($data->save())
		{
			return redirect()->route('admin.'.$this->view_name.'.show', ['id' => $data->id])->with('alert_success', '"' . $data->title . '" has been saved successfully');
		}
		else
		{
			return redirect()->back()->withInput()->withErrors($data->errors);
		}
	}

	public function getShow($id, $mode = '')
	{
		$data = $this->model->isAdmin(false)->where('id', '=', $id)->first();

		if (!$data)
		{
			App::abort(404);
		}

		// ---------------------------------------- GENERATE PAGE ----------------------------------------
		$this->layout->content = view('admin.pages.'.$this->view_name.'.show')
											->with('route_name', $this->route_name)
											->with('data', $data);

		return $this->layout;		
	}

	public function getEdit($id)
	{
		return App::abort(404);
		// ---------------------------------------- HANDLE REQUEST ----------------------------------------
		$data = $this->model->isAdmin(false)->findorfail($id);

		return $this->getCreate($data);
	}

	public function getDelete($id)
	{
		return App::abort(404);
		
		// ---------------------------------------- HANDLE REQUEST ----------------------------------------
		$data = $this->model->isAdmin(false)->findorfail($id);

		// ---------------------------------------- GENERATE PAGE ----------------------------------------
		$this->layout->content = view('admin.pages.'.$this->view_name.'.delete')
											->with('route_name', $this->route_name)
											->with('data', $data);

		return $this->layout;		
	}


	public function postDelete($id)
	{
		return App::abort(404);

		// ---------------------------------------- HANDLE REQUEST ----------------------------------------
		// handle id
		$data = $this->model->isAdmin(false)->findorfail($id);

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