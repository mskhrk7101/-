<?php
// var_dump($_POST);
// exit();
session_start();
include("functions.php");
$pdo = connect_to_db();

// var_dump('ok');
// exit();
$sql = 'SELECT * FROM item_master_table';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["item_error_msg" => "{$error[2]}"]);
    exit();
} else {
    $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
    $item_output = "";
    foreach ($result as $record) {
        $item_output .= "<img src='{$record["item_image"]}' class=img width='50px'>";
        $item_output .= "<div>ブランド:{$record["brand_name"]}</div>";
        $item_output .= "<div>種類:{$record["kinds"]}</div>";
        $item_output .= "<div>商品名:{$record["item_name"]}</div>";
    }
    unset($value);
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品リスト一覧</title>
</head>

<body>
    <fieldset>
        <legend>商品リスト</legend>
        <a href="item_resister.php">入力画面</a><br>

        <?= $item_output ?>

    </fieldset>
    </form>
</body>

</html>