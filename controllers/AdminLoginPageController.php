<?php
session_start();
if (isset($_SESSION['logged_in_user_id'])) {
  header('Location: /admin/home');
}

require_once "views/admin_Login.php";
