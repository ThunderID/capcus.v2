<?php namespace App;

use Illuminate\Support\MessageBag;

trait BelongsToManyPackagesTrait {

	protected $package_ids;

	//------------------------------------------------------------------------
	// BOOT
	//------------------------------------------------------------------------
	function bootBelongsToManyPackagesTrait()
	{
		Static::observe(new BelongsToManyPackagesObserver);
	}

	//------------------------------------------------------------------------
	// RELATIONSHIP
	//------------------------------------------------------------------------
	function packages()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\Package')->withPivot('active_since', 'active_until');
	}

	function active_packages()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\Package')->withPivot('active_since', 'active_until')
																->wherePivot('active_since', '<=', \Carbon\Carbon::now())
																->wherePivot('active_until', '>=', \Carbon\Carbon::now());

	}

	//------------------------------------------------------------------------
	// SCOPE
	//------------------------------------------------------------------------
	function scopeInPackageByIds($q, $v = null)
	{
		if (!$v || (is_array($v) && empty($v)))
		{
			return $q;
		}
		else
		{
			return $q->whereHas('active_package', function($q) use ($v) {
				$q->whereIn('packages.id', is_array($v) ? $v : [$v]);
			});
		}
	}

	//------------------------------------------------------------------------
	// ACCESSOR
	//------------------------------------------------------------------------
	function getPackageIdsAttribute()
	{
		if (isset($this->package_ids))
		{
			return $this->package_ids;
		}
		else
		{
			return $this->packages->lists('id')->toArray();
		}
	}

	//------------------------------------------------------------------------
	// MUTATOR
	//------------------------------------------------------------------------
	function setPackageIdsAttribute( $v )
	{
		$this->package_ids = $v;
	}	
}
