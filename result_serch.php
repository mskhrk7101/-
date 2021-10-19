<?php
session_start();
include("functions.php");
$pdo = connect_to_db();
// var_dump($_POST);
// exit();
$brand_name = $_POST['brand_name'];
$kinds = $_POST['kinds'];
$item_id = $_POST['item_id'];
$item_image = $_POST['item_image'];
$item_name = $_POST['item_name'];
$size = $_POST['size'];
$item_color = $_POST['item_color'];

if (
    !isset($_POST['item_image']) || $_POST['item_image'] == NULL ||
    !isset($_POST['size']) || $_POST['size'] == NULL ||
    !isset($_POST['item_name']) || $_POST['item_name'] == NULL
) {
    exit('商品が選択されていません');
}
try {
    $sql = 'SELECT item_name=:item_name,size=:size FROM item_table ';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':item_name', $item_name, PDO::PARAM_STR);
    $stmt->bindValue(':size', $size, PDO::PARAM_STR);
    $status = $stmt->execute();
} catch (Exception $e) {
    var_dump($e);
    exit();
}
if ($status == false) {
    $error = $stmt->errorInfo();
    exit('sqlError:' . $error[2]);
} else {
    $sql = 'SELECT * FROM item_table WHERE size=:size';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':size', $size, PDO::PARAM_STR);
    $status = $stmt->execute();
    // $item_output = $stmt->fetch(PDO::FETCH_ASSOC);
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $item_output .= '<form action="select_item.php" method="POST">';
        $item_output .= "<img src='{$result['item_image']}'width='375px'>";
        $item_output .= "<div>{$result["kinds"]}</div>";
        $item_output .= "<div>{$result["item_name"]}</div>";
        $item_output .= "<div>{$result["size"]}</div>";
        $item_output .= "<input type='hidden' name='brand_name' value='{$result["brand_name"]}'>";
        $item_output .= "<input type='hidden' name='kinds' value='{$result["kinds"]}'>";
        $item_output .= " <input type='hidden' name='item_id' value='{$result["id"]}'>";
        $item_output .= "<button type=submit>選択</button>";
        $item_output .= "</form>";
    }
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
            <div class="log_out">
                <a href="log_out.php">ログアウト</a>
            </div>
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
    <h1>検索結果</h1>
    <?= $item_output ?>
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