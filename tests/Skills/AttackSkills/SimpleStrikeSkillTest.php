<?php

namespace emag\tests\hero\Skills\AttackSkills;

use emag\hero\Characters\Monster;
use emag\hero\Skills\AttackSkills\SimpleStrikeSkill;
use PHPUnit\Framework\TestCase;

class SimpleStrikeSkillTest extends TestCase
{
    public function testUseSkill(): void
    {
        $monster = $this->createMock(Monster::class);
        $monster->expects(self::once())->method('attack');

        (new SimpleStrikeSkill())->useSkill($monster, $monster);
    }
}