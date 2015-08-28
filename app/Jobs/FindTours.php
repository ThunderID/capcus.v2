<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Validator;

class FindTours extends Job implements SelfHandling
{
	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct($destination_id = null, $departure_from = null, $departure_to = null, $budget_min = 0, $budget_max = null, $travel_agent_id = null, $place_id = null)
	{
		//
		$this->model = new \App\Tour;

		$this->filters['destination_id'] 			= $destination_id;
		$this->filters['departure_from'] 			= $departure_from;
		$this->filters['departure_to'] 				= $departure_to;
		$this->filters['budget_min'] 				= $budget_min;
		$this->filters['budget_max'] 				= $budget_max;
		$this->filters['travel_agent_id'] 			= $travel_agent_id;
		$this->filters['place_id']		 			= $place_id;
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
		$rules['destination_id']	= ['integer'];
		$rules['departure_from']	= ['date'];
		$rules['departure_to']		= ['date', 'after:departure_from'];
		$rules['budget_min']		= ['integer', 'min:0'];
		$rules['budget_max']		= ['integer', 'after:budget_min'];
		$rules['travel_agent_id']	= ['integer', 'min:0'];
		$rules['place_id']			= ['integer', 'min:0'];

		$validator = Validator::make($this->filters, $rules);
		if ($validator->fails())
		{
			return false;
		}

		//------------------------------------------------------------------------------------------------
		// HANDLE FILTERS
		//------------------------------------------------------------------------------------------------
		// Filter By Destinations
		$q = $this->model->inDestinationsByIds($this->destination_id);

		// Filter By Departure
		$q = $q->scheduled_between($this->filters['departure_from'], $this->filters['departure_to']);

		// Filter By Budget
		$q = $q->budget_between($this->filters['budget_min'], $this->filters['budget_max']);

		// Filter By Travel Agent
		$q = $q->travelAgentByIds($this->filters['travel_agent_id']);

		// Filter By Place
		$q = $q->inPlaceByIds($this->filters['place_id']);

		//------------------------------------------------------------------------------------------------
		// RETURN RESULTS
		//------------------------------------------------------------------------------------------------
		return $q->get();
	}
}
