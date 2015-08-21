<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserTableSeeder::class);
        $this->call(DestinationTableSeeder::class);
        $this->call(TravelAgentTableSeeder::class);
        $this->call(ArticleTableSeeder::class);
        $this->call(TourOptionSeeder::class);
        $this->call(TourSeeder::class);
        $this->call(HeadlineSeeder::class);
        $this->call(HomegridSeeder::class);

        Model::reguard();
    }
}
