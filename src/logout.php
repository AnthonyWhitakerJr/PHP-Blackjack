<?php

include('config.php');

// Destroy the current session
session_destroy();

// Redirect to the login page
header('location: login.php');
die();