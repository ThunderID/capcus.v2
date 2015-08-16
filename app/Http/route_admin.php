<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin\\'], function(){

	Route::get('/', 					['uses' => 'LoginController@getLogin',					'as' => 'admin.login']);
	Route::post('/login', 				['uses' => 'LoginController@postLogin',					'as' => 'admin.login.post']);
	Route::get('/logout', 				['uses' => 'LoginController@getLogout',					'as' => 'admin.logout']);

	Route::group(['middleware' => 'auth.admin'], function(){
		Route::controller('dashboard', 'DashboardController', [
				'getIndex'		=> 'admin.dashboard'
			]);

		Route::controller('me', 'MeController', [
				'getUpdatePassword'		=> 'admin.me.update_password',
				'postUpdatePassword'	=> 'admin.me.update_password.post'
			]);

		$routes = [	
						'destinations'			=> "DestinationController",
						'places'				=> "PlaceController",
						'articles' 				=> "ArticleController",
						'travel_agents'			=> "TravelAgentController",
						'tours'					=> "TourController",
						'tour_options'			=> "TourOptionController",
						'admin'	 				=> "AdminController",
						'members'	 			=> "MemberController",
					];

		$additional_routes = [
						'destinations'			=> [],
						'places'				=> [],
						'articles'				=> [],
						'travel_agents'			=> [],
						'tours'					=> [
													'getSchedules'	=> 'admin.tours.schedules',
													'postSchedules'	=> 'admin.tours.schedules.store',
													'getDeleteSchedule'	=> 'admin.tours.schedules.delete'
													],
						'tour_options'			=> [],
						'admin'					=> [],
						'members'				=> [],
		];

		foreach ($routes as $k => $v)
		{
			Route::controller($k, $v, $additional_routes[$k] + [
					'getIndex'		=> 'admin.'. str_replace('/', '.', $k) .'.index',
					'getCreate'		=> 'admin.'. str_replace('/', '.', $k) .'.create',
					'postStore'		=> 'admin.'. str_replace('/', '.', $k) .'.store',
					'getEdit'		=> 'admin.'. str_replace('/', '.', $k) .'.edit',
					'getUpdate'		=> 'admin.'. str_replace('/', '.', $k) .'.update',
					'getShow'		=> 'admin.'. str_replace('/', '.', $k) .'.show',
					'getDelete'		=> 'admin.'. str_replace('/', '.', $k) .'.delete_confirmation',
					'postDelete'	=> 'admin.'. str_replace('/', '.', $k) .'.delete',
				]);
		}

		// CONFIGURE HOMEPAGE

		Route::group(['prefix' => 'settings'], function() { 
			
			Route::group(['prefix' => 'homepage'], function() { 
			
				Route::get('/'		, ['uses' => 'SettingHomeController@index', 'as' => 'admin.settings.home.index']);

				// Headline
				Route::group(['prefix' => 'headlines'], function(){
					Route::get('/index',	 	['uses' => 'SettingHomeController@HeadlineIndex', 	'as' => 'admin.settings.home.headlines.index']);
					Route::get('/create',	 	['uses' => 'SettingHomeController@HeadlineCreate', 	'as' => 'admin.settings.home.headlines.create']);
					Route::get('/edit/{id}', 	['uses' => 'SettingHomeController@HeadlineEdit', 	'as' => 'admin.settings.home.headlines.edit']);
					Route::get('/show/{id}', 	['uses' => 'SettingHomeController@HeadlineShow', 	'as' => 'admin.settings.home.headlines.show']);
					Route::get('/delete/{id}', 	['uses' => 'SettingHomeController@HeadlineDelete', 	'as' => 'admin.settings.home.headlines.delete_confirmation']);
					Route::post('/store/{id?}', 	['uses' => 'SettingHomeController@HeadlineStore', 	'as' => 'admin.settings.home.headlines.store']);
					Route::post('/delete/{id?}', 	['uses' => 'SettingHomeController@HeadlinePostDelete', 	'as' => 'admin.settings.home.headlines.delete']);
				});

			
				// Homegrid
				Route::group(['prefix' => 'homegrids'], function(){
					Route::get('/index',	 	['uses' => 'SettingHomeController@HomegridsIndex', 				'as' => 'admin.settings.home.homegrids.index']);
					Route::get('/edit/{id}', 	['uses' => 'SettingHomeController@HomegridsEdit', 				'as' => 'admin.settings.home.homegrids.edit']);
					Route::post('/store/{homegrid_no}', ['uses' => 'SettingHomeController@HomegridsStore', 			'as' => 'admin.settings.home.homegrids.store']);
				});
			
			});
		});
	});

});