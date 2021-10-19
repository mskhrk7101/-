<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();
$user_id = $_SESSION['user_id'];


$item_id = $_GET['id'];
$user_name = $_SESSION['user_name'];

$sql = 'SELECT * FROM item_table WHERE owner_id = :id AND is_status = 0';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
    $output = "";
    foreach ($result as $record) {

        $output .= "<a href='item_request_check.php?my_item_id={$record["id"]}&target_item_id=$item_id'><img src='{$record["item_image"]}'width='300px'></a>";
        $output .= "<div class=aaa>商品名:{$record["item_name"]}</div>";
        $output .= "<div class=aaa>メーカー:{$record["brand_name"]}</div>";
        $output .= "<div class=aaa>サイズ:{$record["size"]}</div>";
        $output .= "<a href='item_request_check.php?my_item_id={$record["id"]}&target_item_id=$item_id' class=aaa>選択する</a>";
    }
    unset($value);
}

$sql = 'SELECT * FROM users_table WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["user_error_msg" => "{$error[2]}"]);
    exit();
} else {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $user_image = $result['user_image'];
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>マイページ</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- ハンバーガーメニュー -->
    <div class="menu-btn">
        <i class="fa fa-bars" aria-hidden="true"></i>
    </div>
    <div class="menu">
        <a href="user_edit.php" class="menu__item">アカウント編集</a>
        <a href="setting.php" class="menu__item">設定</a>
        <a href="company.php" class="menu__item">ホリマニアとは？</a>
        <a href="help.php" class="menu__item">ヘルプ</a>
        <a href="contact.php" class="menu__item">お問い合わせ</a>
    </div>
    <div>
        <h2>出品商品リスト</h2>
    </div>
    <fieldset>
        <legend>自分の出品商品 一覧</legend>
        <h3>トレードするアイテムを選択して下さい</h3>


        <?= $output ?>


    </fieldset>
    <br><br><br><br>
    <div class="sub-top">
        <a href="index.php"><img alt="market" src="img/iconmonstr-shopping-cart-thin.png" width="50px" height="50px"> <br> マーケット</a> <br>

        <a href="media.php"><img alt="media" src="img/safari_logo_icon_144917.png" width="50px" height="50px"> <br> メディア</a> <br>

        <a href="post_status.php"><img alt="post_status" src="img/iconmonstr-plus-circle-thin.png" width="50px" height="50px"> <br> 出品</a> <br>

        <a href="like.php"><img alt="like" src="img/iconmonstr-heart-thin.png" width="50px" height="50px"> <br> お気に入り</a> <br>

        <a href="my_page.php"><img alt="my_page" src="img/iconmonstr-user-male-thin.png" width="50px" height="50px"> <br>マイページ</a> <br>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script>
        $(function() {
            $('.menu-btn').on('click', function() {
                $('.menu').toggleClass('is-active');
            });
        }());
    </script>
</body>

</html>