<?php

require __DIR__ . '/vendor/autoload.php';

use OJGame\Game;
use OJGame\Player;

session_start();

if (!isset($_SESSION['game'])) {
    $_SESSION['game'] = new Game();
    $_SESSION['player1'] = new Player('Игрок 1');
    $_SESSION['player2'] = new Player('Игрок 2');
    $_SESSION['game']->addPlayer($_SESSION['player1']);
    $_SESSION['game']->addPlayer($_SESSION['player2']);
}

$game = $_SESSION['game'];
$player1 = $_SESSION['player1'];
$player2 = $_SESSION['player2'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'draw') {
    $game->startGame();
}

$isGameOver = $game->isGameOver();
$deckStatus = $game->getDeckStatus();

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ож Колючки</title>
</head>
<body>
    <h1>Игра "Ож Колючки"</h1>

    <?php if ($isGameOver): ?>
        <p>Игра окончена! Осталось карт в колоде: <?php echo $deckStatus; ?></p>
    <?php else: ?>
        <p>Осталось карт в колоде: <?php echo $deckStatus; ?></p>
        <form method="POST">
            <button type="submit" name="action" value="draw">Тянуть карту</button>
        </form>
    <?php endif; ?>

    <h2>Рука Игрока 1</h2>
    <ul>
        <?php foreach ($player1->getHand() as $card): ?>
            <li><?php echo htmlspecialchars($card->getName(), ENT_QUOTES, 'UTF-8'); ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Рука Игрока 2</h2>
    <ul>
        <?php foreach ($player2->getHand() as $card): ?>
            <li><?php echo htmlspecialchars($card->getName(), ENT_QUOTES, 'UTF-8'); ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
