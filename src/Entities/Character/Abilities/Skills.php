<?php
declare(strict_types=1);
namespace MaxAlx\DnD\Entities\Character\Abilities;

use MaxAlx\DnD\Entities\Character\Abilities\Enums\Skill;

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