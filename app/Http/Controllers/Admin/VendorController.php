<?php namespace App\Http\Controllers\Admin;

use Auth, Input, \Illuminate\Support\MessageBag, Validator, Exception, App;

class VendorController extends Controller {

	protected $model;
	protected $subscription_model;
	protected $view_name = 'vendor';
	protected $route_name = 'vendor';

	public function __construct(\App\Vendor $model, \App\VendorSubscription $subscription_model)
	{
		parent::__construct();

		$this->model = $model;
		$this->subscription_model = $subscription_model;

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
		$input['logo_sm'] = $input['small_logo'];
		$input['logo_lg'] = $input['large_logo'];
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
			return redirect()->route('admin.' . $this->view_name . '.index')->with('alert_success', '"' .$data->title. '" has been deleted successfully' );
		}
	}

	// ------------------------------------------------------------------------------------------------------------------------ 
	// SUBSCRIPTION
	// ------------------------------------------------------------------------------------------------------------------------ 
	public function getSubscription($vendor_id, $subscription_id = null)
	{
		$data = $this->model->findorfail($vendor_id);

		if ($subscription_id)
		{
			$subscription = $data->subscriptions->contains($subscription_id);
			if (!$subscription)
			{
				return App::abort(404);
			}
		}

		// ---------------------------------------- GENERATE PAGE ----------------------------------------
		$this->layout->content = view('admin.pages.'.$this->view_name.'.subscription')
											->with('route_name', $this->route_name)
											->with('data', $data)
											->with('schedule', $schedule)
											->with('subscription_id', $subscription_id);

		return $this->layout;		
	}

	public function postSubscription($vendor_id, $subscription_id = null)
	{
		$vendor = $this->model->findorfail($vendor_id);

		if ($subscription_id)
		{
			$subscription = $vendor->subscriptions->find($subscription_id);
			if (!$subscription)
			{
				return App::abort(404);
			}
		}
		else
		{
			$subscription = $this->subscription_model->newInstance();
		}

		$input = Input::all();
		try {
			$input['since'] = \Carbon\Carbon::createFromFormat('d/m/Y', $input['since']);
		} catch (Exception $e) {
			$input['since']	= null;
		}

		try {
			$input['until'] = \Carbon\Carbon::createFromFormat('d/m/Y', $input['until']);
		} catch (Exception $e) {
			$input['until']	= null;
		}
		$input['category_id'] = $input['subscription'];
		$input['vendor_id'] = $vendor_id;

		// schedule
		$subscription->fill($input);
		if ($subscription->save())
		{
			$success_message = 'Subscription has been set to : ' . $subscription->category->name . ' between ' . $subscription->since->format('d-M-Y') . ' to ' . $subscription->until->format('d-M-Y');
			return redirect()->route('admin.vendor.subscription', ['vendor_id' => $vendor_id])->with('alert_success', $success_message) ;
		}
		else
		{
			return redirect()->back()->withInput()->withErrors($subscription->errors);
		}

		return $this->layout;		
	}
}