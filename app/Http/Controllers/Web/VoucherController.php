<?php namespace App\Http\Controllers\Web;

use Auth, Input, \Illuminate\Support\MessageBag;
use \App\Vendor, \App\Book, \App;

class VoucherController extends Controller {

	public function generate($vendor_slug, $tour_slug, $schedule_id)
	{
		// -------------------------------------------------
		// check vendor
		// -------------------------------------------------
		$vendor = Vendor::SlugIs($vendor_slug)->first();
		if (!$vendor)
		{
			App::abort(404);
		}

		// -------------------------------------------------
		// check tour
		// -------------------------------------------------
		$tour = $vendor->tours()->slugIs($tour_slug)->first();
		if (!$tour)
		{
			App::abort(404);
		}

		// -------------------------------------------------
		// schedule
		// -------------------------------------------------
		$schedule = $tour->schedules()->find($schedule_id);
		if (!$schedule)
		{
			App::abort(404);
		}

		// -------------------------------------------------
		// generate voucher
		// -------------------------------------------------
		$book = Book::where('user_id', '=', Auth::id())->ofSchedule($schedule->id)->first();

		if (!$book)
		{
			$book = new Book();
			$book->fill([
							'discount_currency'	=> $schedule->currency,
						 	'discount' 			=> $schedule->discount,
						 	'discount_code' 	=> str_random(6),
						 	'user_id'			=> Auth::id(),
						 	'schedule_id'		=> $schedule->id
						 ]);
			if (!$book->save())
			{
				return redirect()->back()->withErrors($book->getErrors);
			}
		}

		return redirect()->route('web.me.index');
	}
}