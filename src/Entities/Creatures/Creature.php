<?php
declare(strict_types=1);
namespace MaxAlx\DnD\Entities\Creatures;

use MaxAlx\DnD\Entities\Creatures\Abilities\AbilityScores;
use MaxAlx\DnD\Entities\Creatures\HitPoints\HitPoints;

abstract class Creature
{
    abstract public function getName(): string;
    abstract public function getHitPoints(): HitPoints;
    abstract public function getAbilityScores(): AbilityScores;
}