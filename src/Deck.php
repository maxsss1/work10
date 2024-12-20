<?php

namespace OJGame;

class Deck
{
    private array $cards;

    public function __construct()
    {
        $this->initializeDeck();
        $this->shuffleDeck();
    }

    private function initializeDeck(): void
    {
        // Пример карт
        $this->cards = [
            new Card('Колючка', 1),
            new Card('Роза', 2),
            new Card('Лист', 3),
        ];
    }

    public function shuffleDeck(): void
    {
        shuffle($this->cards);
    }

    public function drawCard(): ?Card
    {
        return array_pop($this->cards) ?: null;
    }

    public function getRemainingCardsCount(): int
    {
        return count($this->cards);
    }
}
