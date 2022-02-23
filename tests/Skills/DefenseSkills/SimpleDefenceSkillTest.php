<?php

namespace emag\tests\hero\Skills\DefenseSkills;

use emag\hero\Characters\Monster;
use emag\hero\Skills\DefenseSkills\MagicShieldDefenceSkill;
use emag\hero\Skills\DefenseSkills\SimpleDefenceSkill;
use PHPUnit\Framework\TestCase;

class SimpleDefenceSkillTest extends TestCase
{
    public function testUseSkill(): void
    {
        $monster = $this->createMock(Monster::class);
        $monster->expects(self::once())->method('getCalculatedDamage');

        (new SimpleDefenceSkill())->useSkill($monster,$monster);
    }
}