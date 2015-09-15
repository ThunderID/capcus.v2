<?php namespace App\Http\Controllers\Web;

use Auth, Input, \Illuminate\Support\MessageBag, App, \Illuminate\Support\Collection, Config, Cache, Session;
use App\Tour;
use App\TravelAgent;
use App\Destination;

use App\Jobs\FindPublishedTourSchedules;

class TourController extends Controller {

	public function tag($tag_str)
	{
		// Check tag
		$tag = Cache::remember('tag_str_' . $tag_str, 30, function() use ($tag_str) {
			return \App\Tag::where('tag', $tag_str)->first();
		});
		if (!$tag)
		{
			App::abort(404);
		}

		// ------------------------------------------------------------------------
		// QUERY
		// ------------------------------------------------------------------------
		$max_data = 50;
		$tour_schedules_count = Cache::remember('tours_tag_count_' . $tag_str, 30, function() use ($tag) {
										return \App\TourSchedule::published()
											->scheduledBetween(\Carbon\Carbon::now(), \Carbon\Carbon::now()->addYear(1))
											->InTagByIds($tag->id)
											->count();
								});
	
		$tour_schedules = Cache::remember('tours_tag_' . $tag_str, 30, function() use ($tag, $max_data) {
										$tour_schedules = \App\TourSchedule::published()
											->scheduledBetween(\Carbon\Carbon::now(), \Carbon\Carbon::now()->addYear(1))
											->InTagByIds($tag->id)
											->orderBy('departure')
											->limit($max_data)
											->get();
										$tour_schedules->load('tour', 'tour.places', 'tour.options', 'tour.destinations', 'tour.destinations.images', 'tour.travel_agent', 'tour.travel_agent.images', 'tour.travel_agent.active_packages');
										return $tour_schedules;
						});

		$tour_schedules = $tour_schedules->sortBy(function($data, $key){
			return str_pad($data->tour->travel_agent->active_packages[0]->priority ? $data->tour->travel_agent->active_packages[0]->priority * -1 : 0, 2, 0, STR_PAD_LEFT) . $data->departure;
		});
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
		$this->layout->page->tour_schedules 	= $tour_schedules;
		$this->layout->page->tour_schedules_count= $tour_schedules_count;
		$this->layout->page->max_data 			= $max_data;
		$this->layout->page->tag 				= $tag;
		$this->layout->page->option_list 		= $this->option_list;
		$this->layout->page->filter_schedules 	= $filter_schedules;

		// search tour
		$this->layout->page->all_travel_agents 	= $this->all_travel_agents;
		$this->layout->page->all_destinations 	= $this->all_destinations;
		$this->layout->page->departure_list 	= $this->departure_list;
		$this->layout->page->budget_list 		= $this->budget_list;

		$this->layout->title 					= "Paket Tour " . $tag->tag . ' - Capcus.id';
		$this->layout->og['title'] 				= $this->layout->title;
		$this->layout->og['type'] 				= 'website';
		$this->layout->og['image'] 				= ($tour_schedules->count() ? $tour_schedules->first()->tour->destinations->first()->images->where('name', 'LargeImage')->path : '');
		$this->layout->og['image:type']			= pathinfo('images/'.$this->layout->og['image'], PATHINFO_EXTENSION);
		$this->layout->og['image:width'] 		= 800;
		$this->layout->og['image:height'] 		= 600;
		return $this->layout;	
	}

