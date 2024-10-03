<?php
declare(strict_types=1);
namespace MaxAlx\DnD\Entities\Character;

use MaxAlx\DnD\Entities\Character\Abilities\AbilityScores;
use MaxAlx\DnD\Entities\Character\Abilities\Skills;
use MaxAlx\DnD\Factories\Character\Player as PlayerCharacterFactory;

class Player
{
    public function __construct(
        private readonly string $name,
        private readonly AbilityScores $abilityScores,
        private readonly Skills $skills,
        private readonly int $proficiencyBonus = 0,
    ) {}

    public function getName(): string
    {
        return $this->name;
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