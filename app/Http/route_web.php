<?php

Route::group(['namespace' => 'Web\\'], function(){

	Route::get('/',																			['uses' => 'HomeController@index',					'as' => 'web.home']);
	// Route::get('/',																			['uses' => 'HomeController@index2',					'as' => 'web.home']);

	Route::group(['prefix' => 'tour'], function(){
		Route::get('/detail/{vendor_slug}/{tour_slug}',										['uses' => 'TourController@show',					'as' => 'web.tour.show']);
		Route::get('/{vendor?}/{tujuan?}/{keberangkatan?}/{budget?}',						['uses' => 'TourController@lists',					'as' => 'web.tour']);
	});

	Route::group(['prefix' => 'blog'], function(){
		Route::get('/',																		['uses' => 'BlogController@index',					'as' => 'web.blog']);
		Route::get('/{year}/{month}/{slug}',												['uses' => 'BlogController@show',					'as' => 'web.blog.show']);
	});

	Route::get('/login/{provider?}',														['uses' => 'AuthController@login',					'as' => 'web.login']);
	Route::get('/login_callback/{provider}',												['uses' => 'AuthController@login_callback',			'as' => 'web.login_callback']);
	Route::post('/login',																	['uses' => 'AuthController@login_post',				'as' => 'web.login.post']);
	Route::get('/logout',																	['uses' => 'AuthController@logout',					'as' => 'web.logout']);

	Route::group(['prefix' => 'travel'], function(){
		Route::get('/',																		['uses' => 'VendorController@lists',				'as' => 'web.vendor']);
	});

	Route::group(['middleware' => ['auth.user'], 'prefix' => 'me'], function(){

		Route::group(['middleware' => 'auth.user.complete'], function() { 
			Route::get('/',																	['uses' => 'MeController@index',			'as' => 'web.me.index']);
			Route::get('/voucher/apply/{vendor}/{tour}/{schedule}',							['uses' => 'VoucherController@generate',	'as' => 'web.voucher.create']);
		});

		Route::get('/profile/edit',															['uses' => 'MeController@edit_profile',		'as' => 'web.me.profile.edit']);
		Route::post('/profile/edit',														['uses' => 'MeController@edit_profile_post','as' => 'web.me.profile.post']);
		Route::post('/update_password',														['uses' => 'MeController@edit_password_post','as' => 'web.me.update_password.post']);
	});

	Route::group(['prefix' => 'subscription'], function(){

		Route::post('/register',														['uses' => 'SubscriptionController@add'		,'as' => 'web.subscription.add']);
		Route::get('/register/success/{email}',											['uses' => 'SubscriptionController@success'	,'as' => 'web.subscription.success']);
		Route::get('/register/fail/{email}',											['uses' => 'SubscriptionController@fail'	,'as' => 'web.subscription.fail']);
	});

});