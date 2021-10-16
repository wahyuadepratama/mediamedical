<?php
require_once "db.php";

session_start();
if (!isset($_SESSION['logged_in_user_id'])) {
  header('Location: /admin');
}

if (isset($_POST['data'])){
  foreach ($_POST['data'] as $key) {
    $data = array_values(json_decode($key, true));
    $sql = $con->prepare("DELETE FROM data WHERE no_reg = ?");
    $sql->execute([$data[0]]);
  }

  $result = [
    'success' => true    
  ];
  echo json_encode($result);
  die();
}

$result = [
  'success' => false,
  'data' => ''
];
echo json_encode($result);
