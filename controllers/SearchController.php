<?php
require_once "db.php";

if (!isset($_GET['data'])) {
  echo "Invalid Parameter!";
  die();
}

$sql = $con->prepare("SELECT * FROM data WHERE no_reg=?");
$sql->execute([$_GET['data']]);
$data = $sql->fetch();

if ($data) {
  $result = [
    'success' => true,
    'data' => $data
  ];
}else {
  $result = [
    'success' => false,
    'data' => ''
  ];
}

echo json_encode($result);
