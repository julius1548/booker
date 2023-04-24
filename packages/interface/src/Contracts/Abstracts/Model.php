<?php

namespace Bookkeeper\Interface\Contracts\Abstracts;

use Illuminate\Database\Eloquent\Model as EloquentModel;

abstract class Model extends EloquentModel
{
    public function getId(): mixed
    {
        return parent::getKey();
    }

    public function getType(): string
    {
        return static::class;
    }
}
