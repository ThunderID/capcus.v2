<?php

use Illuminate\Database\Seeder;

class TourOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $options = [
	        ['name' => 'Hotel'],
	        ['name' => 'Meals'],
	        ['name' => 'Flight'],
	        ['name' => 'Tipping'],
	        ['name' => 'Visa'],
	        ['name' => 'Airport Tax'],
	        ['name' => 'Minibar'],
	        ['name' => 'Laundry'],
        ];

        foreach ($options as $x)
        {
        	$to = new \App\TourOption;
        	$to->fill($x);
        	if (!$to->save())
        	{
        		dd($to->getErrors());
        	}
        }
    }
}
