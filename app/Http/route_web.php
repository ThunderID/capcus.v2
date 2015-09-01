<?php

Route::group(['namespace' => 'Web\\'], function(){


	get('/',																		['uses' => 'HomeController@index',					'as' => 'web.home']);

	Route::group(['prefix' => 'tour'], function(){
		get('/tag/{tag}',															['uses' => 'TourController@tag',					'as' => 'web.tour.tag']);
		get('/detail/{travel_agent}/{tour_slug}/{schedule}',						['uses' => 'TourController@show',					'as' => 'web.tour.show']);
		get('/{travel_agent?}/{tujuan?}/{keberangkatan?}/{budget?}',				['uses' => 'TourController@lists',					'as' => 'web.tour']);
	});

	Route::group(['prefix' => 'blog'], function(){
		get('/{page?}',																['uses' => 'BlogController@index',					'as' => 'web.blog']);
		get('/{year}/{month}/{slug}',												['uses' => 'BlogController@show',					'as' => 'web.blog.show']);
	});

	Route::group(['prefix' => 'places'], function(){
		get('/detail/{destination}/{slug}',											['uses' => 'PlaceController@show',					'as' => 'web.places.show']);
		get('/{destination?}/{tag?}/{page?}',										['uses' => 'PlaceController@index',					'as' => 'web.places']);
	});

	// get('/contact-us', 															['uses' => 'AboutController@contactus', 			'as' => 'web.about.contactus']);
	// post('/contact-us',															['uses' => 'AboutController@contactus_post', 		'as' => 'web.about.contactus.post']);
	// post('/contact-us-sent',														['uses' => 'AboutController@contactus_success', 	'as' => 'web.about.contactus.success']);

	get('/i-am-vendor', 															['uses' => 'AboutController@imvendor', 				'as' => 'web.about.imvendor']);
	get('/tnc',			 															['uses' => 'AboutController@tnc',	 				'as' => 'web.about.tnc']);
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

		Route::group(['prefix' => 'profile'], function() { 
			Route::group(['prefix' => 'complete_profile'], function() {
				get('/',															['uses' => 'MeController@complete_profile',			'as' => 'web.me.profile.complete']);
				post('/',															['uses' => 'MeController@complete_profile_post',	'as' => 'web.me.profile.complete.post']);
				get('/completed',													['uses' => 'MeController@completed_profile',		'as' => 'web.me.profile.completed']);
			});
		});

		get('/profile/edit',														['uses' => 'MeController@edit_profile',		'as' => 'web.me.profile.edit']);
		post('/profile/edit',														['uses' => 'MeController@edit_profile_post','as' => 'web.me.profile.post']);
		post('/update_password',													['uses' => 'MeController@edit_password_post','as' => 'web.me.update_password.post']);
	});

	// SUBSCRIPTION
	Route::group(['prefix' => 'subscription'], function(){
		post('/',																	['uses' => 'SubscriptionController@add'		,'as' => 'web.subscription.add']);
		get('/success/{subscriber_id}',												['uses' => 'SubscriptionController@success'	,'as' => 'web.subscription.success']);
		get('/unsubscribe/{id}/{token}',											['uses' => 'SubscriptionController@unsubscribe'	,'as' => 'web.subscription.unsubscribe']);
	});

	// NEWSLETTER
	Route::group(['prefix' => 'newsletter'], function() {
		get('/send',																['uses' => 'NewsletterController@send',			'as' => 'web.newsletter.send']);
	}); 

});