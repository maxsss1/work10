<?php

namespace OJGame;

class Game
{
    private Deck $deck;
    private array $players;
    private bool $isOver;

    public function __construct()
    {
        $this->deck = new Deck();
        $this->players = [];
        $this->isOver = false;
    }

    public function addPlayer(Player $player): void
    {
        $this->players[] = $player;
    }

    public function startGame(): void
    {
        $turn = 0;
        while (!$this->isOver && $this->deck->getRemainingCardsCount() > 0) {
            $currentPlayer = $this->players[$turn % count($this->players)];
            $currentPlayer->drawCard($this->deck);
            $turn++;
            $this->checkGameOver();
        }
    }

    private function checkGameOver(): void
    {
        if ($this->deck->getRemainingCardsCount() === 0) {
            $this->isOver = true;
        }
    }

    public function isGameOver(): bool
    {
        return $this->isOver;
    }

    public function getDeckStatus(): string
    {
        return (string)$this->deck->getRemainingCardsCount() . ' карт осталось';
    }
}
