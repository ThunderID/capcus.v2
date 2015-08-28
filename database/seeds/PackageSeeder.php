<?php

use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        with(new \App\Package(['name' => 'Diamond', 'slug' => 'diamond', 'priority' => 100, 'quota_headline' => 5]))->save();
        with(new \App\Package(['name' => 'Gold', 'slug' => 'gold', 'priority' => 75, 'quota_headline' => 4]))->save();
        with(new \App\Package(['name' => 'Silver', 'slug' => 'silver', 'priority' => 50, 'quota_headline' => 3]))->save();
        with(new \App\Package(['name' => 'Bronze', 'slug' => 'bronze', 'priority' => 25, 'quota_headline' => 2]))->save();
    }
}
