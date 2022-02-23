<?php

namespace emag\hero\Characters;

use emag\hero\Skills\AttackSkills\AttackSkillInterface;
use emag\hero\Skills\AttackSkills\RapidStrikeSkill;
use emag\hero\Skills\DefenseSkills\DefenseSkillInterface;
use emag\hero\Skills\DefenseSkills\MagicShieldDefenceSkill;
use emag\hero\Skills\SkillInterface;

final class Orderus extends Monster
{
    public const NAME = 'Orderus';
    protected const HP_STATUS = 'Orderus hp: ';

    protected const MIN_RAND_HP = 70;
    protected const MAX_RAND_HP = 100;
    protected const MIN_RAND_STR = 70;
    protected const MAX_RAND_STR = 80;
    protected const MIN_RAND_DEF = 45;
    protected const MAX_RAND_DEF = 55;
    protected const MIN_RAND_SPEED = 40;
    protected const MAX_RAND_SPEED = 50;
    protected const MIN_RAND_LUCK = 10;
    protected const MAX_RAND_LUCK = 30;

    public function __construct()
    {
        parent::__construct();

        $this->addAttackSkill((new RapidStrikeSkill())->setSkillProbability(0.10));
        $this->addDefenceSkill((new MagicShieldDefenceSkill())->setSkillProbability(0.20));
    }
}