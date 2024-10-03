<?php
declare(strict_types=1);
namespace MaxAlx\DnD\Entities\Character\HitPoints;

use MaxAlx\DnD\Entities\Character\HitPoints\Exceptions\ZeroHitPointsException;
use MaxAlx\DnD\Exceptions\InvalidArgumentException;

class HitPoints
{
    private int $max;
    private int $current;

    /**
     * @throws \MaxAlx\DnD\Exceptions\InvalidArgumentException
     */
    public function __construct(int $max, int $current)
    {
        if ($max <= 0) {
            throw new InvalidArgumentException('Maximum hit point value is lower or equal to 0');
        }

        if ($current < 0) {
            throw new InvalidArgumentException('Current value is lower than 0');
        }

        if ($max < $current) {
            throw new InvalidArgumentException('Maximum hit points are less than current value');
        }

        $this->max     = $max;
        $this->current = $current;
    }

    public function getMax(): int
    {
        return $this->max;
    }

    public function getCurrent(): int
    {
        return $this->current;
    }

    /**
     * @throws \MaxAlx\DnD\Exceptions\InvalidArgumentException
     */
    public function increase(int $increment): void
    {
        if ($increment < 0) {
            throw new InvalidArgumentException('Increase value must be greater than 0');
        }

        $this->current = min($this->current + $increment, $this->max);
    }

    /**
     * @throws \MaxAlx\DnD\Exceptions\InvalidArgumentException
     * @throws \MaxAlx\DnD\Entities\Character\HitPoints\Exceptions\ZeroHitPointsException
     */
    public function decrease(int $decrement): void
    {
        if ($decrement < 0) {
            throw new InvalidArgumentException('Decrease value must be greater than 0');
        }

        $this->current = max($this->current - $decrement, 0);

        if ($this->current === 0) {
            throw new ZeroHitPointsException();
        }
    }
}