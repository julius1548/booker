<?php

namespace Bookkeeper\Interface\Contracts\Abstracts;


abstract class Enum implements \Stringable
{
    protected mixed $value;

    private string $key;

    public function __construct($value)
    {
        if ($value instanceof static) {
            $value = $value->getValue();
        }

        $this->key = static::isValidValue($value);


        $this->value = $value;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function __toString()
    {
        return (string)$this->value;
    }

    final public function equals($variable = null): bool
    {
        return $variable instanceof self
            && $this->getValue() === $variable->getValue()
            && static::class === \get_class($variable);
    }

    public static function keys(): array
    {
        return \array_keys(static::toArray());
    }

    public static function toArray(): array
    {
        return (new \ReflectionClass(static::class))->getConstants();
    }

    public static function isValid($value): bool
    {
        return \in_array($value, static::toArray(), true);
    }

    private static function isValidValue($value): string
    {
        if (false === ($key = static::search($value))) {
            throw new \UnexpectedValueException("Value '$value' is not part of the enum " . static::class);
        }

        return $key;
    }

    public static function search($value): bool|int|string
    {
        return \array_search($value, static::toArray(), true);
    }
}
