<?php

namespace emag\hero\Skills\AttackSkills;

use emag\hero\Characters\Monster;
use emag\hero\Skills\AbstractSkill;

class RapidStrikeSkill extends AbstractSkill implements AttackSkillInterface
{
    public function useSkill(Monster $attacker, Monster $defender): void
    {
        echo $attacker::NAME . " used rapid strike." . \PHP_EOL;

        $attacker->attack($defender);
        $attacker->attack($defender);
    }
}