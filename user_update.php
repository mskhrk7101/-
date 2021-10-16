<?php
session_start();
include('functions.php');
check_session_id();
$pdo = connect_to_db();
// var_dump($_POST);
// exit();

if (
    !isset($_POST['user_name']) || $_POST['user_name'] == '' ||
    !isset($_POST['email']) || $_POST['email'] == '' ||
    !isset($_POST['password']) || $_POST['password'] == '' ||
    !isset($_POST['address']) || $_POST['address'] == ''
) {
    echo json_encode(["error_msg" => "no input"]);
    exit();
}

$user_name = $_POST['user_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$address = $_POST['address'];

$id = $_SESSION['id'];

$sql = "UPDATE users_table SET user_name=:user_name, email=:email, address=:address, password=:password, updated_at=sysdate() WHERE id=:id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':address', $address, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    exit('QueryError:' . $error[2]);
} else {
    header("Location:my_page.php");
    exit;
}
