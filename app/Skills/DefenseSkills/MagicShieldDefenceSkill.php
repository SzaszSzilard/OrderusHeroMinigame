<?php

namespace emag\hero\Skills\DefenseSkills;

use emag\hero\Characters\Monster;
use emag\hero\Skills\AbstractSkill;

class MagicShieldDefenceSkill extends AbstractSkill implements DefenseSkillInterface
{
    public function useSkill(Monster $attacker, Monster $defender): int
    {
        echo $defender::NAME . " used magic shield:" . \PHP_EOL;

        return $defender->getCalculatedDamage($attacker) / 2;
    }
}