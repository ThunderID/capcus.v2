<?php namespace App;

use Illuminate\Support\MessageBag;

trait HasManyAddressTrait {

	//------------------------------------------------------------------------
	// BOOT
	//------------------------------------------------------------------------
	function bootHasManyAddressTrait()
	{
	}

	//------------------------------------------------------------------------
	// RELATIONSHIP
	//------------------------------------------------------------------------
	function address()
	{
		return $this->hasMany(__NAMESPACE__ . '\Address');
	}

	//------------------------------------------------------------------------
	// SCOPE
	//------------------------------------------------------------------------
}