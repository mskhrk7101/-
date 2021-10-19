<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();
$user_id = $_SESSION['user_id'];

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
    <title>出品ページ</title>
    <link rel="stylesheet" href="style.css">
    <style>
        h3 {
            margin: 35px 0 0 30px;
            /* background-color: black; */
            color: black;
            /* width: 130px;
            height: 40px; */
            /* text-align: center; */
        }
    </style>
</head>

<body>
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
        <a href="user_edit.php" class="menu__item">アカウント編集</a>
        <a href="setting.php" class="menu__item">設定</a>
        <a href="company.php" class="menu__item">ホリマニアとは？</a>
        <a href="help.php" class="menu__item">ヘルプ</a>
        <a href="contact.php" class="menu__item">お問い合わせ</a>
    </div>
    <br>
    <br>
    <br>
    <br>
    <h1>商品状態</h1>
    <br>
    <br>
    <div style="display:flex;justify-content:space-evenly;align-items: center;">
        <form action="post_new_brand.php" method="POST" class="item_status">
            <input type="hidden" name="item_status" value="新品">
            <input type="hidden" name="brand_name" value=''>
            <input type="hidden" name="kinds" value=''>
            <input type="hidden" name="item_color" value=''>
            <input type="hidden" name="item_image" value=''>
            <input type="hidden" name="item_image2" value=''>
            <input type="hidden" name="item_image3" value=''>
            <input type="hidden" name="item_image4" value=''>
            <input type="hidden" name="item_image5" value=''>
            <input type="hidden" name="item_image6" value=''>
            <input type="hidden" name="item_name" value=''>
            <input type="hidden" name="good" value=''>
            <input type="hidden" name="size" value=''>
            <input type="hidden" name="owner_id" value=''>
            <input type="hidden" name="is_status" value=''>
            <input type="hidden" name="treaditem_id" value=''>
            <input type="hidden" name="send_status" value=''>

            <button type="submit"><img src="img/スニーカー・シューズのイラストアイコン素材 7.png" alt="new" width="100px" height="100px"><br>新品</button>

        </form>

        <form action="post_old_brand.php" method="POST" class="item_status">
            <input type="hidden" name="item_status" value="中古">
            <input type="hidden" name="brand_name" value=''>
            <input type="hidden" name="kinds" value=''>
            <input type="hidden" name="item_color" value=''>
            <input type="hidden" name="item_image" value=''>
            <input type="hidden" name="item_image2" value=''>
            <input type="hidden" name="item_image3" value=''>
            <input type="hidden" name="item_image4" value=''>
            <input type="hidden" name="item_image5" value=''>
            <input type="hidden" name="item_image6" value=''>
            <input type="hidden" name="item_name" value=''>
            <input type="hidden" name="good" value=''>
            <input type="hidden" name="size" value=''>
            <input type="hidden" name="owner_id" value=''>
            <input type="hidden" name="is_status" value=''>
            <input type="hidden" name="treaditem_id" value=''>
            <input type="hidden" name="send_status" value=''>
            <button type="submit"><img alt="old" src="img/iconmonstr-recycling-2.png" width="100px" height="100px"><br>中古</button>
        </form>

    </div>
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