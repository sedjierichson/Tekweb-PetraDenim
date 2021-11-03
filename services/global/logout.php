<?php

session_start();

if (!isset($_SESSION['name'])) {
  header("Location: login.php");
}

$_SESSION = [];
session_unset();
session_destroy();

setcookie("key", "", time() - 3600, '/rucas.co/login.php');
setcookie("username", "", time() - 3600, '/rucas.co/login.php');
setcookie("role", "", time() - 3600, '/rucas.co/login.php');

header("Location: /rucas.co/index.php");
