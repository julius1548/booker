<?php

namespace Bookkeeper\Booker\Enums;

use Bookkeeper\Interface\Contracts\Abstracts\Enum;

class PeriodicityType extends Enum
{
    const WEEK = 1;

    public static function week(): static
    {
        return new static(static::WEEK);
    }
}
