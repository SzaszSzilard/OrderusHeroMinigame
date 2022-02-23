<?php

namespace emag\tests\hero\Skills\AttackSkills;

use emag\hero\Characters\Monster;
use emag\hero\Skills\AttackSkills\RapidStrikeSkill;
use PHPUnit\Framework\TestCase;

class RapidStrikeSkillTest extends TestCase
{
    public function testUseSkill(): void
    {
        $monster = $this->createMock(Monster::class);
        $monster->expects(self::exactly(2))->method('attack');

        (new RapidStrikeSkill())->useSkill($monster,$monster);
    }
}