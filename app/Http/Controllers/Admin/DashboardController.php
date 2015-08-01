<?php namespace App\Http\Controllers\Admin;

use Auth, Input, \Illuminate\Support\MessageBag;

class DashboardController extends Controller {

	protected $route_name = 'dashboard';
	protected $view_name = 'dashboard';

	function __construct()
	{
		parent::__construct();

		$this->model = $model;
		$this->user_model = $user_model;

		$this->layout->view_name = $this->view_name;
		$this->layout->route_name = $this->route_name;
		$this->page_base_dir .= $this->view_name . '.';
		
		$this->layout->content_title = strtoupper($this->view_name);
	}

	public function getIndex($current_mode = 'overview')
	{
		// -------------------------------------------------------------------------------------
		// INIT
		// -------------------------------------------------------------------------------------

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'overview')->with('route_name', $this->route_name)->with('view_name', $this->view_name);


		return $this->layout;
	}
}