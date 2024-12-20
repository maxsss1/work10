<?php

namespace OJGame;

class Player
{
    private string $name;
    private array $hand;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->hand = [];
    }

    public function drawCard(Deck $deck): void
    {
        $card = $deck->drawCard();
        if ($card !== null) {
            $this->hand[] = $card;
        }
    }

    public function getHand(): array
    {
        return $this->hand;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
