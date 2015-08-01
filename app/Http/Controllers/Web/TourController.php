<?php namespace App\Http\Controllers\Web;

use Auth, Input, \Illuminate\Support\MessageBag, App, \Illuminate\Support\Collection;
use App\PublishedTour as Tour;
use App\Vendor;
use App\Category;

class TourController extends Controller {

	public function lists($vendor = null, $tujuan = null, $keberangkatan = null, $budget = null)
	{
		// ------------------------------------------------------------------------
		// REDIRECT IF REQUEST URL
		// ------------------------------------------------------------------------
		if (Input::has('vendor') || Input::has('tujuan') || Input::has('keberangkatan') || Input::has('budget'))
		{
			$vendor 		= Input::get('vendor') ? Input::get('vendor') : "semua-vendor";
			$tujuan 		= Input::get('tujuan') ? Input::get('tujuan') : "semua-tujuan";
			$keberangkatan 	= Input::get('keberangkatan') ? Input::get('keberangkatan') : "semua-keberangkatan";
			$budget 		= Input::get('budget') ? Input::get('budget') : "semua-budget";

			return redirect()->route('web.tour', ['vendor' => $vendor, 'tujuan' => $tujuan, 'keberangkatan' => $keberangkatan, 'budget' => $budget]);
		}
		// ------------------------------------------------------------------------
		// PARSE SEARCH
		// ------------------------------------------------------------------------
		else
		{
			if (str_is(strtolower($vendor), 'semua-vendor'))
			{
				unset($vendor);
			}
			else
			{
				$this->layout->basic->filters['vendor'] = $vendor;
			}

			if (str_is(strtolower($tujuan), 'semua-tujuan'))
			{
				unset($tujuan);
			}
			else
			{
				$this->layout->basic->filters['tujuan'] = $tujuan;
			}

			if (str_is(strtolower($keberangkatan), 'semua-keberangkatan'))
			{
				unset($keberangkatan);
			}
			else
			{
				$this->layout->basic->filters['keberangkatan'] = $keberangkatan;
			}

			if (str_is(strtolower($budget), 'semua-budget'))
			{
				unset($budget);
			}
			else
			{
				$this->layout->basic->filters['budget'] = $budget;
			}
		}

		// ------------------------------------------------------------------------
		// CHECK VENDOR
		// ------------------------------------------------------------------------
		if ($vendor)
		{
			$vendor = Vendor::SlugIs($vendor)->first();
			if (!$vendor)
			{
				return App::abort(404);
			}
		}

		if ($tujuan)
		{
			$tujuan_tree = Category::findPathName($tujuan.'*')->get();
			if (!$tujuan_tree)
			{
				return App::abort(404);
			}

			// get tujuan object
			foreach ($tujuan_tree as $x)
			{
				if (str_is($tujuan, $x->path_name))
				{
					$tujuan = $x;
					break;
				}
			}
		}

		if ($keberangkatan)
		{
			$keberangkatan_year = substr($keberangkatan, 0, 4) * 1;
			$keberangkatan_month = substr($keberangkatan, 4, 2);

			if ($keberangkatan_year <= 2000 && $keberangkatan_year >= date('Y')+30)
			{
				return App::abort(404);
			}

			if ($keberangkatan_month <= 0 && $keberangkatan_month >= 13)
			{
				return App::abort(404);
			}

			$keberangkatan = ['month' => $keberangkatan_month, 'year' => $keberangkatan_year];
		}

		if ($budget)
		{
			list($budget_min, $budget_max) = explode('-', $budget);

			if ($budget_min * 1 < 0)
			{
				return App::abort(404);
			}

			if ($budget_max <= 0 && $budget_max <= $budget_min)
			{
				return App::abort(404);
			}
			$budget = ['min' => $budget_min, 'max' => $budget_max];
		}

		// ------------------------------------------------------------------------
		// QUERY
		// ------------------------------------------------------------------------
		$q = Tour::findVendor($vendor->id)
						->inCategories($tujuan_tree ? $tujuan_tree->lists('id') : null)
						->budgetBetween($budget['min'] * 1, ($budget['max'] ? $budget['max'] * 1 : 999999999999))
						->latest('published_at');
		if ($keberangkatan)
		{
			if (\Carbon\Carbon::now()->gt(\Carbon\Carbon::createFromDate($keberangkatan_year, $keberangkatan_month, 1)))
			{
				$q = $q->scheduledBetween(\Carbon\Carbon::now(), \Carbon\Carbon::createFromDate($keberangkatan_year, $keberangkatan_month, 1)->endOfMonth());
			}
			else
			{
				$q = $q->scheduledBetween(\Carbon\Carbon::createFromDate($keberangkatan_year, $keberangkatan_month, 1), \Carbon\Carbon::createFromDate($keberangkatan_year, $keberangkatan_month, 1)->endOfMonth());
			}
		}
		else
		{
			$q = $q->scheduledBetween(\Carbon\Carbon::now(), \Carbon\Carbon::now()->addYear(1));
		}
		$tours = $q->paginate(12);

		// ------------------------------------------------------------------------
		// IF NO TOUR, QUERY FOR ALL TOUR
		// ------------------------------------------------------------------------
		if (!$tours->count())
		{
			// Cari tour dengan tujuan yang sama
			if ($tujuan_tree)
			{
				if ($tujuan_tree->count())
				{
					$q = Tour::scheduledBetween(\Carbon\Carbon::now(), \Carbon\Carbon::now()->addYear(1))
											->inCategories($tujuan_tree ? $tujuan_tree->lists('id') : null)
											->latest('published_at');
					$other_tours['same_destination'] = $q->skip(0)->take(8)->get();
				}
			}
			else
			{
				$other_tours['same_destination'] = new Collection;
			}

			// Cari tour dengan keberangkatan yang sama
			if ($keberangkatan_year && $keberangkatan_month)
			{
				$q = Tour::latest('published_at');
				if ($keberangkatan)
				{
					if (\Carbon\Carbon::now()->gt(\Carbon\Carbon::createFromDate($keberangkatan_year, $keberangkatan_month, 1)))
					{
						$q = $q->scheduledBetween(\Carbon\Carbon::now(), \Carbon\Carbon::createFromDate($keberangkatan_year, $keberangkatan_month, 1)->endOfMonth());
					}
					else
					{
						$q = $q->scheduledBetween(\Carbon\Carbon::createFromDate($keberangkatan_year, $keberangkatan_month, 1), \Carbon\Carbon::createFromDate($keberangkatan_year, $keberangkatan_month, 1)->endOfMonth());
					}
				}
				else
				{
					$q = $q->scheduledBetween(\Carbon\Carbon::now(), \Carbon\Carbon::now()->addYear(1));
				}
				$other_tours['same_schedule'] = $q->skip(0)->take(8)->get();
			}
			else
			{
				$other_tours['same_schedule'] = new Collection;
			}

			// Cari tour dengan budget yang sama
			if ($budget['max'] != 999999999 &&  $budget['min'] != 0)
			{
				$q = Tour::scheduledBetween(\Carbon\Carbon::now(), \Carbon\Carbon::now()->addYear(1))
							->budgetBetween($budget['min'] * 1, ($budget['max'] ? $budget['max'] * 1 : 999999999999));
				$other_tours['same_budget'] = $q->skip(0)->take(8)->get();
			}
			else
			{
				$other_tours['same_budget'] = new Collection;
			}

			if (!$other_tours['same_destination']->count() && !$other_tours['same_budget']->count() && !$other_tours['same_schedule']->count())
			{
				$other_tours['others'] = Tour::scheduledBetween(\Carbon\Carbon::now(), \Carbon\Carbon::now()->addYear(1))->skip(0)->take(12)->get();
			}
		}

		
		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page = view($this->page_base_dir . 'tour.index');
		$this->layout->page->vendor 			= $vendor;
		$this->layout->page->tujuan_tree 		= $tujuan_tree;
		$this->layout->page->tujuan 			= $tujuan;
		$this->layout->page->keberangkatan 		= $keberangkatan;
		$this->layout->page->budget 			= $budget;
		$this->layout->page->tours 				= $tours;
		$this->layout->page->other_tours 		= $other_tours;

		$this->init_right_sidebar();


		return $this->layout;
	}

	public function show($vendor_slug, $tour_slug)
	{
		// ------------------------------------------------------------------------------------------------------------
		// DETAIL TOUR
		// ------------------------------------------------------------------------------------------------------------		
		$data = Tour::slugIs($tour_slug)->first();

		if (!$data)
		{
			\App::abort(404);
		}
		elseif (!str_is(strtolower($vendor_slug),$data->vendor->slug))
		{
			\App::abort(404);
		}

		// ------------------------------------------------------------------------------------------------------------
		// OTHER TOUR WITH SIMILAR DESTINATION
		// ------------------------------------------------------------------------------------------------------------		
		$other_tours = Tour::scheduledBetween(\Carbon\Carbon::now(), \Carbon\Carbon::now()->addYear(1))
							->inCategories($data->categories->lists('id'))
							->exceptId($data->id)
							->take(12)
							->get();

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page = view($this->page_base_dir . 'tour.show');
		$this->layout->page->tour = $data;
		$this->layout->page->other_tours = $other_tours;
		$this->init_right_sidebar();

		return $this->layout;
	}
}