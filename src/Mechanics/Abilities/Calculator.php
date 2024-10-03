<?php
declare(strict_types=1);

namespace MaxAlx\DnD\Mechanics\Abilities;

use MaxAlx\DnD\Entities\Character\Abilities\Enums\Ability;
use MaxAlx\DnD\Entities\Character\Abilities\Enums\Skill;
use MaxAlx\DnD\Entities\Character\Player;

class Calculator
{
    public function getAbilityModifier(Player $character, Ability $ability): int
    {
        return (int) floor(($character->getAbilityScores()->get($ability) - 10) / 2);
    }

    public function getSkillModifier(Player $character, Skill $skill): int
    {
        $modifier = $this->getAbilityModifier($character, $skill->getAssociatedAbility());

        if ($character->getSkills()->has($skill)) {
            $modifier += $character->getProficiencyBonus();
        }

        return $modifier;
    }
}