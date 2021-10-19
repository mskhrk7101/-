<?php
// var_dump($_POST);
// exit();
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();
$user_id = $_SESSION['user_id'];
$treaditem_id = $_POST['treaditem_id'];
$id = $_POST['user_id'];

$sql = "UPDATE item_table SET treaditem_id='', is_status='' WHERE treaditem_id = :id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
// $stmt->bindValue(':treaditem_id', $treaditem_id, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["treaditem_id_error_msg" => "{$error[2]}"]);
    exit();
}

$sql = "UPDATE item_table SET is_status='' ,treaditem_id=''  WHERE treaditem_id = :treaditem_id ";

$stmt = $pdo->prepare($sql);
// $stmt->bindValue(':id', $id, PDO::PARAM_STR);
$stmt->bindValue(':treaditem_id', $treaditem_id, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["treaditem_id_error_msg" => "{$error[2]}"]);
    exit();
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
</head>

<body>
    <div class="head-menu">
        <div class="search">
            <input type="text" name="search" placeholder="検索" value="" size="20">
        </div>
        <div class="info">
            <a href="info.php">🔔</a>
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
    <div>
        <h1>オファー拒否しました。</h1>
        <h2>Thanks!!!</h2>
    </div>
    <form action="offer.php" method="POST" class="my_page">
        <input type="submit" name="my_page" value="マイページへ" width="50px" height="50px">
    </form>
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