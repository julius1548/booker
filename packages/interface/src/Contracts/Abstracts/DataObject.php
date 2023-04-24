<?php

namespace Bookkeeper\Interface\Contracts\Abstracts;

use Illuminate\Contracts\Support\Arrayable;

abstract class DataObject implements Arrayable
{
    protected function getAttribute(string $name)
    {
        return $this->{$name};
    }

    protected function setAttribute(string $name, mixed $value): static
    {
        $this->{$name} = $value;
        return $this;
    }

    public function toArray(): array
    {
        $array = [];
        foreach ($this as $key => $value) {
            $array[$key] = $value;
        }

        return $array;
    }
}
