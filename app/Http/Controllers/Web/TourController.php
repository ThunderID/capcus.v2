<?php namespace App\Http\Controllers\Web;

use Auth, Input, \Illuminate\Support\MessageBag, App, \Illuminate\Support\Collection, Config;
use App\Tour;
use App\TravelAgent;
use App\Destination;

use App\Jobs\FindPublishedTourSchedules;

class TourController extends Controller {

	public function lists($travel_agent = null, $tujuan = null, $keberangkatan = null, $budget = null)
	{
		// ------------------------------------------------------------------------
		// REDIRECT IF REQUEST URL
		// ------------------------------------------------------------------------
		if (Input::has('travel_agent') || Input::has('tujuan') || Input::has('keberangkatan') || Input::has('budget'))
		{
			$travel_agent 	= Input::get('travel_agent') 	? Input::get('travel_agent') 	: "semua-travel-agent";
			$tujuan 		= Input::get('tujuan') 			? Input::get('tujuan') 			: "semua-tujuan";
			$keberangkatan 	= Input::get('keberangkatan') 	? Input::get('keberangkatan') 	: "semua-keberangkatan";
			$budget 		= Input::get('budget') 			? Input::get('budget') 			: "semua-budget";

			return redirect()->route('web.tour', ['travel_agent' => $travel_agent, 'tujuan' => $tujuan, 'keberangkatan' => $keberangkatan, 'budget' => $budget]);
		}
		// ------------------------------------------------------------------------
		// PARSE SEARCH
		// ------------------------------------------------------------------------
		else
		{
			if (str_is(strtolower($travel_agent), 'semua-travel-agent'))
			{
				unset($travel_agent);
			}
			else
			{
				$this->layout->basic->filters['travel_agent'] = $travel_agent;
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
		// CHECK travel_agent
		// ------------------------------------------------------------------------
		if ($travel_agent)
		{
			$travel_agent = TravelAgent::SlugIs($travel_agent)->first();
			if (!$travel_agent)
			{
				return App::abort(404);
			}
		}

		if ($tujuan)
		{
			$tujuan_tree = Destination::findPath(str_replace(',', Destination::getDelimiter(), $tujuan.'*'))->get();

			if (!$tujuan_tree)
			{
				return App::abort(404);
			}

			// get tujuan object
			foreach ($tujuan_tree as $x)
			{
				if (str_is($tujuan, $x->path_slug))
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
		if ($keberangkatan_year && $keberangkatan_month)
		{
			$departure_from = \Carbon\Carbon::createFromDate($keberangkatan_year, $keberangkatan_month, 1);
			$departure_to = \Carbon\Carbon::createFromDate($keberangkatan_year, $keberangkatan_month, 1)->endofmonth();
		}
		else
		{
			$departure_from = \Carbon\Carbon::now();
			$departure_to = \Carbon\Carbon::now()->endofmonth();
		}

		$tour_schedules = $this->dispatch(new FindPublishedTourSchedules(
												$departure_from,
												$departure_to,
												$tujuan_tree ? $tujuan_tree->lists('id') : null, 
												$budget['min'] * 1,
												$budget['max'] ? $budget['max'] * 1 : 99999999999,
												$travel_agent->id
											)
								);
		$tour_schedules->load('tour', 'tour.travel_agent', 'tour.places', 'tour.destinations', 'tour.travel_agent.images', 'tour.options');

		// ------------------------------------------------------------------------
		// PREPARE FILTERS FOR RESULTS
		// ------------------------------------------------------------------------
		$filter_schedules = [];

		// durations
		foreach ($tour_schedules as $schedule)
		{
			$filter_schedules['durations'][$schedule->tour->duration_day * 1] = $schedule->tour->duration_day . 'D/' . $schedule->tour->duration_night . 'N';
			$filter_schedules['travel_agents'][$schedule->tour->travel_agent->id] = $schedule->tour->travel_agent->name;
			if ((!$filter_schedules['price']['min']) || ($filter_schedules['price']['min'] > $schedule->discounted_price))
			{
				$filter_schedules['price']['min'] = $schedule->discounted_price;
			}
			if ($filter_schedules['price']['max'] < $schedule->discounted_price)
			{
				$filter_schedules['price']['max'] = $schedule->discounted_price;
			}
		}

		ksort($filter_schedules['durations']);
		asort($filter_schedules['travel_agents']);
		
		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page = view($this->page_base_dir . 'tours');
		$this->layout->page->travel_agent 		= $travel_agent;
		$this->layout->page->tujuan_tree 		= $tujuan_tree;
		$this->layout->page->tujuan 			= $tujuan;
		$this->layout->page->keberangkatan 		= $keberangkatan;
		$this->layout->page->budget 			= $budget;
		$this->layout->page->tour_schedules 	= $tour_schedules;
		$this->layout->page->filter_schedules 	= $filter_schedules;
		$this->layout->page->other_tours 		= $other_tours;

		// search tour
		$this->layout->page->all_travel_agents 	= $this->all_travel_agents;
		$this->layout->page->all_destinations 	= $this->all_destinations;
		$this->layout->page->departure_list 	= $this->departure_list;
		$this->layout->page->budget_list 		= $this->budget_list;

		return $this->layout;
	}

	public function show($travel_agent_slug, $tour_slug, $schedule)
	{
		// ------------------------------------------------------------------------------------------------------------
		// DETAIL TOUR
		// ------------------------------------------------------------------------------------------------------------		
		$tour = Tour::slugIs($tour_slug)->first();
		if (!$tour)
		{
			\App::abort(404);
		}

		// check travel agent
		if (!str_is(strtolower($travel_agent_slug),$tour->travel_agent->slug))
		{
			\App::abort(404);
		}

		
		// get schedule
		$tour_schedule = $tour->schedules()->where('departure', \Carbon\Carbon::createFromDate(substr($schedule, 0, 4), substr($schedule, 4, 2), substr($schedule, 6, 2))->format('Y-m-d'))->first();
		$tour_schedule->load('tour','tour.schedules','tour.travel_agent','tour.schedules.tour', 'tour.schedules.tour.travel_agent');

		// ------------------------------------------------------------------------------------------------------------
		// OTHER TOUR WITH SIMILAR DESTINATION
		// ------------------------------------------------------------------------------------------------------------		
		$other_tours['by_destination'] = $this->dispatch(new FindPublishedTourSchedules(
												\Carbon\Carbon::parse($tour_schedule->departure)->SubDay(30),
												\Carbon\Carbon::parse($tour_schedule->departure)->addDay(30),
												$tour->destinations->lists('id')->toArray(),
												0,
												999999999,
												null,
												null,
												0,
												15
											)
								);

		$other_tours['by_destination']->load('tour', 'tour.travel_agent', 'tour.places', 'tour.destinations', 'tour.travel_agent.images', 'tour.options');

		// ------------------------------------------------------------------------------------------------------------
		// OTHER TOUR BY DEPARTURE
		// ------------------------------------------------------------------------------------------------------------		
		$other_tours['by_departure'] = $this->dispatch(new FindPublishedTourSchedules(
												\Carbon\Carbon::parse($tour_schedule->departure)->SubDay(3),
												\Carbon\Carbon::parse($tour_schedule->departure)->addDay(3),
												null, 
												0, 
												999999999,
												null, 
												null, 
												0, 
												15)
								);

		$other_tours['by_departure']->load('tour', 'tour.travel_agent', 'tour.places', 'tour.destinations', 'tour.travel_agent.images', 'tour.options');

		// ------------------------------------------------------------------------------------------------------------
		// OTHER TOUR BY BUDGET 
		// ------------------------------------------------------------------------------------------------------------		
		$other_tours['by_budget'] = $this->dispatch(new FindPublishedTourSchedules(
												\Carbon\Carbon::parse($tour_schedule->departure)->SubDay(30),
												\Carbon\Carbon::parse($tour_schedule->departure)->addDay(30),
												null,
												($tour_schedule->discounted_price * 80/100),
												($tour_schedule->discounted_price * 120/100),
												null,
												null,
												0,
												15
											)
								);

		$other_tours['by_budget']->load('tour', 'tour.travel_agent', 'tour.places', 'tour.destinations', 'tour.travel_agent.images', 'tour.options');
		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page = view($this->page_base_dir . 'tour_detail');
		$this->layout->page->tour 			= $tour;
		$this->layout->page->tour_schedule	= $tour_schedule;
		$this->layout->page->other_tours 	= $other_tours;
		// $this->init_right_sidebar();

		return $this->layout;
	}
}