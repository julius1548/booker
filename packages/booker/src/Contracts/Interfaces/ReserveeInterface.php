<?php

namespace Bookkeeper\Booker\Contracts\Interfaces;

interface ReserveeInterface
{
    public function getId(): mixed;

    public function getType(): string;
}
