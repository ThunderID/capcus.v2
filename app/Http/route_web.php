<?php

Route::group(['namespace' => 'Web\\'], function(){

	get('/',																		['uses' => 'HomeController@index',					'as' => 'web.home']);

	Route::group(['prefix' => 'tour'], function(){
		get('/detail/{travel_agent}/{tour_slug}/{schedule}',						['uses' => 'TourController@show',					'as' => 'web.tour.show']);
		get('/{travel_agent?}/{tujuan?}/{keberangkatan?}/{budget?}',				['uses' => 'TourController@lists',					'as' => 'web.tour']);
	});

	Route::group(['prefix' => 'blog'], function(){
		get('/{page?}',																['uses' => 'BlogController@index',					'as' => 'web.blog']);
		get('/{year}/{month}/{slug}',												['uses' => 'BlogController@show',					'as' => 'web.blog.show']);
	});

	Route::group(['prefix' => 'places'], function(){
		get('/{destination?}',														['uses' => 'PlaceController@index',					'as' => 'web.places']);
		get('/{destination}/{slug}',												['uses' => 'PlaceController@show',					'as' => 'web.places.show']);
	});


	get('/i-am-vendor', 															['uses' => 'AboutController@imvendor', 'as' => 'web.about.imvendor']);
	get('/login/{provider?}',														['uses' => 'AuthController@login',					'as' => 'web.login']);
	get('/login_callback/{provider}',												['uses' => 'AuthController@login_callback',			'as' => 'web.login_callback']);
	post('/login',																	['uses' => 'AuthController@login_post',				'as' => 'web.login.post']);
	get('/logout',																	['uses' => 'AuthController@logout',					'as' => 'web.logout']);

	Route::group(['prefix' => 'travel'], function(){
		get('/',																	['uses' => 'VendorController@lists',				'as' => 'web.vendor']);
	});

	Route::group(['middleware' => ['auth.user'], 'prefix' => 'me'], function(){

		Route::group(['middleware' => 'auth.user.complete'], function() { 
			get('/',																['uses' => 'MeController@index',			'as' => 'web.me.index']);
			// get('/voucher/apply/{vendor}/{tour}/{schedule}',						['uses' => 'VoucherController@generate',	'as' => 'web.voucher.create']);
		});

		get('/profile/edit',														['uses' => 'MeController@edit_profile',		'as' => 'web.me.profile.edit']);
		post('/profile/edit',														['uses' => 'MeController@edit_profile_post','as' => 'web.me.profile.post']);
		post('/update_password',													['uses' => 'MeController@edit_password_post','as' => 'web.me.update_password.post']);
	});

	Route::group(['prefix' => 'subscription'], function(){

		post('/register',															['uses' => 'SubscriptionController@add'		,'as' => 'web.subscription.add']);
		get('/register/success/{email}',											['uses' => 'SubscriptionController@success'	,'as' => 'web.subscription.success']);
		get('/register/fail/{email}',												['uses' => 'SubscriptionController@fail'	,'as' => 'web.subscription.fail']);
	});

});