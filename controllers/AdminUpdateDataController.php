<?php
require_once "db.php";

session_start();
if (!isset($_SESSION['logged_in_user_id'])) {
  header('Location: /admin');
}

if (isset($_GET['id'])) {

  $sql = $con->prepare("UPDATE data SET no_reg=?, nama=?, asal_daerah=?, judul_event=? WHERE no_reg = ?");
  $sql->execute([$_GET['id'], $_POST['nama'], $_POST['asal_daerah'], $_POST['judul_event'], $_GET['id']]);

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
