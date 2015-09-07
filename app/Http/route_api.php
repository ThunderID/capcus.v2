<?php

Route::group(['prefix' => 'api', 'namespace' => 'API\\'], function(){

	Route::controller('/article', 'ArticleController', [
			'getLatest' => 'api.article.latest'	
		]);

	// COMPARE TOUR
	Route::group(['prefix' => 'compare'], function(){
		get('/add', ['as' => 'api.compare.add', 'uses' => 'CompareTour@add']);
		get('/remove', ['as' => 'api.compare.remove', 'uses' => 'CompareTour@remove']);
	});

	Route::group(['middleware' => ['auth.user'], 'prefix' => 'me'], function(){
		Route::get('/love_tour',															['uses' => 'LoveTourController@toggle_love', 'as' => 'api.me.love_tour']);
	});


});