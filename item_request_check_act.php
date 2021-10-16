<?php
// var_dump($_GET);
// exit();

$Target_id = $_GET["Target_id"];
$My_id = $_GET["My_id"];

// var_dump($Target_id);
// var_dump($My_id);
// exit();

session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();

// 相手の商品情報のis_statusを2（他ユーザーから交換の依頼あり）に、tradeItem_idを自分の商品idに更新
$sql = "UPDATE item_table SET is_status=2 , treaditem_id = :My_id WHERE id=:Target_id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':My_id', $My_id, PDO::PARAM_STR);
$stmt->bindValue(':Target_id', $Target_id, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["Target_id_error_msg" => "{$error[2]}"]);
    exit();
}

// 自分の商品情報のis_statusを１（他ユーザーに交換依頼中）に、tradeItem_idを相手の商品idに更新
$sql = "UPDATE item_table SET is_status=1 , treaditem_id = :Target_id WHERE id=:My_id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':Target_id', $Target_id, PDO::PARAM_STR);
$stmt->bindValue(':My_id', $My_id, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["My_id_error_msg" => "{$error[2]}"]);
    exit();
} else {
    header("Location:item_request_finish.php");
    exit();
}
