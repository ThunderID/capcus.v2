<?php namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller as BaseController;

use Auth, Route;

abstract class Controller extends BaseController {

	protected $layout;

	function __construct()
	{
		if (!Route::is('admin.login'))
		{
			$this->layout_base_dir 	= 'admin.';
			$this->page_base_dir 	= $this->layout_base_dir . 'pages.';
			
			$this->layout 			= view($this->layout_base_dir.'page_templates.admin');
			$this->layout->basic 	= view($this->layout_base_dir.'page_templates.admin_basic');
		}
		else
		{

			$this->layout = view('admin.page_templates.login');
		}

	}
}
