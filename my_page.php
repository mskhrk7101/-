<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();
$user_id = $_SESSION['user_id'];


$sql = 'SELECT * FROM users_table WHERE id = :id  ';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["user_error_msg" => "{$error[2]}"]);
    exit();
} else {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $user_output = "";
    $user_output .= "<div>ユーザーネーム<br>{$result["user_name"]}さん</div>";
}
$sql = 'SELECT * FROM item_table WHERE owner_id = :id AND is_status = 0';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["item_error_msg" => "{$error[2]}"]);
    exit();
} else {
    $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
    $item_output = "";
    foreach ($result as $record) {
        $item_output .= "<div class='size'>";
        $item_output .= "<img src='{$record["item_image"]}' width='300px'>";
        $item_output .= "<div style='width: 300px;'>{$record["brand_name"]}</div>";
        $item_output .= "<div style='width: 300px;'>{$record["kinds"]}</div>";
        $item_output .= "<div style='width: 300px;':>{$record["item_name"]}</div>";
        $item_output .= "<div style='width: 300px;':>{$record["size"]}</div>";
        // $item_output .= "<div>0人がオファー中</div>";
        $item_output .= "<div style='width: 300px;' class='aa'><a href='item_delete.php?id={$record["id"]}'>削除</a></div><br>";
        $item_output .= "</div>";
    }
    unset($value);
}

$sql = 'SELECT COUNT(*) FROM item_table WHERE owner_id = :id AND is_status = 2';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["count_error_msg" => "{$error[2]}"]);
    exit();
} else {
    $request_count = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>マイページ</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .select {
            margin: 35px 0 0 100px;
        }

        h3 {
            margin: 35px 0 0 30px;
            /* padding: 10px 0 0 0;
            /* background-color: black; */
            color: black;
            /* width: 130px;
            height: 40px; */
            /* text-align: center; */
        }

        .aa {
            width: 100%;
            /* background-color: #ff9a4a; */
            text-align: center;
            border: solid 1px black;
        }

        .sign_up {
            margin: 35px 0 0 80px;
        }



        .size {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;

        }
    </style>
</head>

<body>
    <div class="top">
        <div class="head-menu">
            <a href="index.php">
                <h3>ホリマニア</h3>
            </a>
            <!-- <div class="search">
                <input type="text" name="search" placeholder="検索" value="" size="20">
            </div> -->
            <div class="info">
                <a href="info.php">🔔<?= $request_count[0] ?>件</a>
            </div>
            <div class="log_out">
                <a href="log_out.php">ログアウト</a>
            </div>
        </div>
        <!-- ハンバーガーメニュー -->
        <div class="menu-btn">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </div>
        <div class="menu">

            <div class="menu__item"> <?= $user_output ?></div>
            <br>
            <br>

            <a href="user_edit.php" class="menu__item">アカウント編集</a>
            <a href="setting.php" class="menu__item">設定</a>
            <a href="company2.php" class="menu__item">ホリマニアとは？</a>
            <a href="help2.php" class="menu__item">ヘルプ</a>
            <a href="contact2.php" class="menu__item">お問い合わせ</a>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>

        <div>
            <a href="my_post.php" style="display:flex;justify-content:center;align-items: center;">投稿一覧</a>
        </div>
        <div style="display:flex;justify-content:space-evenly;align-items: center;">
            <a href=" my_page.php" style="background-color: #a9a9a9;">出品中</a>|
            <a href="offer.php">オファー</a>|
            <a href="treading.php">取引中</a>|
            <a href="finished.php">取引済み</a>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br><br>

    <h1>出品中</h1>
    <?= $item_output ?>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <div class="sub-top">
        <a href="index2.php"><img alt="market" src="img/iconmonstr-shopping-cart-thin.png" width="50px" height="50px"> <br> マーケット</a> <br>

        <a href="media2.php"><img alt="media" src="img/safari_logo_icon_144917.png" width="50px" height="50px"> <br> メディア</a> <br>

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