<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();
$user_id = $_SESSION['user_id'];

// var_dump($_POST);
// exit();
// $user_name = $_SESSION['user_name'];
// $session_id = $_SESSION['id'];
// var_dump($_SESSION);
// exit();

// $sql = 'SELECT * FROM item_table WHERE owner_id != :id AND is_status = 0 ORDER BY created_at ASC LIMIT 5';
// $stmt = $pdo->prepare($sql);
// $stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
// $status = $stmt->execute();

// if ($status == false) {
//     $error = $stmt->errorInfo();
//     echo json_encode(["item_error_msg" => "{$error[2]}"]);
//     exit();
// } else {
//     $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
//     $item_output = "";
//     foreach ($result as $record) {
//         $item_output .= "<img src='{$record["item_image"]}' width='300px'>";
//         $item_output .= "<a href='item_select.php?id={$record["id"]}'>選択</a>";
//         $item_output .= "<div>メーカー:{$record["brand_name"]}</div>";
//         $item_output .= "<div>種類:{$record["kinds"]}</div>";
//         $item_output .= "<div>商品名:{$record["item_name"]}</div>";
//         $item_output .= "<div>サイズ:{$record["size"]}</div>";
//         $item_output .= "<div>0人がオファー中</div>";
//     }
//     unset($value);
// }
// $sql = 'SELECT * FROM item_table WHERE owner_id != :id AND is_status = 0 ORDER BY created_at DESC LIMIT 5';
// $stmt = $pdo->prepare($sql);
// $stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
// $status = $stmt->execute();

// if ($status == false) {
//     $error = $stmt->errorInfo();
//     echo json_encode(["item_error_msg" => "{$error[2]}"]);
//     exit();
// } else {
//     $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
//     $item_output = "";
//     foreach ($result as $record) {
//         $item_output .= "<img src='{$record["item_image"]}' width='300px'>";
//         $item_output .= "<a href='item_select.php?id={$record["id"]}'>選択</a>";
//         $item_output .= "<div>メーカー:{$record["brand_name"]}</div>";
//         $item_output .= "<div>種類:{$record["kinds"]}</div>";
//         $item_output .= "<div>商品名:{$record["item_name"]}</div>";
//         $item_output .= "<div>サイズ:{$record["size"]}</div>";
//         $item_output .= "<div>0人がオファー中</div>";
//     }
//     unset($value);
// }
