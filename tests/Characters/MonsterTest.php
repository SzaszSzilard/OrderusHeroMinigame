<?php

namespace emag\tests\hero\Characters;

use emag\hero\Characters\Monster;
use emag\hero\Skills\AttackSkills\RapidStrikeSkill;
use emag\hero\Skills\DefenseSkills\MagicShieldDefenceSkill;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class MonsterTest extends TestCase
{
    public function testAttack(): void
    {
        $defender = $this->createMock(Monster::class);
        $defender->expects(self::once())->method('defend');

        (new Monster())->attack($defender);
    }

    public function testUseAttackSkillsMissedAttack(): void
    {
        $defender = $this->createMock(Monster::class);
        $defender->expects(self::once())->method('getLuck')->willReturn(100);

        (new Monster())->useAttackSkills($defender);

        $this->assertStringContainsString('missed its attack...', $this->getActualOutput());
    }

    public function testUseAttackSkills(): void
    {
        $defender = $this->createMock(Monster::class);
        $defender->expects(self::once())->method('getLuck')->willReturn(0); // ensures that test runs same way each time

        $monster = new Monster();
        $monster->addAttackSkill((new RapidStrikeSkill())->setSkillProbability(1));
        $monster->useAttackSkills($defender);

        $this->assertStringContainsString('used rapid strike.', $this->getActualOutput());
    }

    public function testUseDefenseSkills(): void
    {
        $monster = new Monster();
        $monster->addDefenceSkill((new MagicShieldDefenceSkill())->setSkillProbability(1));
        $monster->defend($monster);

        $this->assertStringContainsString('used magic shield', $this->getActualOutput());
    }

    public function testSkillProbabilityNotSet(): void
    {
        $this->expectException(RuntimeException::class);

        $monster = new Monster();
        $monster->addDefenceSkill((new MagicShieldDefenceSkill()));
        $monster->defend($monster);
    }

    public function testGetCalculatedDamage(): void
    {
        $strength = 66;
        $attacker = $this->createMock(Monster::class);
        $attacker->expects(self::once())->method('getStrength')->willReturn($strength);

        $defender = new Monster();
        $damage = $defender->getCalculatedDamage($attacker);

        self::assertEquals($damage, $strength - $defender->getDefence());
    }
}