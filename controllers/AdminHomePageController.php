<?php
session_start();
if (!isset($_SESSION['logged_in_user_id'])) {
  header('Location: /admin');
}

require_once "views/admin_home.php";

// for ($i=1; $i <= 10000; $i++) {
//   $sql = $con->prepare('INSERT INTO `admin`(`id`,`username`, `password`) VALUES (?,?,?) ON DUPLICATE KEY UPDATE username = ?, password = ?');
//   $sql->execute([$i, "username".$i, "password".$i, "duplicate username ".$i, "duplicate password ".$i]);
// }
