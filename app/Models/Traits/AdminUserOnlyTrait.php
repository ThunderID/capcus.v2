<?php

namespace App;

trait AdminUserOnlyTrait {

    /**
     * Boot the soft deleting trait for a model.
     *
     * @return void
     */
    public static function bootAdminUserOnlyTrait()
    {
        static::addGlobalScope(new IsAdminScope);
    }

}