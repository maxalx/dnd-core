<?php
declare(strict_types=1);

namespace MaxAlx\DnD\Tests\Entities;

use MaxAlx\DnD\Entities\Character\HitPoints\Exceptions\ZeroHitPointsException;
use MaxAlx\DnD\Entities\Character\HitPoints\HitPoints;
use MaxAlx\DnD\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MaxAlx\DnD\Entities\Character\HitPoints\HitPoints
 */
class HitPointsTest extends TestCase
{
    /**
     * @covers \MaxAlx\DnD\Entities\Character\HitPoints\HitPoints::increase
     */
    public function testHitPointsIncrease(): void
    {
        $hitPoints = new HitPoints(10, 2);

        $this->assertEquals(2, $hitPoints->getCurrent());
        $this->assertEquals(10, $hitPoints->getMax());

        $hitPoints->increase(3);

        $this->assertEquals(5, $hitPoints->getCurrent());
        $this->assertEquals(10, $hitPoints->getMax());

        $hitPoints->increase(99);

        $this->assertEquals(10, $hitPoints->getCurrent());
        $this->assertEquals(10, $hitPoints->getMax());

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Increase value must be greater than 0');
        $hitPoints->increase(-3);
    }

    /**
     * @covers \MaxAlx\DnD\Entities\Character\HitPoints\HitPoints::decrease
     */
    public function testHitPointsDecrease(): void
    {
        $hitPoints = new HitPoints(10, 10);

        $this->assertEquals(10, $hitPoints->getCurrent());
        $this->assertEquals(10, $hitPoints->getMax());

        $hitPoints->decrease(2);

        $this->assertEquals(8, $hitPoints->getCurrent());
        $this->assertEquals(10, $hitPoints->getMax());

        $this->expectException(ZeroHitPointsException::class);

        $hitPoints->decrease(99);

        $this->assertEquals(0, $hitPoints->getCurrent());
        $this->assertEquals(10, $hitPoints->getMax());

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Decrease value must be greater than 0');
        $hitPoints->decrease(-3);
    }

    public function testHitPointsCreation(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Maximum hit point value is lower or equal to 0');
        new HitPoints(-2, 10);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Maximum hit point value is lower or equal to 0');
        new HitPoints(0, 10);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Current value is lower than 0');
        new HitPoints(10, -1);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Maximum hit points are less than current value');
        new HitPoints(10, 99);
    }
}