	public function lists($travel_agent = null, $tujuan = null, $keberangkatan = null, $budget = null)
	{
		// ------------------------------------------------------------------------
		// REDIRECT IF REQUEST URL
		// ------------------------------------------------------------------------
		$filters = Input::only('travel_agent', 'tujuan', 'keberangkatan', 'budget');
		if (!empty(array_filter($filters)))
		{
			$filters = array_filter($filters);

			// Travel Agent
			if (!$filters['travel_agent'])
			{
				$filters['travel_agent'] = 'semua-travel-agent';
			}

			// Tujuan
			if (!$filters['tujuan'])
			{
				$filters['tujuan'] = 'semua-tujuan';
			}

			// Keberangkatan
			if ($filters['keberangkatan'])
			{
				list($tmp1, $tmp2) = explode(" s/d ", $filters['keberangkatan']);

				try {
					$tmp1 = \Carbon\Carbon::createFromFormat('d-m-Y', $tmp1);
					$tmp2 = \Carbon\Carbon::createFromFormat('d-m-Y', $tmp2);
				} catch (Exception $e) {
					return App::abort(404);
				}

				if ($tmp1->lt($tmp2))
				{
					$keberangkatan_str = $tmp1->format('Ymd').'-'.$tmp2->format('Ymd');
				}
				else
				{
					$keberangkatan_str = $tmp2->format('Ymd').'-'.$tmp1->format('Ymd');
				}
			}
			else
			{
				$keberangkatan_str 	= "semua-keberangkatan";
			}

			// Tujuan
			if (!$filters['budget'])
			{
				$filters['budget'] = 'semua-budget';
			}

			return redirect()->to(route('web.tour', [
											'travel_agent' 	=> $filters['travel_agent'], 
											'tujuan' 		=> $filters['tujuan'], 
											'keberangkatan' => $keberangkatan_str, 
											'budget' 		=> $filters['budget']]
										) . (Input::has('place') ? '?place='. Input::get('place') : ''));
		}


		// ------------------------------------------------------------------------
		// PARSE QUERY
		// ------------------------------------------------------------------------
		else
		{
			$filters['travel_agent']			 = $travel_agent;
			$filters['tujuan']					 = $tujuan;
			$filters['keberangkatan']			 = $keberangkatan;
			$filters['budget']					 = $budget;
			$filters['place']					 = Input::get('place');

			// TRAVEL AGENT
			if (str_is(strtolower($filters['travel_agent']), 'semua-travel-agent'))
			{
				unset($filters['travel_agent']);
			}
			else
			{
				if ($filters['travel_agent'])
				{
					$filters['travel_agent'] = TravelAgent::SlugIs($filters['travel_agent'])->first();
					if (!$filters['travel_agent'])
					{
						return App::abort(404);
					}
				}

				$this->layout->basic->filters['travel_agent'] = $filters['travel_agent'];
			}

			// TUJUAN
			if (str_is(strtolower($filters['tujuan']), 'semua-tujuan'))
			{
				unset($filters['tujuan']);
			}
			else
			{
				$tujuan_tree = Destination::findPath(str_replace(',', Destination::getDelimiter(), $filters['tujuan'].'*'))->get();

				if (!$tujuan_tree)
				{
					return App::abort(404);
				}

				// get tujuan object
				foreach ($tujuan_tree as $x)
				{
					if (str_is($filters['tujuan'], $x->path_slug))
					{
						$filters['tujuan'] = $x;
						break;
					}
				}
				$this->layout->basic->filters['tujuan'] = $filters['tujuan'];
			}

			// KEBERANGKATAN
			if (str_is(strtolower($filters['keberangkatan']), 'semua-keberangkatan'))
			{
				unset($filters['keberangkatan']);
				$filters['keberangkatan']['from'] = \Carbon\Carbon::now()->startOfMonth();
				$filters['keberangkatan']['to'] = \Carbon\Carbon::now()->startOfMonth()->addYear(1);
			}
			elseif ($filters['keberangkatan'])
			{
				list($keberangkatan_from, $keberangkatan_to) = explode('-', $filters['keberangkatan']);

				try {
					$keberangkatan_from = \Carbon\Carbon::createFromFormat('Ymd', $keberangkatan_from);
					$keberangkatan_to = \Carbon\Carbon::createFromFormat('Ymd', $keberangkatan_to);
				} catch (Exception $e) {
					App::abort(404);				
				}	

				unset($filters['keberangkatan']);
				$filters['keberangkatan']['from'] 	= $keberangkatan_from;
				$filters['keberangkatan']['to'] 	= $keberangkatan_to;
				$this->layout->basic->filters['keberangkatan'] = $filters['keberangkatan'];
			}
			else
			{
				$filters['keberangkatan']['from'] = \Carbon\Carbon::now()->startOfMonth();
				$filters['keberangkatan']['to'] = \Carbon\Carbon::now()->startOfMonth()->addYear(1);
			}
			
			// BUDGET
			if (str_is(strtolower($filters['budget']), 'semua-budget'))
			{
				unset($filters['budget']);
			}
			else
			{
				list($budget_min, $budget_max) = explode('-', $filters['budget']);

				if ($budget_min * 1 < 0)
				{
					return App::abort(404);
				}

				if (!is_null($budget_max) && ($budget_max <= 0 || $budget_max <= $budget_min))
				{
					return App::abort(404);
				}

				unset($filters['budget']);
				$filters['budget'] = ['min' => $budget_min, 'max' => $budget_max];
				$this->layout->basic->filters['budget'] = $filters['budget'];
			}

			// PLACE
			if ($filters['place'])
			{
				$filters['place'] = \App\Place::slugIs($filters['place'])->first();
				if (!$filters['place'])
				{
					return App::abort(404);
				}
			}
		}

		// ------------------------------------------------------------------------
		// QUERY
		// ------------------------------------------------------------------------
		$max_data = 50;
		$results = Cache::remember('tour_schedules_' . serialize($filters), 30, function() use ($filters, $tujuan_tree, $max_data){
			$results = $this->dispatch(new FindPublishedTourSchedules(
													$filters['from'],
													$filters['to'],
													$tujuan_tree ? $tujuan_tree->lists('id') : null, 
													$filters['budget']['min'] * 1,
													$filters['budget']['max'] ? $filters['budget']['max'] * 1 : 99999999999,
													$filters['travel_agent']->id,
													$filters['place']->slug,
													0,
													$max_data,
													true
												)
									);
			$results['data']->load('tour', 'tour.travel_agent', 'tour.travel_agent.active_packages', 'tour.places', 'tour.destinations', 'tour.travel_agent.images', 'tour.options');
			return $results;
		});
		$tour_schedules_count = $results['count'];
		$tour_schedules = $results['data'];

		// SORT BY TRAVEL AGENT PRIORITY
		// $tour_schedules = $tour_schedules->sortBy(function($data, $key){
		// 	return str_pad($data->tour->travel_agent->active_packages[0]->priority ? $data->tour->travel_agent->active_packages[0]->priority * -1 : 0, 2, 0, STR_PAD_LEFT) . $data->departure;
		// });

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
		$this->layout->page->max_data 			= $max_data;

		$this->layout->page->filters 			= $filters;
		$this->layout->page->filter_schedules 	= $filter_schedules;
		$this->layout->page->option_list 		= $this->option_list;
		$this->layout->page->tour_schedules 	= $tour_schedules;
		$this->layout->page->tour_schedules_count= $tour_schedules_count;
		$this->layout->page->other_tours 		= $other_tours;

		// search tour
		$this->layout->page->all_travel_agents 	= $this->all_travel_agents;
		$this->layout->page->all_destinations 	= $this->all_destinations;
		$this->layout->page->departure_list 	= $this->departure_list;
		$this->layout->page->budget_list 		= $this->budget_list;

		// 
		$this->layout->title 					= "Paket Tour " . 
													($filters['tujuan'] ? 'ke ' . $filters['tujuan']->name : '').
													($filters['travel_agent'] ? ' oleh ' . $filters['travel_agent']->name : '').
													($filters['keberangkatan']['from'] && $filters['keberangkatan']['to'] ? ' keberangkatan ' . $filters['keberangkatan']['from']->format('d-m-Y') . ' s/d ' . $filters['keberangkatan']['to']->format('d-m-Y') : '').
													($filters['budget']['min'] ? ' harga ' . $filters['budget']['min'] . '-' . $filters['budget']['max'] : '') . 
													' - Capcus.id';

		$this->layout->og['title'] 				= $this->layout->title;
		$this->layout->og['type'] 				= 'website';
		$this->layout->og['image'] 				= ($tour_schedules->count() ? $tour_schedules->first()->tour->destinations->first()->images->where('name', 'LargeImage')->path : '');
		$this->layout->og['image:type']			= pathinfo('images/'.$this->layout->og['image'], PATHINFO_EXTENSION);
		$this->layout->og['image:width'] 		= 800;
		$this->layout->og['image:height'] 		= 600;
		return $this->layout;
	}

