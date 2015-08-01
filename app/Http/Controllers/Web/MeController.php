<?php namespace App\Http\Controllers\Web;

use Auth, Input, \Illuminate\Support\MessageBag, Validator;
use \App\Vendor, \App\Book, \App, Hash;

class MeController extends Controller {

	public function index()
	{
		// ------------------------------------------------------------------------------------------------------------
		// QUERY VOUCHER
		// ------------------------------------------------------------------------------------------------------------
		$vouchers = Auth::user()->books()->notExpired()->latest()->get();

		// ------------------------------------------------------------------------------------------------------------
		// QUERY LOVED TOUR
		// ------------------------------------------------------------------------------------------------------------
		$tours = Auth::user()->love()->get();
		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page = view($this->page_base_dir . 'me.index');
		$this->layout->page->vouchers 	= $vouchers;
		$this->layout->page->tours 		= $tours;

		$this->init_right_sidebar();
		return $this->layout;
	}

	public function edit_profile()
	{
		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page = view($this->page_base_dir . 'me.edit_profile');
		$this->init_right_sidebar();
		return $this->layout;
	}

	public function edit_profile_post()
	{
		// ------------------------------------------------------------------------------------------------------------
		// RULES
		// ------------------------------------------------------------------------------------------------------------
		$rules['nama']									= ['required', 'min:3'];
		$rules['email']									= ['email'];
		$rules['telp']									= ['numeric'];
		$rules['tgl_lahir']								= ['required', 'date'];
		$rules['gender']								= ['in:pria,wanita'];

		$input = Input::only('nama','email','telp', 'tgl_lahir', 'gender');

		if ($input['tgl_lahir'])
		{
			$tgl_lahir = explode("/", $input['tgl_lahir']);
			if (count($tgl_lahir) != 3)
			{
				unset($input['tgl_lahir']);
			}
			else
			{
				$input['tgl_lahir'] = $tgl_lahir[2] .'-'. $tgl_lahir[1] . '-' . $tgl_lahir[0];
  			}
		}

		$validator = Validator::make($input, $rules);
		if ($validator->fails())
		{
			return redirect()->back()->withInput()->withErrors($validator);
		}

		// ------------------------------------------------------------------------------------------------------------
		// UPDATE & REDIRECT
		// ------------------------------------------------------------------------------------------------------------ 
		$me = Auth::user();
		$me->name 	= $input['nama'];
		$me->email 	= $input['email'];
		$me->gender = $input['gender'];
		$me->telp 	= $input['telp'];
		$me->dob 	= \Carbon\Carbon::parse($input['tgl_lahir']);
		if (!$me->save())
		{
			return redirect()->back()->withInput()->withErrors($me->getErrors());
		}
		else
		{
			return redirect()->back()->with('alert_success', 'Profile anda telah terupdate');
		}
		
	}

	function edit_password_post()
	{
		$me = Auth::user();

		$rules['password_sekarang'] = ['required'];
		$rules['password_baru'] = ['required', 'same:password_baru'];
		$rules['konfirmasi_password_baru'] = ['same:password_baru'];

		// validate
		$validator = Validator::make(Input::only('password_sekarang', 'password_baru', 'konfirmasi_password_baru'), $rules);
		if ($validator->fails())
		{
			return redirect()->back()->withErrors($validator);
		}

		// check old password
		if (!Hash::check(Input::get('password_sekarang', $me->password)))
		{
			return redirect()->back()->withErrors(new MessageBag(['old_password' => 'Password sekarang anda salah.']));
		}

		$me->password = Input::get('password_baru');
		if (!$me->save())
		{
			return redirect()->back()->withErrors($me->getErrors());
		}
		else
		{
			return redirect()->back()->with('alert_success', 'Password anda telah terupdate');
		}
	}
}