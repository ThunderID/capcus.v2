<?php

use Illuminate\Database\Seeder;
use \App\Image;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i = 1; $i < 500; $i++)
    	{
    		$blog = new \App\Article([
    							'writer_id' => 1,
                                'title'     => 'Blog ' . $i,
    							'slug' 	     => str_slug('Blog ' . $i),
    							'summary' 	=> 'Lorem ipsum Pariatur labore Ut consequat aliquip sint eiusmod ea exercitation in ad magna in veniam elit dolor eu pariatur reprehenderit aliqua et esse.',
    							'content' 	=> 'Lorem ipsum Aliquip aliqua anim in et in labore ut laboris cupidatat dolor dolor aliquip quis aliqua consectetur sit aliquip enim Ut aliquip nulla id ea eu exercitation dolor id cupidatat anim ut aliqua qui amet nisi in aliquip ad sed Excepteur ullamco ut eiusmod cupidatat proident reprehenderit eiusmod aliqua Ut officia Duis aliqua ullamco non reprehenderit ea in velit ad mollit sit consequat culpa consectetur in mollit in aute labore nostrud ea aute Excepteur dolore adipisicing voluptate consequat qui in ea amet aute culpa elit proident dolore mollit tempor non dolor elit aliquip Ut adipisicing tempor elit dolore elit dolor occaecat dolore quis eiusmod sit id exercitation consequat occaecat elit ea consequat veniam Ut ut Excepteur tempor quis anim commodo nisi in do officia Ut enim officia ullamco Ut aute non Excepteur ut ut eu elit est aute ut Duis mollit aliqua laborum ea magna Ut eiusmod velit labore eu qui do officia incididunt non ea in quis in ullamco reprehenderit culpa labore dolore elit deserunt culpa ad laborum cillum sint nisi dolore ad velit aliqua consequat laboris voluptate aute ex dolor minim commodo labore incididunt veniam sunt elit amet dolore aliquip eu nostrud dolor non irure ea aute tempor laborum incididunt sed mollit enim fugiat irure fugiat aute anim do in velit culpa dolore Duis labore culpa laborum Excepteur cillum cupidatat ut dolore esse laborum elit eiusmod officia commodo consectetur consequat aute ea id commodo exercitation nisi occaecat est deserunt dolor proident exercitation ut nostrud cupidatat fugiat minim dolore veniam deserunt nostrud adipisicing minim cupidatat.',
    							'published_at' => \Carbon\Carbon::now()
    						]);
			if (!$blog->save())
            {
                dd($blog->getErrors());
            }
			$img = rand(1,12);
			$blog->images()->saveMany([
										new Image(['name' => 'SmallImage', 'path' => 'http://localhost:8000/images/43/'.$img.'.jpg','title' => $blog->title, 'description' => $blog->summary]),
										new Image(['name' => 'LargeImage', 'path' => 'http://localhost:8000/images/43/'.$img.'.jpg','title' => $blog->title, 'description' => $blog->summary]),
									]);
    	}
    }
}
