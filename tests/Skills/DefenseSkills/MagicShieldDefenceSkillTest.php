<?php

namespace emag\tests\hero\Skills\DefenseSkills;

use emag\hero\Characters\Monster;
use emag\hero\Skills\DefenseSkills\MagicShieldDefenceSkill;
use PHPUnit\Framework\TestCase;

class MagicShieldDefenceSkillTest extends TestCase
{
    public function testUseSkill(): void
    {
        $monster = $this->createMock(Monster::class);
        $monster->expects(self::once())->method('getCalculatedDamage');

        $magicShield = new MagicShieldDefenceSkill();
        $magicShield->useSkill($monster, $monster);

        // testing damage halving
        $monster = new Monster();
        $this->assertEquals($magicShield->useSkill($monster, $monster), floor($monster->getCalculatedDamage($monster) / 2));
    }
}