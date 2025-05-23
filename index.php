<?php
session_start();
require_once 'Game.php';

// Maak nieuw spel aan en sla op in sessie
$game = new Game();
$_SESSION['game'] = serialize($game);

header("Location: play.php");
exit;
