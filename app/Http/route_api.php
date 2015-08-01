<?php

Route::group(['prefix' => 'api', 'namespace' => 'API\\'], function(){

	Route::controller('/article', 'ArticleController', [
			'getLatest' => 'api.article.latest'	
		]);

	Route::group(['middleware' => ['auth.user'], 'prefix' => 'me'], function(){
		Route::get('/love_tour',															['uses' => 'LoveTourController@toggle_love', 'as' => 'api.me.love_tour']);
	});


});