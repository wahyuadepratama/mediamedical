<?php
require_once "db.php";

session_start();
if (!isset($_SESSION['logged_in_user_id'])) {
  header('Location: /admin');
}

if (isset($_GET['id'])) {

  $sql = $con->prepare("DELETE FROM data WHERE no_reg = ?");
  $sql->execute([$_GET['id']]);

  $result = [
    'success' => true,
  ];
  echo json_encode($result);
  die();
}

$result = [
  'success' => false,
  'data' => ''
];
echo json_encode($result);
