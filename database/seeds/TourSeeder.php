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
    	with(new \App\Tag(['tag' => 'adventure']))->save();
// DB::enableQueryLog();

        //
         for ($i = 1; $i<= 200; $i++)
	    {
	    	$destination = \App\Destination::whereNotNull('parent_id')->orderByRaw("RAND()")->first();
	    	$destination_id = $destination->id;

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
	    			'slug'				=> str_slug($duration . 'D/' . ($duration-1) . 'N ' . $destination->name . ' ' . $i),
	    			'tag_ids'			=> 1
	    		]);
			if (!$tour->save())
			{
				dd($tour->getErrors());
			}

			$is_fit = rand(0,100) < 20;

			// TOUR DESTINATION
			$tour->destinations()->sync([$destination_id]);

			// PLACES
			$places = \App\Place::whereIn('destination_id', $tour->destinations->lists('id'))->limit($tour->duration_day)->orderByRaw('rand()')->get();
			// $queries = DB::getQueryLog();
			// dd(end($queries));
			if ($places->count())
			{
				$tour->places()->sync($places->lists('id')->toArray());
			}

			// SCHEDULE
			if (!$is_fit)
			{
				$departure = \Carbon\Carbon::now()->startOfMonth()->addDay(rand(0,240));
				$original_price = ($duration * rand(1,10) * 300000);
				$tour->schedules()->saveMany([new \App\TourSchedule([
						'departure'			=> $departure,
						'departure_until'	=> \Carbon\Carbon::parse($departure)->addDay(rand(30, 150)),
						'currency'			=> 'IDR',
						'original_price'	=> $original_price,
						'discounted_price'	=> $original_price * (rand(0,100) <= 20 ? (rand(80,100) / 100) : 1)
					])]);
			}
			else
			{
				for ($j = 1; $j <= rand(3,5); $j++)
				{
					$departure = \Carbon\Carbon::now()->startOfMonth()->addDay(rand(0,240));
					$original_price = ($duration * rand(1,10) * 300000);
					$tour->schedules()->saveMany([new \App\TourSchedule([
							'departure'			=> $departure,
							'departure_until'	=> null,
							'currency'			=> 'IDR',
							'original_price'	=> $original_price,
							'discounted_price'	=> $original_price * (rand(0,100) <= 20 ? (rand(80,100) / 100) : 1)
						])]);
				}
			}


		}
    }
}
