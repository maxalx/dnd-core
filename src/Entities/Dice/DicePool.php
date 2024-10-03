<?php
declare(strict_types=1);

namespace MaxAlx\DnD\Entities\Dice;

class DicePool
{
    public function __construct(
        private readonly DiceType $dice,
        private readonly int      $count = 1,
        private readonly int      $modifier = 0,
    ) {}

    public function getDice(): DiceType
    {
        return $this->dice;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getModifier(): int
    {
        return $this->modifier;
    }
}