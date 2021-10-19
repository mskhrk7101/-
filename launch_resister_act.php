<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();

// var_dump($_POST);
// exit();


if (
    !isset($_POST['release_date']) || $_POST['release_date'] == '' ||
    !isset($_POST['brand_name']) || $_POST['brand_name'] == '' ||
    !isset($_POST['kinds']) || $_POST['kinds'] == '' ||
    !isset($_POST['shoes']) || $_POST['shoes'] == ''
) {
    echo json_encode(["error_msg" => "no input"]);
    exit();
}
// var_dump('ok');
// exit();
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $uploaded_file_name = $_FILES['image']['name']; //ファイル名を取得
    $temp_path = $_FILES['image']['tmp_name']; //tmpフォルダの場所
    $directory_path = 'launch/'; //アップロード先フォルダ(自分で決める)
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
$release_date = $_POST['release_date'];
$shoes = $_POST['shoes'];
$brand_name = $_POST['brand_name'];
$kinds = $_POST['kinds'];
// var_dump($_SESSION);
// exit();
// var_dump($_POST);
// exit();


$sql = 'INSERT INTO launch_table(id,image,brand_name,kinds,release_date,shoes,created_at) VALUES(NULL, :image,:brand_name,:kinds, :release_date,:shoes, sysdate())';

try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':image', $filename_to_save, PDO::PARAM_STR);
    $stmt->bindValue(':kinds', $kinds, PDO::PARAM_STR);
    $stmt->bindValue(':brand_name', $brand_name, PDO::PARAM_STR);
    $stmt->bindValue(':release_date', $release_date, PDO::PARAM_STR);
    $stmt->bindValue(':shoes', $shoes, PDO::PARAM_STR);
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
    header("Location:media.php");
    exit();
}
