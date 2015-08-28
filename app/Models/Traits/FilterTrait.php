<?php namespace App;

use Illuminate\Support\MessageBag;
use Exception;

trait FilterTrait {

	protected $filters;

	function is_filterable($key)
	{
		if (!isset($this->filters))
		{
			throw new Exception("Filter has not been set ($filters[key] => string function name)", 1);
		}

		return array_key_exists($key, $this->filters);
	}

	function filter($key, $value)
	{
		if (!$this->is_filterable($key))
		{
			throw new Exception("Key {$key} is not filterable", 1);
		}
		elseif (!method_exists($this, 'Scope'. $this->filters[$key]))
		{
			throw new Exception("Filter key '{$key}': Method not found", 1);
		}

		if (is_array($value))
		{
			return call_user_func_array([$this, $this->filters[$key]], $value);
		}
		else
		{
			return call_user_func([$this, $this->filters[$key]], $value);
		}
	}
}
