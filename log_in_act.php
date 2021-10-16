<?php
session_start();

include('functions.php');
$pdo = connect_to_db();

$user_name = $_POST['user_name'];
$password = $_POST['password'];

$sql = 'SELECT * FROM users_table WHERE user_name=:user_name AND password=:password';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
}
$val = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($val);
// exit();
if (!$val) {
    echo '<p>ログインに誤りがあります。</p>';
    echo '<a href="log_in.php">login</a>';
    exit();
} else {

    $_SESSION = array();
    $_SESSION['session_id'] = session_id();
    // $_SESSION['user_id'] = $val['user_id'];
    $_SESSION["user_id"] = $val["id"];
    header('Location:index2.php');
    exit();
}
