<?php

namespace App;

class PackageTravelAgent extends BaseModel
{
	use BelongsToTravelAgentTrait, BelongsToPackageTrait;

	//
	protected $table = 'package_travel_agent';
	protected $fillable = [
							'package_id', 
							'travel_agent_id', 
							'active_since', 
							'active_until', 
						];
	protected $dates = ['active_since', 'active_until'];

	// ----------------------------------------------------------------------
	// BOOT
	// ----------------------------------------------------------------------
	static function boot()
	{
		parent::boot();
		Static::observe(new PackageTravelAgentObserver);
	}

	// ----------------------------------------------------------------------
	// SCOPE
	// ----------------------------------------------------------------------
}
