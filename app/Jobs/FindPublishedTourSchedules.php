<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Validator;

class FindPublishedTourSchedules extends Job implements SelfHandling
{
	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct(
								$departure_from = null, 
								$departure_to = null, 
								$destination_id = null, 
								$budget_min = 0, 
								$budget_max = null, 
								$travel_agent_id = null, 
								$place_slug = null, 
								$skip = 0, 
								$take = null,
								$with_count = false)
	{
		//
		$this->model = new \App\TourSchedule;

		$this->filters['destination_id']            = $destination_id;
		$this->filters['departure_from']            = $departure_from;
		$this->filters['departure_to']              = $departure_to;
		$this->filters['budget_min']                = $budget_min;
		$this->filters['budget_max']                = $budget_max;
		$this->filters['travel_agent_id']           = $travel_agent_id;
		$this->filters['place_slug']                 = $place_slug;
		$this->filters['skip'] 	    	            = $skip;
		$this->filters['take']  	                = $take;
		$this->filters['with_count']                = $with_count;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		//------------------------------------------------------------------------------------------------
		// VALIDATE FILTERS
		//------------------------------------------------------------------------------------------------
		$rules['destination_id']    = [];
		$rules['departure_from']    = ['date'];
		$rules['departure_to']      = ['date', 'after:departure_from'];
		$rules['budget_min']        = ['numeric', 'min:0'];
		$rules['budget_max']        = ['numeric', 'min:0'];
		$rules['travel_agent_id']   = ['numeric', 'min:0'];
		$rules['place_slug']        = [];

		$validator = Validator::make($this->filters, $rules);
		if ($validator->fails())
		{
			dd($validator->messages());
			return false;
		}

		//------------------------------------------------------------------------------------------------
		// HANDLE FILTERS
		//------------------------------------------------------------------------------------------------
		$q = $this->model->newInstance();
		
		// Filter By Departure
		$q = $q->scheduledbetween($this->filters['departure_from'], $this->filters['departure_to']);

		// Filter By Budget
		$q = $q->budgetbetween($this->filters['budget_min'], $this->filters['budget_max']);

		// Filter By Tour
		$destination_id = $this->filters['destination_id'];
		$travel_agent_id = $this->filters['travel_agent_id'];
		$place_slug = $this->filters['place_slug'];

		$q = $q->whereHas('tour', function($q) use ($destination_id, $travel_agent_id, $place_slug) {
				// published, destination, travel agent, place
				$q->published()
					->inDestinationByIds($destination_id)
					->TravelAgentByIds($travel_agent_id)
					->inPlaceBySlug($place_slug);
			});

		//------------------------------------------------------------------------------------------------
		// RETURN RESULTS
		//------------------------------------------------------------------------------------------------

		if (!$this->filters['with_count'])
		{
			if ($this->filters['skip'])
			{
				$q = $q->skip($this->filters['skip']);
			}

			if ($this->filters['take'])
			{
				$q = $q->take($this->filters['take']);
			}
			return $q->oldest('departure')->get();
		}
		else
		{
			$count = $q->count();
			if ($this->filters['skip'])
			{
				$q = $q->skip($this->filters['skip']);
			}

			if ($this->filters['take'])
			{
				$q = $q->take($this->filters['take']);
			}
			$result = $q->oldest('departure')->get();
			
			return ['count' => $q->count(), 'data' => $result];
		}
	}
}
