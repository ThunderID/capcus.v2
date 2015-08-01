<?php namespace App;

class EmailSubscription extends BaseModel {

	protected $table 		= 'email_subscriptions';
	protected $fillable 	= ['email', 'user_id', 'latest_newsletter', 'is_subscribe'];
	protected $dates		= ['latest_newsletter'];

	// ----------------------------------------------------------------------
	// BOOT
	// ----------------------------------------------------------------------
	static function boot()
	{
		parent::boot();
		Static::observe(new EmailSubscriptionObserver);
	}

	// ----------------------------------------------------------------------
	// RELATIONS
	// ----------------------------------------------------------------------
	public function users()
	{
		return $this->belongsTo(__NAMESPACE__ . '\User');
	}

	// ----------------------------------------------------------------------
	// SCOPE
	// ----------------------------------------------------------------------
	public function scopeFindEmail($q, $v = null)
	{
		if (!$v)
		{
			return $q;
		}
		else
		{
			return $q->where('email', 'like', $v);
		}
	}


}
