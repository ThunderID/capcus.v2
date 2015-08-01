<?php namespace App\Http\Controllers\API;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller as BaseController;

use Auth, Route;

abstract class Controller extends BaseController {

	protected $layout;

	function __construct()
	{
		
	}

}
