<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();
$user_id = $_SESSION['user_id'];

$my_item_id = $_GET['my_item_id'];
$target_item_id = $_GET['target_item_id'];

$sql = 'SELECT * FROM item_table WHERE id = :my_item_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':my_item_id', $my_item_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $My_result = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($My_result);
}

$sql = 'SELECT * FROM item_table WHERE id = :target_item_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':target_item_id', $target_item_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $Target_result = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($Target_result);
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
    <form action="index.php" method="POST" class="back">
        <input type="image" name="back" alt="back" src="img/iconmonstr-arrow-left-circle-thin.png" width="50px" height="50px">
    </form>

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
        <h2>商品詳細</h2>
    </div>
    <div class="form">
        <fieldset>
            <legend class="text">相手の出品商品 詳細</legend>
            <div>
                <div class="img"><img src=<?= $Target_result["item_image"] ?> width="300px"></div>
                <div class="aaa">商品名<?= $Target_result["item_name"] ?></div>
                <div class="aaa">メーカー<?= $Target_result["brand_name"] ?></div>
                <div class="aaa"><?= $Target_result["size"] ?></div>
            </div>
        </fieldset>
    </div>
    <div class="chenge">↑↓</div>
    <fieldset class="form2">
        <legend class="text">自分の出品商品 詳細</legend>
        <div>
            <div class="img"><img src=<?= $My_result["item_image"] ?> width="300px"></div>
            <div class="aaa">商品名<?= $My_result["item_name"] ?></div>
            <div class="aaa">メーカー<?= $My_result["brand_name"] ?></div>
            <div class="aaa"><?= $My_result["size"] ?></div>
        </div>
    </fieldset>
    <a class="submit" href='item_request_check_act.php?Target_id=<?= $Target_result["id"] ?>&My_id=<?= $My_result["id"] ?>'>交換依頼</a>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

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