<?php
session_start();
include("functions.php");
$pdo = connect_to_db();

$sql = 'SELECT * FROM item_table WHERE  is_status = 0 ORDER BY created_at ASC';
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
        $item_output .= "<img src='{$record["item_image"]}' width='300px'>";
        $item_output .= "<a href='item_select.php?id={$record["id"]}'>選択</a>";
        $item_output .= "<div>メーカー:{$record["brand_name"]}</div>";
        $item_output .= "<div>種類:{$record["kinds"]}</div>";
        $item_output .= "<div>商品名:{$record["item_name"]}</div>";
        $item_output .= "<div>サイズ:{$record["size"]}</div>";
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
    <title>マーケット ホーム</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- ハンバーガーメニュー -->
    <div class="menu-btn">
        <i class="fa fa-bars" aria-hidden="true"></i>
    </div>
    <div class="menu">
        <a href="company.php" class="menu__item">ホリマニアとは？</a>
        <a href="help.php" class="menu__item">ヘルプ</a>
        <a href="contact.php" class="menu__item">お問い合わせ</a>
    </div>
    <form action="index.php" method="POST" class="back">
        <input type="image" name="back" alt="back" src="img/iconmonstr-arrow-left-circle-thin.png" width="50px" height="50px">
    </form>
    <h1>全商品一覧</h1>
    <form action="index_act.php" method="POST">
        <select name="row" id="row">
            <option value="new">新しい順</option>
            <option value="old">古い順</option>
            <option value="english">A~Z</option>
        </select>
        <button type="submit">選択</button>
    </form>
    <div>
        <?= $item_output ?>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>


    <div class="sub-top">
        <a href="index2.php"><img alt="market" src="img/iconmonstr-shopping-cart-thin.png" width="50px" height="50px"> <br> マーケット</a> <br>

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