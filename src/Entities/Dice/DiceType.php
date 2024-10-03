<?php
declare(strict_types=1);
namespace MaxAlx\DnD\Entities\Dice;

enum DiceType: int {
    case D4 = 4;
    case D6 = 6;
    case D8 = 8;
    case D10 = 10;
    case D12 = 12;
    case D20 = 20;
}