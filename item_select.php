<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();

$item_id = $_GET['id'];
$user_name = $_SESSION['user_name'];

$sql = 'SELECT * FROM item_table WHERE id = :item_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':item_id', $item_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
    $owner_id = $result[0]['owner_id'];
    $output .= "<div><img src='{$result[0]["item_image"]}' width='300px'></div>";
    $output .= "<div>タイトル : {$result[0]["item_name"]}</div>";
    $output .= "<div>メーカー : {$result[0]["brand_name"]}</div>";
    $output .= "<div>サイズ : {$result[0]["size"]}</div>";
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
    $owner_image = $result['user_image'];
    $owner_name = "";
    $owner_name .= "<a href='owner_all_item.php?id={$result[0]["id"]}' >出品者 : {$result[0]["user_name"]} さん</a>";
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>選択したアイテムのページ</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="index2.php" method="POST" class="back">
        <input type="image" name="back" alt="back" src="img/iconmonstr-arrow-left-circle-thin.png" width="50px" height="50px">
    </form>

    <!-- ハンバーガーメニュー -->
    <div class="menu-btn">
        <i class="fa fa-bars" aria-hidden="true"></i>
    </div>
    <div class="menu">
        <a href="user_edit.php" class="menu__item">アカウント編集</a>
        <a href="setting.php" class="menu__item">設定</a>
        <a href="company2.php" class="menu__item">ホリマニアとは？</a>
        <a href="help2.php" class="menu__item">ヘルプ</a>
        <a href="contact2.php" class="menu__item">お問い合わせ</a>
    </div>
    <div>
        <h2>選択アイテムの確認</h2>
    </div>
    <div class="set">
        <fieldset>
            <legend class="text">選んだ商品の詳細</legend>
            <h2><?= $owner_name ?></h2>
            <?= $output ?>
        </fieldset>
    </div>
    <h2 class="submit"><a href="item_request.php?id=<?= $item_id ?>">トレードを依頼する</a></h2>

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