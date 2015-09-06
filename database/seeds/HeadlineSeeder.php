<?php

use Illuminate\Database\Seeder;

class HeadlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $headline1 = new \App\Headline(['vendor_id' => 0, 'active_since' => '2015-09-01', 'active_until' => '2015-12-30', 'title' => 'About Capcus', 'link_to' => 'http://localhost:8000/tour', 'priority' => 1]);
       	$headline1->save();
       	$headline1->images()->saveMany([new \App\Image(['path' => 'http://localhost:8000/images/sliders/slider2.jpg', 'name' => 'LargeImage', 'title' => 'About Capcus', 'description' => ''])]);
    }
}
