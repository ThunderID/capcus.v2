<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use Exception;
use DB;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
		Validator::extend('no_overlapping_date_range', function($attribute, $value, $parameters) {
			if (count($parameters) < 5)
			{
				throw new Exception("no_overlapping_active_date: require min 5 parameters: table, field_since, field_until, since_value, until_value, where_field, where_condition, where_val, ...", 1);
			}

			$table = $parameters[0];
			$since_field = $parameters[1];
			$until_field = $parameters[2];
			$since = \Carbon\Carbon::parse($parameters[3]);
			$until = \Carbon\Carbon::parse($parameters[4]);
			
			$q = DB::table($table)->where(function($q) use ($since_field, $until_field, $since, $until) {
								$q->where(function($q) use($since_field, $until_field, $since, $until) { 
											$q->where($since_field, '<=', $since)->where($until_field, '>=', $since);
									})
								->orwhere(function($q) use($since_field, $until_field, $since, $until) { 
											$q->where($since_field, '<=', $since)->where($until_field, '>=', $until);
									})
								->orwhere(function($q) use($since_field, $until_field, $since, $until) { 
											$q->where($since_field, '>=', $since)->where($since_field, '<=', $until);
									});
							});

			for ($i = 5; $i < count($parameters); $i+=3)
			{
				if ($parameters[$i] && $parameters[$i+1] && $parameters[$i+2])
				{
					$q->where($parameters[$i], $parameters[$i+1], $parameters[$i+2]);
				}
			}

			return $q->count() == 0;
		});
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}
