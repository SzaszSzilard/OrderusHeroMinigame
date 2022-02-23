<?php

namespace emag\hero\Skills\AttackSkills;

use emag\hero\Characters\Monster;
use emag\hero\Skills\SkillInterface;

interface AttackSkillInterface extends SkillInterface
{
    public function useSkill(Monster $attacker, Monster $defender): void;
}
