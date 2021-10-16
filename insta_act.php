<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();

// var_dump($_POST);
// exit();


if (
    !isset($_POST['message']) || $_POST['message'] == ''
) {
    echo json_encode(["error_msg" => "no input"]);
    exit();
}
// var_dump('ok');
// exit();
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $uploaded_file_name = $_FILES['image']['name']; //ファイル名を取得
    $temp_path = $_FILES['image']['tmp_name']; //tmpフォルダの場所
    $directory_path = 'post/'; //アップロード先フォルダ(自分で決める)
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
$message = $_POST['message'];
// var_dump($_SESSION);
// exit();
// var_dump($_POST);
// exit();


$sql = 'INSERT INTO insta_table(id,image, message,created_at) VALUES(NULL, :image, :message, sysdate())';

try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':image', $filename_to_save, PDO::PARAM_STR);
    $stmt->bindValue(':message', $message, PDO::PARAM_STR);
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
    header("Location:media_post.php");
    exit();
}
