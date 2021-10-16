<?php
require_once "db.php";

session_start();
if (!isset($_SESSION['logged_in_user_id'])) {
  header('Location: /admin');
}

$limit = 100;
if (isset($_GET['limit'])) {
  $limit = $_GET['limit'];
}

if (isset($_GET['data'])) {
  $sql = $con->prepare("SELECT * FROM data WHERE no_reg like ? or nama like ? or asal_daerah like ? or judul_event like ? ORDER BY no_reg DESC LIMIT ".$limit);
  $param = $_GET['data'];
  $sql->execute(["%$param%","%$param%","%$param%","%$param%"]);
  $data = $sql->fetchAll();
}else {
  $sql = $con->prepare("SELECT * FROM data ORDER BY no_reg DESC LIMIT ".$limit);
  $sql->execute();
  $data = $sql->fetchAll();
}

$sql = $con->prepare("SELECT COUNT(*) as total FROM data");
$sql->execute();
$total_data = $sql->fetch();

if ($data) {
  $result = [
    'success' => true,
    'data' => $data,
    'total_data' => number_format($total_data['total'], '0', ',', '.')
  ];
}else {
  $result = [
    'success' => false,
    'data' => '',
    'total_data' => number_format($total_data['total'], '0', ',', '.')
  ];
}

echo json_encode($result);
