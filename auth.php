<?php
session_start();

if (!isset($_SESSION['access_token'])) {
    if (strstr($_SERVER['PHP_SELF'], 'login.php') === false)
        header('location:login.php');
} else {
    if (strstr($_SERVER['PHP_SELF'], 'index.php') === false)
        header('location:index.php');
}
