<?php

namespace emag\hero\Characters;

use emag\hero\Skills\AttackSkills\AttackSkillInterface;
use emag\hero\Skills\AttackSkills\SimpleStrikeSkill;
use emag\hero\Skills\DefenseSkills\DefenseSkillInterface;
use emag\hero\Skills\DefenseSkills\SimpleDefenceSkill;

class Monster
{
    protected int $health;
    protected int $strength;
    protected int $defence;
    protected int $speed;
    protected int $luck;

    public const NAME = 'Monster';
    protected const HP_STATUS = 'Monster hp: ';

    protected const MIN_RAND_HP = 60;
    protected const MAX_RAND_HP = 90;
    protected const MIN_RAND_STR = 60;
    protected const MAX_RAND_STR = 90;
    protected const MIN_RAND_DEF = 40;
    protected const MAX_RAND_DEF = 60;
    protected const MIN_RAND_SPEED = 40;
    protected const MAX_RAND_SPEED = 60;
    protected const MIN_RAND_LUCK = 25;
    protected const MAX_RAND_LUCK = 40;

    protected array $attackSkills = [];
    protected array $defenseSkills = [];

    public function addAttackSkill(AttackSkillInterface $skill): void
    {
        \array_unshift($this->attackSkills, $skill);
    }

    public function addDefenceSkill(DefenseSkillInterface $skill): void
    {
        \array_unshift($this->defenseSkills, $skill);
    }

    public function __construct()
    {
        $this->health = \rand(static::MIN_RAND_HP, static::MAX_RAND_HP);
        $this->strength = \rand(static::MIN_RAND_STR, static::MAX_RAND_STR);
        $this->defence = \rand(static::MIN_RAND_DEF, static::MAX_RAND_DEF);
        $this->speed = \rand(static::MIN_RAND_SPEED, static::MAX_RAND_SPEED);
        $this->luck = \rand(static::MIN_RAND_LUCK, static::MAX_RAND_LUCK);

        $this->addAttackSkill(new SimpleStrikeSkill());
        $this->addDefenceSkill(new SimpleDefenceSkill());

        $this->statusReport();
    }

    public function getName(): string
    {
        return static::NAME;
    }

    public function getHealth(): int
    {
        return $this->health;
    }

    public function getStrength(): int
    {
        return $this->strength;
    }

    public function getDefence(): int
    {
        return $this->defence;
    }

    public function getSpeed(): int
    {
        return $this->speed;
    }

    public function getLuck(): int
    {
        return $this->luck;
    }

    public function useAttackSkills(Monster $defender): void
    {
        echo '- ' . static::NAME . ' attacks!' . \PHP_EOL;

        $probability = \mt_rand() / \mt_getrandmax();
        if ($probability <= ($defender->getLuck() / 100)) {
            echo $defender->getName() . ' got lucky. ' . static::NAME . ' missed its attack...' . \PHP_EOL;
            return;
        }

        foreach ($this->attackSkills as $attackSkill) {
            $probability = \mt_rand() / \mt_getrandmax();
            if ($probability <= $attackSkill->getSkillProbability()) {
                $attackSkill->useSkill($this, $defender);
                break;
            }
        }
    }

    public function attack(Monster $defender): void
    {
        $defender->defend($this);
    }

    public function defend($attacker): void
    {
        $damage = $this->useDefenceSkills($attacker);

        $this->reduceHp($damage);

        $this->statusReport($damage);
    }

    protected function reduceHp($damage): void
    {
        $this->health -= $damage;
        $this->health = ($this->health <= 0) ? 0 : $this->health;
    }

    protected function useDefenceSkills(Monster $attacker): int
    {
        $probability = \mt_rand() / \mt_getrandmax();
        foreach ($this->defenseSkills as $defenceSkill) {
            if ($probability <= $defenceSkill->getSkillProbability()) {
                return $defenceSkill->useSkill($attacker, $this);
            }
        }

        return 0;
    }

    public function getCalculatedDamage(Monster $attacker): int
    {
        return $attacker->getStrength() - $this->getDefence();
    }

    protected function statusReport($damage = 0)
    {
        if ($damage) {
            echo static::NAME . ' sustained ' . $damage . ' damage!' . \PHP_EOL;
        }
        echo static::HP_STATUS . $this->health . \PHP_EOL;
    }
}