<?php

use PHPUnit\Framework\TestCase;
use OJGame\Card;
use OJGame\Deck;
use OJGame\Player;
use OJGame\Game;

class GameTest extends TestCase
{
    public function testGameInitialization(): void
    {
        $game = new Game();
        
        $this->assertInstanceOf(Game::class, $game);
        $this->assertEquals(3, count($game->getDeck()->getCards())); // 3 карты в колоде на старте
    }

    public function testDrawCard(): void
    {
        $game = new Game();
        $player = new Player('Игрок 1');
        
        $game->addPlayer($player);
        $player->drawCard($game->getDeck());
        
        $this->assertCount(1, $player->getHand());
    }

    public function testGameOverWhenNoCardsLeft(): void
    {
        $game = new Game();
        
        $player1 = new Player('Игрок 1');
        $player2 = new Player('Игрок 2');
        $game->addPlayer($player1);
        $game->addPlayer($player2);
        
        while ($game->getDeck()->getRemainingCardsCount() > 0) {
            $game->startGame();
        }
        
        $this->assertTrue($game->isGameOver());
    }
}
