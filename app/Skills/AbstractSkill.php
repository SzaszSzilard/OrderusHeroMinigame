<?php

namespace emag\hero\Skills;

use RuntimeException;

abstract class AbstractSkill implements SkillInterface
{
    private float $probability;

    public function setSkillProbability(float $probability): self
    {
        $this->probability = $probability;

        return $this;
    }

    public function getSkillProbability(): float
    {
        if (!isset($this->probability)) {
            throw new RuntimeException('SKILL_PROBABILITY_HAS_NOT_BEEN_SET');
        }
        return $this->probability;
    }
}