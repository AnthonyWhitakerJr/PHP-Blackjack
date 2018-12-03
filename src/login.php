<?php

include('config.php');
include('functions/login.functions.php');

// If form submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get username and password from the form as variables
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userId = attemptLogin($username, $password, $database);

    // If $users is not empty
    if ($userId != null) {
        // Set $user equal to the first result of $users

        // Set a session variable with a key of userId equal to the userId returned
        $_SESSION['userId'] = $userId;

        // Redirect to the index.php file
        header('location: index.php');
        die();
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Login</title>
    <meta name="description" content="PHP-Blackjack Login">
    <meta name="author" content="Anthony Whitaker">

    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<div class="page">
    <h1>Login</h1>
    <form method="POST">
        <input type="text" name="username" placeholder="Username"/>
        <input type="password" name="password" placeholder="Password"/>
        <input type="submit" value="Log In"/>
    </form>
</div>
</body>
</html>