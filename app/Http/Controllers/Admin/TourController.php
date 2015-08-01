<?php namespace App\Http\Controllers\Admin;

use Auth, Input, \Illuminate\Support\MessageBag, Validator, Exception, App;

class TourController extends Controller {

	protected $model;
	protected $schedule_model;
	protected $view_name = 'tour';
	protected $route_name = 'tour';

	public function __construct(\App\Tour $model, \App\Schedule $schedule_model)
	{
		parent::__construct();

		$this->model = $model;
		$this->schedule_model = $schedule_model;

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
			$data = $this->model->findorfail($id);
		}
		else
		{
			$data = $this->model->newInstance();
		}

		// ---------------------------------------- HANDLE SAVE ----------------------------------------
		$input = Input::all();
		$input['category_ids'] = $input['category'];
		$input['thumbnail_sm'] = $input['small_thumbnail'];
		$input['thumbnail_lg'] = $input['large_thumbnail'];
		$input['vendor_id'] = $input['vendor'];
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
			return redirect()->route('admin.'.$this->view_name.'.show', ['id' => $data->id])->with('alert_success', '"' . $data->name . '" has been saved successfully');
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

	// ------------------------------------------------------------------------------------------------------------------------ 
	// SCHEDULES
	// ------------------------------------------------------------------------------------------------------------------------ 
	public function getSchedules($tour_id, $schedule_id = null)
	{
		$data = $this->model->findorfail($tour_id);

		if ($schedule_id)
		{
			$schedule = $this->schedule_model->findorfail($schedule_id);

			if ($schedule->tour_id != $tour_id)
			{
				App::abort(404);
			}
		}

		// ---------------------------------------- GENERATE PAGE ----------------------------------------
		$this->layout->content = view('admin.pages.'.$this->view_name.'.schedules')
											->with('route_name', $this->route_name)
											->with('data', $data)
											->with('schedule', $schedule);

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
		$input['depart_at'] = \Carbon\Carbon::createFromFormat('d/m/Y H:i', $input['depart_at']);
		$input['return_at'] = \Carbon\Carbon::createFromFormat('d/m/Y H:i', $input['return_at']);
		$input['tour_id'] = $tour_id;

		// schedule
		$schedule->fill($input);

		if ($schedule->save())
		{
			if ($schedule_id)
			{
				$success_message = 'Schedule has been updated: ' . $schedule->depart_at->format('d/m/Y H:i') . ' - ' . $schedule->return_at->format('d/m/Y H:i');
			}
			else
			{
				$success_message = 'Schedule has been added: ' . $schedule->depart_at->format('d/m/Y H:i') . ' - ' . $schedule->return_at->format('d/m/Y H:i');
			}
			return redirect()->route('admin.tour.schedules', ['tour_id' => $tour_id])->with('alert_success', $success_message) ;
		}
		else
		{
			return redirect()->back()->withInput()->withErrors($schedule->errors);
		}

		return $this->layout;		
	}
}