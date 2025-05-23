<?php
session_start();
require_once 'Game.php';

// Herstel spelobject
if (!isset($_SESSION['game'])) {
    header("Location: index.php");
    exit;
}

if (!is_string($_SESSION['game'])) {
    session_destroy();
    die("Spelsessie ongeldig. <a href='index.php'>Start opnieuw</a>");
}

$game = unserialize($_SESSION['game']);

// Acties
if (isset($_POST['roll'])) {
    $game->rollDice();
} elseif (isset($_POST['reset'])) {
    $game->reset();
}

$_SESSION['game'] = serialize($game);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dobbelspel</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 2rem;
            background-color: #f5f5f5;
        }
        .dice {
            display: inline-block;
            font-size: 2rem;
            margin: 0.5rem;
            background: #fff;
            padding: 1rem;
            border-radius: 8px;
            border: 1px solid #ccc;
            width: 40px;
            text-align: center;
        }
        .message {
            padding: 1rem;
            background-color: #ffe0e0;
            color: #900;
            border: 1px solid #900;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

<h1>🎲 Dobbelspel</h1>

<p>Je hebt nog <strong><?= $game->getRollsLeft() ?></strong> worpen over.</p>

<?php if ($game->getRollsLeft() === 0): ?>
    <div class="message">
        🎉 Je hebt al 3 keer gegooid. Het spel is voorbij!
    </div>
<?php endif; ?>

<div>
    <?php foreach ($game->getDice() as $value): ?>
        <div class="dice"><?= $value ?></div>
    <?php endforeach; ?>
</div>

<form method="post">
    <button name="roll" <?= $game->getRollsLeft() == 0 ? 'disabled' : '' ?>>Gooien 🎲</button>
    <button name="reset">🔁 Opnieuw Spelen</button>
</form>

<h3>Worpen geschiedenis:</h3>
<ul>
    <?php foreach ($game->getHistory() as $i => $roll): ?>
        <li>Worp <?= $i + 1 ?>: <?= implode(', ', $roll) ?></li>
    <?php endforeach; ?>
</ul>

</body>
</html>
