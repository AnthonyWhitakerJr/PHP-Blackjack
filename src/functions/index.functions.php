<?php

function getGame() {
    if (!isset($_SESSION['game'])) {
        $_SESSION['game'] = new Game();
    }
    return $_SESSION['game'];
}