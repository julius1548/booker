<?php

namespace Bookkeeper\Booker\Contracts\Interfaces;

interface ReservableInterface
{
    public function getId(): mixed;

    public function getType(): mixed;
}
