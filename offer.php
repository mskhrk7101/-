<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();
$user_id = $_SESSION['user_id'];

// var_dump($user_id);
// exit();
$sql = 'SELECT * FROM item_table WHERE owner_id = :id AND is_status = 1';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
$status = $stmt->execute();

// var_dump($user_id);
// exit();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {

    $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
    if ($result) {


        $my_result = "";
        $tradeitem_result = "";

        foreach ($result as $record) {
            $my_result .= " <fieldset>";
            $my_result .= "<legend>自分の出品商品 詳細</legend>";
            $my_result .= "<a href='trade_request.php?item_id={$record["id"]}'><img src='{$record["item_image"]}' width=300px class=img></a>";
            $my_result .= "<div>商品名:{$record["item_name"]}</div>";
            $my_result .= "<div>メーカー:{$record["brand_name"]}</div>";
            $my_result .= "<div>サイズ:{$record["size"]}</div>";
            $my_result .= " </fieldset><br>";
            $my_result .= "↑↓";


            $sql = 'SELECT * FROM item_table WHERE id = :treaditem_id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':treaditem_id', $record['treaditem_id'], PDO::PARAM_INT);
            $status = $stmt->execute();
            if ($status == false) {
                $error = $stmt->errorInfo();
                echo json_encode(["error_msg" => "{$error[2]}"]);
                exit();
            } else {
                $treaded_item = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            $my_result .= "<fieldset>";
            $my_result .= "<legend>相手の出品商品 詳細</legend>";
            $my_result .= "<img src='{$treaded_item["item_image"]}'width='300px'>";
            $my_result .= "<div>商品名 {$treaded_item["item_name"]}</div>";
            $my_result .= "<div>メーカー{$treaded_item["brand_name"]}</div>";
            $my_result .= "<div>サイズ{$treaded_item["size"]}</div>";
            $my_result .= " </fieldset>";
        }
        unset($value);

        // var_dump($result);
        // exit();
        // var_dump($result[1]);
        // exit();

        // var_dump($treaditem_id);
        // exit();

        // $sql = 'SELECT * FROM item_table WHERE treaditem_id  = :treaditem_id AND is_status = 2';
        // $stmt = $pdo->prepare($sql);
        // $stmt->bindValue(':treaditem_id', $treaditem_id, PDO::PARAM_INT);
        // $status = $stmt->execute();


        // if ($status == false) {
        //     $error = $stmt->errorInfo();
        //     echo json_encode(["error_msg" => "{$error[2]}"]);
        //     exit();
        // } else {
        //     $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        //     $tradeitem_result = "";
        //     foreach ($result as $record) {
        //         $tradeitem_result .= "<fieldset>";
        //         $tradeitem_result .= "<legend>相手の出品商品 詳細</legend>";
        //         $tradeitem_result .= "<img src='{$record["item_image"]}'width='300px'>";
        //         $tradeitem_result .= "<div>商品名 {$record["item_name"]}</div>";
        //         $tradeitem_result .= "<div>メーカー{$record["brand_name"]}</div>";
        //         $tradeitem_result .= "<div>サイズ{$record["size"]}</div>";
        //         $tradeitem_result .= " </fieldset>";
        //     }
        //     unset($value);
        // }
    } else {


        $my_result = "オファーがありません";
    }
}





// $sql = 'SELECT * FROM users_table WHERE id = :id';
// $stmt = $pdo->prepare($sql);
// $stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
// $status = $stmt->execute();

// if ($status == false) {
//     $error = $stmt->errorInfo();
//     echo json_encode(["user_error_msg" => "{$error[2]}"]);
//     exit();
// } else {
//     $result = $stmt->fetch(PDO::FETCH_ASSOC);
// }
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
</head>

<body>
    <div class="head-menu">
        <div class="search">
            <input type="text" name="search" placeholder="検索" value="" size="20">
        </div>
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
    <div class="top-memu">
        <a href="my_post.php">投稿一覧</a>
    </div>
    <div class="sub-memu">
        <a href="my_page.php">出品中</a>
        <a href="offer.php">オファー</a>
        <a href="treading.php">取引中</a>
        <a href="finished.php">取引済み</a>
    </div>
    <div>
        <h1>オファー中</h1>
    </div>
    <?= $my_result ?>
    <?= $tradeitem_result ?>

    <div>
        <h1>オファー受信</h1>
    </div>

    <br>
    <form action="item_yes.php" method="POST" class="yes">
        <input type="submit" name="yes" value="承諾" width="50px" height="50px">
    </form>
    <form action="item_no.php" method="POST" class="no">
        <input type="submit" name="no" value="拒否" width="50px" height="50px">
    </form>
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