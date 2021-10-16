<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();
$user_id = $_SESSION['user_id'];

// var_dump($_POST);
// exit();

$brand_name = $_POST['brand_name'];
$kinds = $_POST['kinds'];
$item_id = $_POST['item_id'];
$item_image = $_POST['item_image'];
$item_name = $_POST['item_name'];
$size = $_POST['size'];
$item_status = $_POST['item_status'];
$user_id = $_SESSION['id'];
$owner_id = $_SESSION['id'];
$item_color = $_POST['item_color'];

if (
    !isset($_POST['size']) || $_POST['size'] == NULL ||
    !isset($_POST['item_image']) || $_POST['item_image'] == NULL ||
    !isset($_POST['item_color']) || $_POST['item_color'] == NULL ||
    !isset($_POST['item_name']) || $_POST['item_name'] == NULL
) {
    exit('選択されていません');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新品</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="post_status.php" method="POST" class="back">
        <input type="image" name="back" alt="back" src="img/iconmonstr-arrow-left-circle-thin.png" width="50px" height="50px"> <br>
        出品TOPへ戻る
    </form>
    <div>
        <h1>出品確認</h1>
    </div>
    <form action="post_display.php" method="POST" class="check">

        <fieldset>
            商品状態：<?= $item_status ?>
            ブランド名： <?= $brand_name ?><br>
            種類：<?= $kinds ?><br>
            <img src="<?= $item_image ?>" alt="" width="360px"> <br>
            商品名：<?= $item_name ?><br>
            サイズ：<?= $size ?><br>
        </fieldset>
        <input type="submit" value="出品" name="send">
    </form>
    <div class="sub-top">
        <a href="index2.php"><img alt="market" src="img/iconmonstr-shopping-cart-thin.png" width="50px" height="50px"> <br> マーケット</a> <br>

        <a href="media.2php"><img alt="media" src="img/safari_logo_icon_144917.png" width="50px" height="50px"> <br> メディア</a> <br>

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