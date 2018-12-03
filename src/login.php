<?php
include('config.php');
include('functions/login.functions.php');

// If form submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get username and password from the form as variables
    $username = $_POST['inputUsername'];
    $password = $_POST['inputPassword'];
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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="PHP-Blackjack Login">
    <meta name="author" content="Anthony Whitaker">

    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">

</head>
<body>
<form class="form-signin" method="POST">
    <div class="text-center mb-4">
        <h1 class="h3 mb-3 font-weight-normal">PHP Blackjack</h1>
    </div>

    <div class="form-label-group">
        <input type="text" id="inputUsername" name="inputUsername" class="form-control" placeholder="Username" required
               autofocus>
        <label for="inputUsername">Username</label>
    </div>

    <div class="form-label-group">
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password"
               required>
        <label for="inputPassword">Password</label>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
    <button class="btn btn-lg btn-primary btn-block" type="button" onclick="location.href='signup.php'">Sign up</button>
</form>
</body>
</html>