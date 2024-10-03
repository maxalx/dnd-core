<?php
declare(strict_types=1);
namespace MaxAlx\DnD\Entities\Dice;

use MaxAlx\DnD\Exceptions\InvalidArgumentException;

class CompositeDicePool
{
    /**
     * @var \MaxAlx\DnD\Entities\Dice\DicePool[]
     */
    private array $collection;

    /**
     * @throws \MaxAlx\DnD\Exceptions\InvalidArgumentException
     */
    public function __construct(DicePool ...$dicePools)
    {
        if (empty($dicePools)) {
            throw new InvalidArgumentException('DicePools must not be empty');
        }

        $this->collection = $dicePools;
    }

    /**
     * @return \MaxAlx\DnD\Entities\Dice\DicePool[]
     */
    public function getAll(): array
    {
        return $this->collection;
    }
}