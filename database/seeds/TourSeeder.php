<?php

use Illuminate\Database\Seeder;
use \App\Tour;

class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         for ($i = 1; $i<= 50; $i++)
	    {
	    	$destination_id = rand(1,251);
	    	$destination = \App\Destination::find($destination_id);

	    	// TOUR
	    	$duration = rand(3,12);
	    	$tour = new Tour;
	    	$tour->fill([
	    			'travel_agent_id'	=> rand(1,6),
	    			'name'				=> $duration . 'D/' . ($duration-1) . 'N ' . $destination->name,
	    			'ittinary'			=> 'Lorem ipsum Incididunt ut velit voluptate ullamco occaecat ut laboris ad nulla mollit eu Ut sed do dolor sit aliqua amet dolore dolore laboris occaecat ad nulla mollit minim officia voluptate ex et proident dolore cillum dolore do nostrud et exercitation amet commodo magna ex amet sit minim cillum Duis proident amet consequat amet proident fugiat culpa velit qui eu consequat irure nulla consequat sit laborum est deserunt dolore enim id aliquip nisi pariatur pariatur irure tempor in fugiat consectetur ut deserunt Duis tempor dolor dolore laboris ullamco ullamco amet Duis nostrud amet consequat consequat ea non nisi elit cupidatat esse dolor esse exercitation dolor incididunt voluptate dolore nostrud dolor reprehenderit in cupidatat tempor consectetur cupidatat sed dolor amet deserunt cillum occaecat nulla Duis enim consequat enim tempor adipisicing nisi cillum do sed cupidatat reprehenderit Ut.',
	    			'summary'			=> 'Lorem ipsum Pariatur amet irure labore aute Duis ea irure proident adipisicing adipisicing velit elit in non incididunt ea fugiat exercitation ex enim dolore.',
	    			'duration_day'		=> $duration,
	    			'duration_night'	=> $duration-1,
	    			'published_at'		=> \Carbon\Carbon::now(),
	    			'slug'				=> str_slug($duration . 'D/' . ($duration-1) . 'N ' . $destination->name) . ' ' . $i
	    		]);
			if (!$tour->save())
			{
				dd($tour->getErrors());
			}

			// TOUR DESTINATION
			$tour->destinations()->sync([$destination_id]);

			// SCHEDULE
			for ($j = 1; $j <= rand(3,8); $j++)
			{
				$departure = \Carbon\Carbon::now()->startOfMonth()->addDay(rand(0,240));
				$arrival = \Carbon\Carbon::parse($departure->addDay($duration)->format('Y-m-d H:i:s'))->addDay($duration);
				$original_price = ($duration * rand(1,10) * 300000);
				$tour->schedules()->saveMany([new \App\TourSchedule([
						'departure'		=> $departure,
						'arrival'		=> $arrival,
						'currency'		=> 'IDR',
						'original_price'=> $original_price,
						'discounted_price'=> $original_price * (rand(0,100) <= 20 ? (rand(80,100) / 100) : 1)
					])]);
			}
		}
    }
}
