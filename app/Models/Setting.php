<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends BaseModel
{
    //
    use HasNameTrait;

    protected $table 		= 'settings';
	protected $fillable 	= [
									'name', 
									'since', 
									'value', 
								];
	protected $dates 		= ['since'];
	static $name_field 		= 'name';

	// ----------------------------------------------------------------------
	// BOOT
	// ----------------------------------------------------------------------
	static function boot()
	{
		parent::boot();
		Static::observe(new SettingObserver);
	}

}
