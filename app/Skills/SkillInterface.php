<?php

namespace emag\hero\Skills;

interface SkillInterface
{
    public function setSkillProbability(float $probability);

    public function getSkillProbability(): float;
}
