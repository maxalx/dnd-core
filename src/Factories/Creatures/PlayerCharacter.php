<?php
declare(strict_types=1);

namespace MaxAlx\DnD\Factories\Creatures;

use MaxAlx\DnD\Entities\Creatures\Abilities\AbilityScores;
use MaxAlx\DnD\Entities\Creatures\Abilities\Enums\Ability;
use MaxAlx\DnD\Entities\Creatures\Abilities\Enums\Skill;
use MaxAlx\DnD\Entities\Creatures\Abilities\Skills;
use MaxAlx\DnD\Entities\Creatures\HitPoints\HitDice;
use MaxAlx\DnD\Entities\Creatures\HitPoints\HitPoints;
use MaxAlx\DnD\Entities\Creatures\PlayerCharacter as PlayerEntity;
use MaxAlx\DnD\Entities\Dice\DicePool;
use MaxAlx\DnD\Entities\Dice\DiceType;
use MaxAlx\DnD\Exceptions\BaseException;
use MaxAlx\DnD\Exceptions\NotEnoughDataException;

class PlayerCharacter
{
    public const DEFAULT_NAME = 'Unknown';

    private string $name;
    private int $maxHitPoints;
    private int $currentHitPoints;
    private array $hitDicePools = [];
    private AbilityScores $abilityScores;
    private Skills $skills;
    private int $proficiencyBonus;

    public function __construct()
    {
        $this->name             = static::DEFAULT_NAME;
        $this->abilityScores    = new AbilityScores();
        $this->skills           = new Skills();
        $this->proficiencyBonus = 0;
    }

    /**
     * @throws \MaxAlx\DnD\Exceptions\NotEnoughDataException
     */
    public function create(): PlayerEntity
    {
        try {
            return new PlayerEntity(
                $this->name,
                $this->createHitPoints(),
                $this->abilityScores,
                $this->skills,
                $this->proficiencyBonus,
                $this->createHitDice(),
            );
        } catch (BaseException $exception) {
            $message = 'Could not create player character: ' . $exception->getMessage();

            throw new NotEnoughDataException($message);
        }
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setMaxHitPoints(int $maxHitPoints): self
    {
        $this->maxHitPoints = $maxHitPoints;

        return $this;
    }

    public function setCurrentHitPoints(int $currentHitPoints): self
    {
        $this->currentHitPoints = $currentHitPoints;

        return $this;
    }

    public function addHitDice(DiceType $diceType, int $count = 1, int $modifier = 0): self
    {
        $this->hitDicePools[] = new DicePool($diceType, $count, $modifier);

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

    /**
     * @throws \MaxAlx\DnD\Exceptions\InvalidArgumentException
     * @throws \MaxAlx\DnD\Exceptions\NotEnoughDataException
     */
    private function createHitPoints(): HitPoints
    {
        if (!isset($this->maxHitPoints)) {
            throw new NotEnoughDataException('Maximum hitPoints must be set');
        }

        if (!isset($this->currentHitPoints)) {
            $this->currentHitPoints = $this->maxHitPoints;
        }

        return new HitPoints($this->maxHitPoints, $this->currentHitPoints);
    }

    /**
     * @throws \MaxAlx\DnD\Exceptions\InvalidArgumentException|\MaxAlx\DnD\Exceptions\NotEnoughDataException
     */
    private function createHitDice(): HitDice
    {
        if (empty($this->hitDicePools)) {
            throw new NotEnoughDataException('HitDice pools must be set');
        }

        return new HitDice(...$this->hitDicePools);
    }
}