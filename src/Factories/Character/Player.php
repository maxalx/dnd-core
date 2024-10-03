<?php
declare(strict_types=1);

namespace MaxAlx\DnD\Factories\Character;

use MaxAlx\DnD\Entities\Character\Abilities\AbilityScores;
use MaxAlx\DnD\Entities\Character\Abilities\Enums\Ability;
use MaxAlx\DnD\Entities\Character\Abilities\Enums\Skill;
use MaxAlx\DnD\Entities\Character\Abilities\Skills;
use MaxAlx\DnD\Entities\Character\Player as PlayerEntity;

class Player
{
    public const DEFAULT_NAME = 'Unknown';

    private string $name;
    private AbilityScores $abilityScores;
    private Skills $skills;
    private int $proficiencyBonus;

    public function __construct()
    {
        $this->name = static::DEFAULT_NAME;
        $this->abilityScores = new AbilityScores();
        $this->skills = new Skills();
        $this->proficiencyBonus = 0;
    }

    public function create(): PlayerEntity
    {
        return new PlayerEntity(
            $this->name,
            $this->abilityScores,
            $this->skills,
            $this->proficiencyBonus
        );
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setAbilityScore(Ability $ability, int $value): self
    {
        $this->abilityScores->set($ability, $value);

        return $this;
    }

    public function setSkills(Skill ...$skills): self
    {
        $this->skills = new Skills(...$skills);

        return $this;
    }

    public function setProficiencyBonus(int $value): self
    {
        $this->proficiencyBonus = $value;

        return $this;
    }
}