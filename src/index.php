<?php
include('config.php');
include('functions/index.functions.php');

$game = getGame();
$availableWagers = Game::getAvailableWagers($user->getBank());
$dealerHand = $game->getDealerHand();
$playerHand = $game->getPlayerHand();
$dealerScore = $game->calculateDealerHand();
$playerScore = $game->calculatePlayerHand();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="PHP-Blackjack">
    <meta name="author" content="Anthony Whitaker">

    <title>PHP-Blackjack</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/navbar.css">

</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">PHP-Blackjack</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarPhpBlackjack"
            aria-controls="navbarPhpBlackjack" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarPhpBlackjack">
        <div class="navbar-nav mr-auto">
            <a class="nav-item nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdownRanking" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">Leaderboard</a>
                <div class="dropdown-menu" aria-labelledby="dropdownRanking">
                    <a class="dropdown-item" href="leaderboard.php">Top Players</a>
                    <a class="dropdown-item" href="findPlayers.php">Find Players</a>
                </div>
            </div>
        </div>
        <div class="navbar-text">
            Bank: $<?php echo $user->getBank() ?>
        </div>
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdownUser" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false"><?php echo $user->getDisplayName() ?></a>
            <div class="dropdown-menu" aria-labelledby="dropdownUser">
                <a class="dropdown-item" href="profile.php">Profile</a>
                <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</nav>

<?php
$game->reset();
$game->updateWager(50);
$game->deal($user->getId(), $database);

$game->hit($user->getId(), $database);
$playerHand = $game->getPlayerHand();
$playerScore = $game->calculatePlayerHand();

$game->hit($user->getId(), $database);
$playerHand = $game->getPlayerHand();
$playerScore = $game->calculatePlayerHand();

$game->stand($user->getId(), $database);
$dealerHand = $game->getDealerHand();
$playerHand = $game->getPlayerHand();
$dealerScore = $game->calculateDealerHand();
$playerScore = $game->calculatePlayerHand();
?>

<div class="text-center">
    <?php for ($i = 0; $i < count($dealerHand); $i++) : ?>
        <?php if (($game->getState() == State::PLACE_WAGER || $game->getState() == State::PLAYER) && $i == '0') : ?>
            <img src="<?php echo $user->getCardBackLocation() ?>" class="rounded" alt="Face down card.">
        <?php else : ?>
            <?php $card = $dealerHand[$i] ?>
            <img src="<?php echo $card->getImageLocation() ?>" class="rounded" alt="<?php echo '' . $card ?>">
        <?php endif; ?>
    <?php endfor; ?>
</div>


<div class="text-center">
    <?php foreach ($playerHand as $card) : ?>
        <img src="<?php echo $card->getImageLocation() ?>" class="rounded" alt="<?php echo '' . $card ?>">
    <?php endforeach; ?>
</div>

<div>
    <?php foreach ($game->getGameLog() as $message) : ?>
        <p><?php echo $message ?></p>
    <?php endforeach; ?>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>
</html>