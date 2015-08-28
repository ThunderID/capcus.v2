<?php namespace App;


class SubscriptionValidator extends \Illuminate\Validation\Validator {

    public function validateNoOverlappingSubscription($attribute, $value, $parameters)
    {
        dd($value);
    	$since = \Carbon\Carbon::parse($this->data['since']);
    	$until = \Carbon\Carbon::parse($value);

        if (!$parameters[0])
        {
            throw new Exception("NoOverlappingSubscription Validator: required parameter 0 (vendor_id)", 1);
        }

    	$q = VendorSubscription::where('vendor_id','=', $parameters[0])->where(function($q) use ($since, $until) {
                                    $q->where(function($q) use ($since, $until) {
                                            $q->where('since', '<=', $since->format('Y-m-d'))->where('until', '>=', $since->format('Y-m-d'));
                                        })
                                    ->orWhere(function($q) use ($since, $until) {
                                            $q->where('since', '>=', $since->format('Y-m-d'))->where('until', '<=', $until->format('Y-m-d'));
                                        })
                                    ->orWhere(function($q) use ($since, $until) {
                                            $q->where('since', '>=', $since->format('Y-m-d'))->where('since', '<=', $until->format('Y-m-d'))->where('until', '>=', $until->format('Y-m-d'));
                                        })
                                    ->orWhere(function($q) use ($since, $until) {
                                            $q->where('since', '<=', $since->format('Y-m-d'))->where('until', '>=', $until->format('Y-m-d'));
                                        });
                                });

        if ($parameters[1])
        {
            $q->where('id', '!=', (int)$parameters[1]);
        }

    	return $q->count() == 0;
    }

}