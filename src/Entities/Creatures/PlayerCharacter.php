<?php
declare(strict_types=1);
namespace MaxAlx\DnD\Entities\Creatures;

use MaxAlx\DnD\Entities\Creatures\Abilities\AbilityScores;
use MaxAlx\DnD\Entities\Creatures\Abilities\Skills;
use MaxAlx\DnD\Entities\Creatures\HitPoints\HitDice;
use MaxAlx\DnD\Entities\Creatures\HitPoints\HitPoints;
use MaxAlx\DnD\Factories\Creatures\PlayerCharacter as PlayerCharacterFactory;

class PlayerCharacter extends Creature
{
    public function __construct(
        private readonly string        $name,
        private readonly HitPoints     $hitPoints,
        private readonly AbilityScores $abilityScores,
        private readonly Skills        $skills,
        private readonly int           $proficiencyBonus,
        private readonly HitDice       $hitDice,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getHitPoints(): HitPoints
    {
        return $this->hitPoints;
    }

    public function getHitDice(): HitDice
    {
        return $this->hitDice;
    }

    public function getAbilityScores(): AbilityScores
    {
        return $this->abilityScores;
    }

    public function getSkills(): Skills
    {
        return $this->skills;
    }

    public function getProficiencyBonus(): int
    {
        return $this->proficiencyBonus;
    }

    public static function new(): PlayerCharacterFactory
    {
        return new PlayerCharacterFactory();
    }
}