<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\MessageBag;


abstract class BaseModel extends Model {

	use ErrorTrait;

}
