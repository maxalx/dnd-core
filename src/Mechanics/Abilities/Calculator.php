<?php
declare(strict_types=1);

namespace MaxAlx\DnD\Mechanics\Abilities;

use MaxAlx\DnD\Entities\Creatures\Abilities\Enums\Ability;
use MaxAlx\DnD\Entities\Creatures\Abilities\Enums\Skill;
use MaxAlx\DnD\Entities\Creatures\PlayerCharacter;

class Calculator
{
    public function getAbilityModifier(PlayerCharacter $character, Ability $ability): int
    {
        return (int) floor(($character->getAbilityScores()->get($ability) - 10) / 2);
    }

    public function getSkillModifier(PlayerCharacter $character, Skill $skill): int
    {
        $modifier = $this->getAbilityModifier($character, $skill->getAssociatedAbility());

        if ($character->getSkills()->has($skill)) {
            $modifier += $character->getProficiencyBonus();
        }

        return $modifier;
    }
}