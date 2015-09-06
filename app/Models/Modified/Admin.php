<?php

namespace App;

class Admin extends User
{
	use AdminUserOnlyTrait;

	static function boot()
	{
		parent::boot();
		Static::saving(function($model){
			$model->is_admin = 1;
		});
	}
}
