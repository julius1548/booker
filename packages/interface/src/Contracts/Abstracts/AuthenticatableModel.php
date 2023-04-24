<?php

namespace Bookkeeper\Interface\Contracts\Abstracts;

use Illuminate\Foundation\Auth\User as Authenticatable;


abstract class AuthenticatableModel extends Authenticatable
{
    public function getKey(): mixed
    {
        return parent::getKey();
    }
}
