<?php

use Illuminate\Database\Seeder;
use \App\Image;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create tags
        //
        for ($i = 1; $i < 500; $i++)
    	{
	    	$destination  = \App\Destination::whereNotNull('parent_id')->orderByRaw('RAND()')->first();
	    	$place_name = 'Place ' . $destination->name . ' ' . $i;
    		$place = new \App\Place([
    							'destination_id' 	=> $destination->id,
    							'name'				=> $place_name,
    							'slug' 				=> str_slug($place_name),
    							'long_name' 		=> $place_name . ', ' . $destination->name,
    							'summary'			=> 'Lorem ipsum Voluptate veniam quis in mollit veniam consequat veniam irure est elit in esse dolore nisi in nulla sint laboris aliqua eu aliquip do.',
    							'content' 			=> 'Lorem ipsum Aliquip aliqua anim in et in labore ut laboris cupidatat dolor dolor aliquip quis aliqua consectetur sit aliquip enim Ut aliquip nulla id ea eu exercitation dolor id cupidatat anim ut aliqua qui amet nisi in aliquip ad sed Excepteur ullamco ut eiusmod cupidatat proident reprehenderit eiusmod aliqua Ut officia Duis aliqua ullamco non reprehenderit ea in velit ad mollit sit consequat culpa consectetur in mollit in aute labore nostrud ea aute Excepteur dolore adipisicing voluptate consequat qui in ea amet aute culpa elit proident dolore mollit tempor non dolor elit aliquip Ut adipisicing tempor elit dolore elit dolor occaecat dolore quis eiusmod sit id exercitation consequat occaecat elit ea consequat veniam Ut ut Excepteur tempor quis anim commodo nisi in do officia Ut enim officia ullamco Ut aute non Excepteur ut ut eu elit est aute ut Duis mollit aliqua laborum ea magna Ut eiusmod velit labore eu qui do officia incididunt non ea in quis in ullamco reprehenderit culpa labore dolore elit deserunt culpa ad laborum cillum sint nisi dolore ad velit aliqua consequat laboris voluptate aute ex dolor minim commodo labore incididunt veniam sunt elit amet dolore aliquip eu nostrud dolor non irure ea aute tempor laborum incididunt sed mollit enim fugiat irure fugiat aute anim do in velit culpa dolore Duis labore culpa laborum Excepteur cillum cupidatat ut dolore esse laborum elit eiusmod officia commodo consectetur consequat aute ea id commodo exercitation nisi occaecat est deserunt dolor proident exercitation ut nostrud cupidatat fugiat minim dolore veniam deserunt nostrud adipisicing minim cupidatat.',
    							'published_at' 		=> \Carbon\Carbon::now()
    						]);
            if (!$place->save())
            {
                dd($place->getErrors());
            }
			$img = rand(1,12);
			$place->images()->saveMany([
										new Image(['name' => 'Gallery1', 'path' => 'http://localhost:8000/images/43/'.(max(1,($img+1)%12)).'.jpg','title' => $place->name, 'description' => $place->summary]),
                                        new Image(['name' => 'Gallery2', 'path' => 'http://localhost:8000/images/43/'.(max(1,($img+2)%12)).'.jpg','title' => $place->name, 'description' => $place->summary]),
                                        new Image(['name' => 'Gallery3', 'path' => 'http://localhost:8000/images/43/'.(max(1,($img+3)%12)).'.jpg','title' => $place->name, 'description' => $place->summary]),
                                        new Image(['name' => 'Gallery4', 'path' => 'http://localhost:8000/images/43/'.(max(1,($img+4)%12)).'.jpg','title' => $place->name, 'description' => $place->summary]),
										new Image(['name' => 'Gallery5', 'path' => 'http://localhost:8000/images/43/'.(max(1,($img+5)%12)).'.jpg','title' => $place->name, 'description' => $place->summary]),
									]);

            $tag_count = rand(1,3);
            $tags = [];
            for ($j = 1; $j < $tag_count; $j++)
            {
                $tags[] = rand(3,10);
            }
            $place->tags()->sync($tags);
    	}

    }
}
