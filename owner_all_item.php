<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();

$owner_id = $_GET['id'];
$user_name = $_SESSION['user_name'];

$sql = 'SELECT * FROM item_table WHERE owner_id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $owner_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
    $output = "";
    foreach ($result as $record) {

        $output .= "<a href='item_request.php?id={$record["id"]}'><img src='{$record["item_image"]}' width=300px class=img></a>";
        $output .= "<div class=aaa>商品名{$record["item_name"]}</div>";
        $output .= "<div class=aaa>メーカー名{$record["brand_name"]}</div>";
        $output .= "<div class=aaa>サイズ{$record["size"]}</div>";
        $output .= "<a href='item_request.php?id={$record["id"]}' class=aaa>選択する</a>";
    }
    unset($value);
}

$sql = 'SELECT * FROM users_table WHERE id = :owner_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':owner_id', $owner_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
    $user_image = $result['user_image'];
    $owner_name = "";
    $owner_name .= "<div>出品者 : {$result[0]["user_name"]} さん</div>";
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
    <!-- <form action="item_select.php" method="GET" class="back" onclick="history.back(-1)">
        <input type="image" name="back" alt="back" src="img/iconmonstr-arrow-left-circle-thin.png" width="50px" height="50px">
    </form> -->
    <input type="button" value="戻る" onclick="history.back(-1)">
    <!-- ハンバーガーメニュー -->
    <div class="menu-btn">
        <i class="fa fa-bars" aria-hidden="true"></i>
    </div>
    <div class="menu">
        <a href="my_page.php" class="menu__item">マイページ</a>
        <a href="List.php" class="menu__item">他のユーザーの出品商品一覧ページへ</a>
        <a href="contact_input.php" class="menu__item">コンタクトページへ</a>
        <a href="log_out.php" class="menu__item">ログアウト</a>
    </div>
    <div>
        <h2>オーナー出品商品一覧</h2>
    </div>
    <h3><?= $owner_name ?></h3>
    <div class="set">
        <fieldset class=set>
            <legend class="text">出品商品 一覧</legend>
            <table>

                <?= $output ?>

            </table>
        </fieldset>
    </div>
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