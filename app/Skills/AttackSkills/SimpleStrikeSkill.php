<?php

namespace emag\hero\Skills\AttackSkills;

use emag\hero\Characters\Monster;
use emag\hero\Skills\AbstractSkill;

class SimpleStrikeSkill extends AbstractSkill implements AttackSkillInterface
{
    public function __construct()
    {
        $this->setSkillProbability(1);
    }

    public function useSkill(Monster $attacker, Monster $defender): void
    {
        echo $attacker::NAME . " used simple strike." . \PHP_EOL;

        $attacker->attack($defender);
    }
}