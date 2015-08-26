<?php namespace App;

use Illuminate\Support\MessageBag;

trait BelongsToPackageTrait {

	protected $package_id;

	//------------------------------------------------------------------------
	// BOOT
	//------------------------------------------------------------------------
	function bootBelongsToPackageTrait()
	{
		Static::observe(new BelongsToPackageObserver);
	}

	//------------------------------------------------------------------------
	// RELATIONSHIP
	//------------------------------------------------------------------------
	function package()
	{
		return $this->belongsTo(__NAMESPACE__ . '\Package');
	}

	//------------------------------------------------------------------------
	// SCOPE
	//------------------------------------------------------------------------
	function scopePackageByIds($q, $v = null)
	{
		if (!$v || (is_array($v) && empty($v)))
		{
			return $q;
		}
		else
		{
			return $q->whereHas('package', function($q) use ($v) {
				$q->whereIn('id', is_array($v) ? $v : [$v]);
			});
		}
	}
}
