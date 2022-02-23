<?php

namespace emag\hero\Skills\DefenseSkills;

use emag\hero\Characters\Monster;
use emag\hero\Skills\AbstractSkill;

class SimpleDefenceSkill extends AbstractSkill implements DefenseSkillInterface
{
    public function __construct()
    {
        $this->setSkillProbability(1);
    }

    public function useSkill(Monster $attacker, Monster $defender): int
    {
        echo $defender::NAME . " used simple defence:" . \PHP_EOL;

        return $attacker->getCalculatedDamage($defender);
    }
}