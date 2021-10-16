<?php
require_once "db.php";

session_start();
if (!isset($_SESSION['logged_in_user_id'])) {
  header('Location: /admin');
}

if (isset($_POST['data_excel'])) {

  foreach ($_POST['data_excel'] as $key) {
    $data = array_values(json_decode($key, true));
    $sql = $con->prepare('INSERT INTO `data`(`no_reg`,`nama`, `asal_daerah`,`judul_event`) VALUES (?,?,?,?) ON DUPLICATE KEY UPDATE nama = ?, asal_daerah = ?, judul_event = ?');
    $sql->execute([$data[0], $data[1], $data[2], $data[3], $data[1], $data[2], $data[3]]);
  }

  $result = [
    'success' => true,
    'message' => count($_POST['data_excel'])." data inserted",
  ];
  echo json_encode($result);
  die();
}

$result = [
  'success' => false,
  'data' => ''
];
echo json_encode($result);
