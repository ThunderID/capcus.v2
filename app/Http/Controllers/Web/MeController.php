<?php namespace App\Http\Controllers\Web;

use Auth, Input, \Illuminate\Support\MessageBag, Validator, Session;
use \App\Vendor, \App\Book, \App, Hash;

class MeController extends Controller {

	public function __construct(\App\Tour $model, \App\TourSchedule $schedule_model)
	{
		parent::__construct();

		$this->model = $model;
		$this->schedule_model = $schedule_model;

		$this->layout->view_name = $this->view_name;
		$this->layout->route_name = $this->route_name;
		$this->page_base_dir .= $this->view_name . '.';

		$this->layout->content_title = strtoupper($this->view_name);
	}

	function complete_profile()
	{
		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page = view($this->page_base_dir . 'complete_profile');

		return $this->layout;
	}

	function complete_profile_post()
	{
		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$user = Auth::user();
		$user->email = Input::get('email');
		$user->gender = Input::get('gender');
		try {
			$user->dob = \Carbon\Carbon::createFromDate(Input::get('year'), Input::get('month'), Input::get('day'));
		} catch (\Exception $e) {
			return redirect()->back()->withInput()->withErrors('Tanggal lahir anda dalam format yang salah');
		}

		$rules['email'] = ['required', 'email'];
		$rules['gender'] = ['required', 'in:pria,wanita'];
		$rules['dob'] = ['required', 'date', 'before:-5 year'];

		$validator = Validator::make(['email' => $user->email, 'gender' => $user->gender, 'dob' => $user->dob->format('Y-m-d')], 
									$rules,
									[
										'required' 		=> ':attribute wajib diisi',
										'in'			=> ':attribute harus salah satu dari :values',
										'dob.date'		=> 'tanggal lahir bukan merupakan format tanggal yang benar ',
										'before'		=> 'Anda wajib berusia minimal 5 tahun untuk menjadi member situs kami' ,
									]
									);

		if ($validator->fails())
		{
			return redirect()->back()->withInput()->withErrors($validator);
		}
		elseif (!$user->save())
		{
			$errors = $user->getErrors();
			return redirect()->back()->withInput()->withErrors($user->getErrors());
		}
		else
		{
			if (Session::has('redirect'))
			{
				$redirect = Session::get('redirect', route('web.home'));
				Session::remove('redirect');
				return redirect()->to($redirect);
			}
			else
			{
				return redirect()->route('web.home');
			}
		}
	}

	function completed_profile()
	{
		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page = view($this->page_base_dir . 'completed_profile');
	}










	// ------------------------------------------------------------------------------------------------------------
	// FROM CAPCUS v1
	// ------------------------------------------------------------------------------------------------------------

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