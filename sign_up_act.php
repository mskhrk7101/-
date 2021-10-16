<?php
session_start();
include('functions.php');
$pdo = connect_to_db();
// var_dump($_POST);
// exit();
// var_dump('ok');
// exit();
if (
    !isset($_POST['user_name']) || $_POST['user_name'] == '' ||
    !isset($_POST['email']) || $_POST['email'] == '' ||
    !isset($_POST['address']) || $_POST['address'] == '' ||
    !isset($_POST['birthday']) || $_POST['birthday'] == '' ||
    !isset($_POST['sex']) || $_POST['sex'] == '' ||
    !isset($_POST['password']) || $_POST['password'] == ''
) {
    exit('Param Error');
}
// var_dump('ok');
// exit();
$user_name = $_POST["user_name"];
$email = $_POST["email"];
$address = $_POST["address"];
$birthday = $_POST["birthday"];
$sex = $_POST["sex"];
$password = $_POST["password"];
$user_image = "userimg/iconmonstr-user-9.png";

// var_dump('ok');
// exit();

$sql = 'INSERT INTO users_table (id, image, user_name, email, address, birthday, sex, password, created_at, updated_at)
VALUES (NULL, :image, :user_name, :email, :address, :birthday, :sex,  :password, sysdate(), sysdate())';

// var_dump('ok');
// exit();

try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':image', $image, PDO::PARAM_STR);
    $stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':address', $address, PDO::PARAM_STR);
    $stmt->bindValue(':birthday', $birthday, PDO::PARAM_STR);
    $stmt->bindValue(':sex', $sex, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $status = $stmt->execute();
} catch (Exception $e) {
    var_dump($e);
    exit();
}
if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
}
// var_dump($_POST);
// exit();

$sql = 'SELECT * FROM users_table WHERE user_name=:user_name AND password=:password';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
}


$val = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$val) {
    echo "<p>すでに登録されているユーザです．</p>";
    echo '<a href="log_in.php">login</a>';
    exit();
} else {
    $_SESSION = array();
    $_SESSION['session_id'] = session_id();
    $_SESSION['user_id'] = $val['id'];
    // $_SESSION['id'] = $val['id'];
    header('Location:index2.php');
    exit();
}
