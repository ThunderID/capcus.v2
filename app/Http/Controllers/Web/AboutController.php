<?php namespace App\Http\Controllers\Web;

use Auth, Input, Exception, \Illuminate\Support\MessageBag;

use \App\Headline;
use \App\Tour;
use \App\TourSchedule;
use \App\Article;
use \Illuminate\Support\Collection;

class AboutController extends Controller {

	public function imvendor()
	{
		

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'imvendor');
		return $this->layout;
	}

	public function tnc()
	{
		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'tnc');
		return $this->layout;	
	}

	public function contactus()
	{
		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'contact_us');
		return $this->layout;
	}

	public function contactus_success()
	{
		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'contact_us_success');
		return $this->layout;
	}

	public function contactus_post()
	{
		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$rules['name']			= ['required', 'min:3'];
		$rules['email']			= ['required', 'email'];
		$rules['message']		= ['required', 'min:30'];

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			return redirect()->back()->withInput()->withErrors($validator);
		}
		else
		{
			$data = Input::all();

			Mail::raw(Input::get('message'), function($m) use ($data) { 
				$m->to('info@capcus.id', 'CAPCUS')->subject('From Website Contact Us - ' . $data['email']);
			});

			return redirect()->route('web.about.contactus.success');
		}
	}
}