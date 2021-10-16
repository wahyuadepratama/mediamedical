<?php
require_once "db.php";

if (isset($_POST['username']) && isset($_POST['password'])) {
  $sql = $con->prepare("SELECT id, username FROM admin WHERE username=? AND password=?");
  $sql->execute([$_POST['username'], $_POST['password']]);
  $data = $sql->fetch();

  if ($data) {

    session_start();
    $_SESSION['logged_in_user_id'] = $data['id'];
    $_SESSION['logged_in_user_name'] = $data['username'];

    $result = [
      'success' => true,
      'data' => $data
    ];
    echo json_encode($result);
    die();
  }
}

$result = [
  'success' => false,
  'data' => ''
];
echo json_encode($result);
