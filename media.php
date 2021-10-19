<?php
session_start();
include("functions.php");
$pdo = connect_to_db();

$sql = 'SELECT * FROM launch_table ORDER BY release_date ASC';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["user_error_msg" => "{$error[2]}"]);
    exit();
} else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $image = $result['image'];
    $launch_output = "";
    foreach ($result as $record) {
        $launch_output .= "<div class='size'>";
        $launch_output .= "<img src='{$record["image"]}'width='300px'>";
        $launch_output .= "<div style='width: 300px; font-size:20px'>{$record["release_date"]}</div>";
        $launch_output .= "<div style='width: 300px;'>{$record["kinds"]}</div>";
        $launch_output .= "<div style='width: 300px;'>{$record["shoes"]}</div>";
        $launch_output .= "</div>";
    }
    unset($value);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>メディア</title>
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

        .size {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;

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
        <div class="log_in">
            <a href="log_in.php">ログイン/新規登録</a>
        </div>

    </div>

    <!-- ハンバーガーメニュー -->
    <div class="menu-btn">
        <i class="fa fa-bars" aria-hidden="true"></i>
    </div>
    <div class="menu">
        <a href="company.php" class="menu__item">ホリマニアとは？</a>
        <a href="help.php" class="menu__item">ヘルプ</a>
        <a href="contact.php" class="menu__item">お問い合わせ</a>
    </div>
    <div class="memu2">
        <a href="media.php" style="background-color: #a9a9a9; width:40%;">Launch</a>
        |
        <a href="media_post.php" style="width: 40%;">投稿</a>
    </div>


    <br>
    <br>
    <br>
    <br>
    <br>

    <h1>Launch</h1>
    <?= $launch_output ?>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="sub-top">
        <a href="index.php"><img alt="market" src="img/iconmonstr-shopping-cart-thin.png" width="50px" height="50px"> <br> マーケット</a> <br>

        <a href="media.php" style="background-color: #a9a9a9;"><img alt="media" src="img/safari_logo_icon_144917.png" width="50px" height="50px"> <br> メディア</a> <br>

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