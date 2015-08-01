<?php namespace App\Http\Controllers\Admin;

use Auth, Input, \Illuminate\Support\MessageBag, Validator, Exception, App;

class HeadlineController extends Controller {

	protected $model;
	protected $view_name = 'headlines';
	protected $route_name = 'headlines';

	public function __construct(\App\Headline $model)
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
		// ---------------------------------------- GENERATE PAGE ----------------------------------------
		$this->layout->content = view('admin.pages.'.$this->view_name.'.create')->with('route_name', $this->route_name)->with('data', $data);

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
			$data 				= $this->model->newInstance();
		}

		// ---------------------------------------- HANDLE SAVE ----------------------------------------
		$input = Input::all();

		try {
			$input['active_since'] = \Carbon\Carbon::createFromFormat('d/m/Y H:i', $input['active_since'])->format('Y-m-d H:i:s');
			$input['active_until'] = \Carbon\Carbon::createFromFormat('d/m/Y H:i', $input['active_until'])->format('Y-m-d H:i:s');
		} catch (Exception $e) {
			$input['active_since'] = null;
			$input['active_until'] = null;
		}

		$input['image_sm'] = $input['small_image'];
		$input['image_lg'] = $input['large_image'];

		$input['vendor_id'] = $input['vendor'];
		$data->fill($input);


		if ($data->save())
		{
			return redirect()->route('admin.'.$this->route_name.'.show', ['id' => $data->id])->with('alert_success', '"' . $data->name . '" has been saved successfully');
		}
		else
		{
			return redirect()->back()->withInput()->withErrors($data->errors);
		}
	}

	public function getShow($id, $mode = '')
	{
		$data = $this->model->findorfail($id);

		// ---------------------------------------- GENERATE PAGE ----------------------------------------
		$this->layout->content = view('admin.pages.'.$this->view_name.'.show')
											->with('route_name', $this->route_name)
											->with('data', $data);

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

		// ---------------------------------------- GENERATE PAGE ----------------------------------------
		$this->layout->content = view('admin.pages.'.$this->view_name.'.delete')
											->with('route_name', $this->route_name)
											->with('data', $data);

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
			return redirect()->route('admin.' . $this->view_name . '.index')->with('alert_success', '"' .$data->name. '" has been deleted successfully' );
		}
	}
}