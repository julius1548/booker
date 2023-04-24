<?php

namespace Bookkeeper\Booker\DataObjects;

use Bookkeeper\Interface\Contracts\Abstracts\DataObject;

class Time extends DataObject implements \Stringable
{
    const FORMAT = '%02d:%02d:%02d';
    protected int $seconds = 0;

    protected int $hour = 0;
    protected int $minute = 0;
    protected int $second = 0;

    public function __construct(int $seconds = null)
    {
        if ($seconds) {
            $this->setSeconds($seconds);
            $this->setHour(floor($seconds / 3600));
            $this->setMinute(floor(($seconds / 60) % 60));
            $this->setSecond($seconds % 60);
        }
    }

    public function getSeconds(): int
    {
        return $this->getAttribute('seconds');
    }

    public function setSeconds(int $seconds): self
    {
        $this->setAttribute('seconds', $seconds);
        return $this;
    }

    public function getHour(): int
    {
        return $this->getAttribute('hour');
    }

    public function setHour(int $hour): self
    {
        $this->setAttribute('hour', $hour);
        return $this;
    }

    public function getMinute(): int
    {
        return $this->getAttribute('minute');
    }

    public function setMinute(int $minute): self
    {
        $this->setAttribute('minute', $minute);
        return $this;
    }

    public function getSecond(): int
    {
        return $this->getAttribute('second');
    }

    public function setSecond(int $second): self
    {
        $this->setAttribute('second', $second);
        return $this;
    }

    public function fromString(string $time): static
    {
        sscanf($time, self::FORMAT, $hour, $minute, $second);
        $this->setHour((int)$hour);
        $this->setMinute((int)$minute);
        $this->setSecond((int)$second);

        $this->setSeconds(3600 * $hour + 60 * $minute + $second);

        return $this;
    }

    public function __toString()
    {
        return sprintf('%02d:%02d:%02d', $this->getHour(), $this->getMinute(), $this->getSecond());
    }
}
