<?php

namespace App;

trait MemberUserTrait {

    /**
     * Boot the soft deleting trait for a model.
     *
     * @return void
     */
    public static function bootMemberUserTrait()
    {
        static::addGlobalScope(new IsMemberScope);
    }

}