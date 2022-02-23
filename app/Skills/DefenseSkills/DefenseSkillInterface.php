<?php

namespace emag\hero\Skills\DefenseSkills;

use emag\hero\Characters\Monster;
use emag\hero\Skills\SkillInterface;

interface DefenseSkillInterface extends SkillInterface
{
    public function useSkill(Monster $attacker, Monster $defender): int;
}
