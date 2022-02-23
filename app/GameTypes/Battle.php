<?php

namespace emag\hero\GameTypes;

use emag\hero\Characters\Monster;

class Battle
{
    private const NO_OF_TURNS = 20;

    private Monster $player2;
    private Monster $player1;

    public function __construct(Monster $player1, Monster $player2)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
    }

    public function start(): void
    {
        echo 'The fight has been started' . \PHP_EOL;

        $this->turnBased($this->getTurn());
    }

    private function getTurn(): int
    {
        $turn = $this->player2->getSpeed() <=> $this->player1->getSpeed(); // -1 0 1
        if ($turn == 0) {
            $turn = $this->player2->getLuck() <=> $this->player1->getLuck(); // -1 0 1
            $turn = ($turn != 0) ? $turn : -1; // by default the monster attacks first
        }

        return $turn;
    }

    private function turnBased($turn)
    {
        $turnsLeft = self::NO_OF_TURNS;

        while ($this->player2->getHealth() && $this->player1->getHealth() && $turnsLeft--) {
            $turn *= -1;
            if ($turn == 1) {
                $this->player2->useAttackSkills($this->player1);
            } else {
                $this->player1->useAttackSkills($this->player2);
            }
        };

        if (!$turnsLeft) { // the game ended with no winner
            return;
        }

        if ($this->player2->getHealth()) {
            $this->declareWinner($this->player2);
        } else {
            $this->declareWinner($this->player1);
        }
    }

    private function declareWinner(Monster $attacker): void
    {
        echo 'Winner: ' . $attacker->getName() . \PHP_EOL;
    }
}