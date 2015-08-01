<?php namespace App;

use Illuminate\Support\MessageBag;

trait AlreadyPublished {

    /**
     * Boot the soft deleting trait for a model.
     *
     * @return void
     */
    public static function bootAlreadyPublished()
    {
        static::addGlobalScope(new AlreadyPublishedScope);
    }

}