	public function show($travel_agent_slug, $tour_slug, $schedule)
	{
		// ------------------------------------------------------------------------------------------------------------
		// DETAIL TOUR
		// ------------------------------------------------------------------------------------------------------------		
		$tour = Cache::remember('tour_by_slug_' . $travel_agent_slug . $tour_slug . $schedule, 30, function() use ($tour_slug) {
			$tour = Tour::slugIs($tour_slug)->first();
			if ($tour)
			{
				$tour->load('schedules', 
							'travel_agent', 'travel_agent.images', 
							'places', 'places.images', 'places.destination',
							'destinations' );
			}
			return $tour;
		}); 
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
		foreach ($tour->schedules as $x)
		{
			if ($x->departure->format('Ymd') == \Carbon\Carbon::parse(substr($schedule, 0, 4) . '-' . substr($schedule, 4, 2) . '-' . substr($schedule, 6, 2))->format('Ymd'))
			{
				$tour_schedule = $x;
				break;
			}
		}

		$tour_schedule->views++;
		$tour_schedule->save();

		// ------------------------------------------------------------------------------------------------------------
		// OTHER TOUR WITH SIMILAR DESTINATION
		// ------------------------------------------------------------------------------------------------------------		
		$other_tours['by_destination'] = Cache::remember('related_tour_schedules_by_destination_of_' . $tour_schedule->id , 30, function() use ($tour, $tour_schedule) {
			$data = $this->dispatch(new FindPublishedTourSchedules(
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
			$data->load('tour', 
						'tour.travel_agent', 'tour.travel_agent.images', 'tour.travel_agent.active_packages', 
						'tour.places', 'tour.places.images',
						'tour.destinations', 
						'tour.options');
			return $data;
		});

		// ------------------------------------------------------------------------------------------------------------
		// OTHER TOUR BY DEPARTURE
		// ------------------------------------------------------------------------------------------------------------		
		$other_tours['by_departure'] = Cache::remember('related_tour_schedules_by_departure_of_' . $tour_schedule->id , 30, function() use ($tour, $tour_schedule) {
			$data = $this->dispatch(new FindPublishedTourSchedules(
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
			$data->load('tour', 'tour.travel_agent','tour.travel_agent.active_packages', 'tour.places', 'tour.destinations', 'tour.travel_agent.images', 'tour.options');
			return $data;
		});


		// ------------------------------------------------------------------------------------------------------------
		// OTHER TOUR BY BUDGET 
		// ------------------------------------------------------------------------------------------------------------		
		$other_tours['by_budget'] = Cache::remember('related_tour_schedules_by_budget_of_' . $tour_schedule->id , 30, function() use ($tour, $tour_schedule) {
			$data = $this->dispatch(new FindPublishedTourSchedules(
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
			$data->load('tour', 'tour.travel_agent','tour.travel_agent.active_packages', 'tour.places', 'tour.places.destination', 'tour.places.images', 'tour.destinations', 'tour.travel_agent.images', 'tour.options');
			return $data;
		});


		// ------------------------------------------------------------------------------------------------------------
		// REMOVE CURRENT TOUR SCHEDULE IN OTHER TOUR
		// ------------------------------------------------------------------------------------------------------------
		$current_schedule_id = $tour_schedule->id;
		foreach ($other_tours as $k => $v)
		{
			if ($v)
			{
				$other_tours[$k] = $v->reject(function($item) use ($k, $current_schedule_id) {
					return $item->id == $current_schedule_id;
				});
			}
		}

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page = view($this->page_base_dir . 'tour_detail');
		$this->layout->page->tour 			= $tour;
		$this->layout->page->tour_schedule	= $tour_schedule;
		$this->layout->page->other_tours 	= $other_tours;
		$this->layout->page->option_list 	= $this->option_list;

		$this->layout->title 					= "Paket Tour " . $tour->name . 
															' oleh ' . $tour->travel_agent->name . 
															' tgl ' . (is_null($tour_schedule->departure_until) ? $tour_schedule->departure->format('d-m-Y') : ' keberangkatan kapanpun antara ' . $tour_schedule->departure->format('d-m-Y') . ' s/d ' . $tour_schedule->departure_until->format('d-m-Y')) .
															' - Capcus.id'
															;

		// 
		$this->layout->title 					= "Capcus.id - Cari tour tidak lagi ribet";
		$this->layout->og['title'] 				= $this->layout->title;
		$this->layout->og['type'] 				= 'article';
		$this->layout->og['image'] 				= ($tour->destinations->first() ? $tour->destinations->first()->images('name', 'LargeImage')->path : asset('images/logo/logo-new.png'));
		$this->layout->og['image:type']			= pathinfo('images/'.$this->layout->og['image'], PATHINFO_EXTENSION);
		$this->layout->og['image:width'] 		= 800;
		$this->layout->og['image:height'] 		= 600;
		$this->layout->og['article:published_time']	= $tour->published_at->format('Y-m-d H:i:s');
		$this->layout->og['article:section']	= 'paket tour';
		$this->layout->og['article:tag']		= implode(', ', $tour->destinations->lists('name'));
		return $this->layout;
	}

	public function compare($id_list = null)
	{
		if (!is_null($id_list))
		{
			$ids = explode(',', $id_list);
		}
		elseif (Session::has('compare_cart'))
		{
			$ids = Session::get('compare_cart');
		}
		else
		{
			return App::abort(404);
		}

		// get data
		$tour_schedules = \App\TourSchedule::whereIn('id', $ids)->get();
		$tour_schedules->load('tour', 'tour.travel_agent', 'tour.travel_agent.images');

		if (count($ids) != $tour_schedules->count()){
			return App::abort(404);
		}

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page = view($this->page_base_dir . 'tour_compare');
		$this->layout->page->tour_schedules 			= $tour_schedules;
		$this->layout->page->option_list 				= $this->option_list;

		return $this->layout;
	}
}