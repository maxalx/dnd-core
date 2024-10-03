<?php
declare(strict_types=1);
namespace MaxAlx\DnD\Entities\Character\Abilities\Enums;

enum Skill {
    case Acrobatics;
    case AnimalHandling;
    case Arcana;
    case Athletics;
    case Deception;
    case History;
    case Insight;
    case Intimidation;
    case Investigation;
    case Medicine;
    case Nature;
    case Perception;
    case Performance;
    case Persuasion;
    case Religion;
    case SleightOfHand;
    case Stealth;
    case Survival;

    public function getAssociatedAbility(): Ability {
        return match($this) {
            self::Acrobatics,
            self::SleightOfHand,
            self::Stealth => Ability::Dexterity,

            self::AnimalHandling,
            self::Insight,
            self::Medicine,
            self::Perception,
            self::Survival => Ability::Wisdom,

            self::Arcana,
            self::History,
            self::Investigation,
            self::Nature,
            self::Religion => Ability::Intelligence,

            self::Athletics => Ability::Strength,

            self::Deception,
            self::Intimidation,
            self::Performance,
            self::Persuasion => Ability::Charisma,
        };
    }
}