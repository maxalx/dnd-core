<?php
declare(strict_types=1);
namespace MaxAlx\DnD\Entities\Creatures\Abilities;

use MaxAlx\DnD\Entities\Creatures\Abilities\Enums\Skill;

class Skills
{
    private array $skills;

    public function __construct(Skill ...$skills)
    {
        $this->skills = $skills;
    }

    public function has(Skill $skill): bool
    {
        return in_array($skill, $this->skills, true);
    }
}