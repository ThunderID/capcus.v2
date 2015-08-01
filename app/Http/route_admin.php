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
						'blog' 					=> "BlogController",
						'article_category' 		=> "ArticleCategoryController",
						'vendor' 				=> "VendorController",
						'vendor_category'		=> "VendorCategoryController",
						'tour_destination'		=> "TourCategoryController",
						'tour'	 				=> "TourController",
						'member'	 			=> "MemberController",
						'admin'	 				=> "AdminController",
						'headlines'	 			=> "HeadlineController",
					];

		$additional_routes = [
						'destinations'			=> [],
						'blog'					=> [],
						'article_category'		=> [],
						'vendor'				=> [
													'getSubscription'	=> 'admin.vendor.subscription',
													'postSubscription'	=> 'admin.vendor.subscription.store'],
						'vendor_category'		=> [],
						'tour_destination'		=> [],
						'tour'					=> [
													'getSchedules'	=> 'admin.tour.schedules',
													'postSchedules'	=> 'admin.tour.schedules.store'
												 	],
						'member'				=> [],
						'admin'					=> [],
						'headlines'				=> [],
		];

		foreach ($routes as $k => $v)
		{
			Route::controller($k, $v, $additional_routes[$k] + [
					'getIndex'		=> 'admin.'.$k.'.index',
					'getCreate'		=> 'admin.'.$k.'.create',
					'postStore'		=> 'admin.'.$k.'.store',
					'getEdit'		=> 'admin.'.$k.'.edit',
					'getUpdate'		=> 'admin.'.$k.'.update',
					'getShow'		=> 'admin.'.$k.'.show',
					'getDelete'		=> 'admin.'.$k.'.delete_confirmation',
					'postDelete'	=> 'admin.'.$k.'.delete',
				]);
		}
	});

});