<?php

class Game {
    private $dice = [];
    private $rollsLeft = 3;
    private $history = [];

    public function __construct() {
        $this->rollDice();
    }

    public function rollDice() {
        if ($this->rollsLeft > 0) {
            for ($i = 0; $i < 5; $i++) {
                $this->dice[$i] = rand(1, 6);
            }
            $this->rollsLeft--;
            $this->history[] = $this->dice;
        }
    }

    public function reset() {
        $this->rollsLeft = 3;
        $this->history = [];
        $this->rollDice();
    }

    public function getDice() {
        return $this->dice;
    }

    public function getRollsLeft() {
        return $this->rollsLeft;
    }

    public function getHistory() {
        return $this->history;
    }
}
