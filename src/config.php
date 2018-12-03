<?php

include('modelLoader.php');
include('functions/config.functions.php');

// Connecting to the MySQL database
$DB_USER = "root";
$DB_PASSWORD = "root";

$database = new PDO('mysql:host=csweb.hh.nku.edu;dbname=db_fall18_whitakera2', $DB_USER, $DB_PASSWORD);

// Start the session
session_start();

$customer=[];

$current_url = basename($_SERVER['REQUEST_URI']);

// if userId is not set in the session and current URL not login.php redirect to login page

if(!isset($_SESSION['userId']) && $current_url != 'login.php') {
    header('location: login.php');
    die();
}
// Else if session key userId is set get $customer from the database
elseif (isset($_SESSION['userId'])) {
    $user = getUser($_SESSION['userId'], $database);
}
