<?php

use Illuminate\Database\Seeder;
use \App\Tour;

class TravelAgentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data = ['Panorama Tour', 'Smailing Tour', 'Dwidaya Tour', 'Kaha Tour', 'Avia Tour', 'Bayu Buana Tour'];
        //
	    foreach ($data as $k => $x)
	    {
	    	// TOUR
	    	$travel = new \App\TravelAgent;
	    	$travel->fill([
	    			'name'	=> $x,
	    			'email'	=> 'book@' . strtolower(camel_case(str_replace(' ', '', $x))) . '.com',
	    			'address' => 'Jl Jenderal Sudirman No 1 Jakarta',
	    			'phone'	=> '021-' . rand(9000000, 9999999)
	    		]);
	    	if (!$travel->save())
	    	{
	    		dd($travel->email . '' . $travel->getErrors());
	    	}

			// TOUR DESTINATION
			$travel->images()->saveMany([
				new \App\Image(['name' => 'SmallLogo', 'path' => 'http://localhost:8000/images/logo/' . ($k+1) . '.png', 'title' => $x, 'description' => 'Logo ' . $x ]),
				new \App\Image(['name' => 'LargeLogo', 'path' => 'http://localhost:8000/images/logo/' . ($k+1) . '.png', 'title' => $x, 'description' => 'Logo ' . $x ])
			]);
        }
    }
}
