<?php

use Illuminate\Database\Seeder;

class HomegridSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$top_tours = DB::select("select d.id, count(ts.id) as aggregate
						    	from destinations d 
                                join destination_tour dt on dt.destination_id = d.id
                                join tours t on t.id = dt.tour_id
                                join tour_schedules ts on ts.tour_id = t.id
						    	group by d.id
						    	order by aggregate desc
						    	limit 12"
					);

    	foreach ($top_tours as $k => $x)
    	{
    		$destination = \App\Destination::find($x->id);

    		$headline = new \App\HomegridSetting(['name' => 'homegrid_' . ($k+1), 'since' => \Carbon\Carbon::now()]);
            $headline->type = 'destination';
    		$headline->is_featured = rand(0,100) < 30 ? true : false;
    		$headline->title = $destination->long_name;
    		$headline->destination = $destination->id;
    		$headline->image_url = 'http://localhost:8000/images/43/' . ($k+1) . '.jpg';

            if (!$headline->save())
            {
                dd($headline->getErrors());
            }

    	}
    }
}
