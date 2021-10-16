<?php
require_once "db.php";

session_start();
unset($_SESSION['logged_in_user_id']);
unset($_SESSION['logged_in_user_name']);

session_destroy();
header('Location: /admin');
