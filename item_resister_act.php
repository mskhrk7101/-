<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();

// var_dump($_POST);
// exit();


if (
    !isset($_POST['brand_name']) || $_POST['brand_name'] == '' ||
    !isset($_POST['kinds']) || $_POST['kinds'] == '' ||
    !isset($_POST['item_color']) || $_POST['item_color'] == '' ||
    !isset($_POST['item_name']) || $_POST['item_name'] == '' ||
    !isset($_POST['release_date']) || $_POST['release_date'] == ''
) {
    echo json_encode(["error_msg" => "no input"]);
    exit();
}
// var_dump('ok');
// exit();
if (isset($_FILES['item_image']) && $_FILES['item_image']['error'] == 0) {
    $uploaded_file_name = $_FILES['item_image']['name']; //ファイル名を取得
    $temp_path = $_FILES['item_image']['tmp_name']; //tmpフォルダの場所
    $directory_path = 'upload/'; //アップロード先ォルダ(自分で決める)
    $extension = pathinfo($uploaded_file_name, PATHINFO_EXTENSION);
    $unique_name = date('YmdHis') . md5(session_id()) . "." . $extension;
    $filename_to_save = $directory_path . $unique_name;
    if (is_uploaded_file($temp_path)) {

        if (move_uploaded_file($temp_path, $filename_to_save)) {
            chmod($filename_to_save, 0644);
        } else {
            exit('ERROR:アップロードできませんでした');
        }
    } else {
        exit('ERROR:画像がありません');
    }
} else {
    exit('error:画像が送信されていません');
}
$brand_name = $_POST['brand_name'];
$kinds = $_POST['kinds'];
$item_color = $_POST['item_color'];
$item_name = $_POST['item_name'];
$release_date = $_POST['release_date'];
// var_dump($_SESSION);
// exit();
// var_dump($_POST);
// exit();


$sql = 'INSERT INTO item_master_table(id, brand_name, kinds, item_color, item_image, item_name, release_date, created_at,updated_at) 
VALUES(NULL, :brand_name, :kinds, :item_color, :item_image, :item_name, :release_date, sysdate(), sysdate())';

try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':brand_name', $brand_name, PDO::PARAM_STR);
    $stmt->bindValue(':kinds', $kinds, PDO::PARAM_STR);
    $stmt->bindValue(':item_color', $item_color, PDO::PARAM_STR);
    $stmt->bindValue(':item_image', $filename_to_save, PDO::PARAM_STR);
    $stmt->bindValue(':item_name', $item_name, PDO::PARAM_STR);
    $stmt->bindValue(':release_date', $release_date, PDO::PARAM_STR);
    $status = $stmt->execute();
} catch (Exception $e) {
    var_dump($e);
    exit();
}
// var_dump($_POST);
// exit();
if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    header("Location:item_read.php");
    exit();
}
