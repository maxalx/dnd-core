<?php
declare(strict_types=1);
namespace MaxAlx\DnD\Tests\Factories\Character;

use MaxAlx\DnD\Entities\Character\Abilities\Enums\Ability;
use MaxAlx\DnD\Entities\Character\Abilities\Enums\Skill;
use MaxAlx\DnD\Entities\Dice\DiceType;
use MaxAlx\DnD\Exceptions\NotEnoughDataException;
use MaxAlx\DnD\Factories\Character\Player as PlayerFactory;
use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    public function testCreateWithData(): void
    {
        $character = (new PlayerFactory())
            ->setName('Grog')
            ->setMaxHitPoints(10)
            ->setCurrentHitPoints(8)
            ->addHitDice(DiceType::D8, 2)
            ->addHitDice(DiceType::D6)
            ->setAbilityScore(Ability::Strength, 16)
            ->setSkills(Skill::Intimidation, Skill::Athletics)
            ->setProficiencyBonus(2)
            ->create();

        $this->assertEquals('Grog', $character->getName());
        $this->assertEquals(10, $character->getHitPoints()->getMax());
        $this->assertEquals(8, $character->getHitPoints()->getCurrent());
        $this->assertCount(2, $character->getHitDice()->getAll());
        $this->assertEquals(16, $character->getAbilityScores()->get(Ability::Strength));
        $this->assertEquals(2, $character->getProficiencyBonus());
        $this->assertTrue($character->getSkills()->has(Skill::Intimidation));
    }

    public function testCreateDefaultValues(): void
    {
        $character = (new PlayerFactory())
            ->setMaxHitPoints(10)
            ->addHitDice(DiceType::D8)
            ->create();

        $this->assertEquals(PlayerFactory::DEFAULT_NAME, $character->getName());
        $this->assertEquals(10, $character->getHitPoints()->getMax());
        $this->assertEquals(10, $character->getHitPoints()->getCurrent());
        $this->assertCount(1, $character->getHitDice()->getAll());
        $this->assertEquals(10, $character->getAbilityScores()->get(Ability::Strength));
        $this->assertEquals(0, $character->getProficiencyBonus());
        $this->assertFalse($character->getSkills()->has(Skill::Intimidation));
    }

    public function testCreateEmpty(): void
    {
        $this->expectException(NotEnoughDataException::class);

        (new PlayerFactory())->create();
    }
}