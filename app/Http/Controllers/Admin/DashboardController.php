<?php namespace App\Http\Controllers\Admin;

use Auth, Input, \Illuminate\Support\MessageBag;

class DashboardController extends Controller {

	protected $route_name = 'dashboard';
	protected $modes = ['overview'];

	function __construct()
	{
		parent::__construct();
	}

	public function getIndex($current_mode = 'overview')
	{
		// -------------------------------------------------------------------------------------
		// INIT
		// -------------------------------------------------------------------------------------
		$current_mode = strtolower($current_mode);
		if (!in_array($current_mode, $this->modes))
		{
			App::abort(404);
		}

		// -------------------------------------------------------------------------------------
		// GENERATE CONTENT VIEW
		// -------------------------------------------------------------------------------------
		$this->layout->content = view('admin.pages.dashboard.overview')->with('route_name', $this->route_name)
																		->with('modes', $this->modes)
																		->with('current_mode', 'overview');
		return $this->layout;
	}
}