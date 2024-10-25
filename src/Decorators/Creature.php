<?php
declare(strict_types=1);
namespace MaxAlx\DnD\Decorators;

use MaxAlx\DnD\Entities\Creatures\Creature as CreatureEntity;

class Creature
{
    private CreatureEntity $creature;

    public function __construct(CreatureEntity $creature)
    {
        $this->creature = $creature;
    }

    /**
     * @throws \MaxAlx\DnD\Entities\Creatures\HitPoints\Exceptions\ZeroHitPointsException
     * @throws \MaxAlx\DnD\Exceptions\InvalidArgumentException
     */
    public function takeDamage(int $amount): void
    {
        $this->creature->getHitPoints()->decrease($amount);
    }

    /**
     * @throws \MaxAlx\DnD\Exceptions\InvalidArgumentException
     */
    public function heal(int $amount): void
    {
        $this->creature->getHitPoints()->increase($amount);
    }
}