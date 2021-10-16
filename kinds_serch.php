<?php
session_start();
include("functions.php");
$pdo = connect_to_db();

// var_dump($_POST);
// exit();
$brand_name = $_POST['brand_name'];
// var_dump($_POST);
// exit();

if (
    !isset($_POST['brand_name']) || $_POST['brand_name'] == NULL
) {
    exit('ブランドが選択されていません');
}

try {
    $sql = 'SELECT * FROM item_master_table WHERE brand_name=:brand_name';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':brand_name', $brand_name, PDO::PARAM_STR);
    $status = $stmt->execute();
} catch (Exception $e) {
    var_dump($e);
    exit();
}

if ($status == false) {
    $error = $stmt->errorInfo();
    exit('sqlError:' . $error[2]);
} else {
    $sql = 'SELECT * FROM item_master_table WHERE brand_name=:brand_name';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':brand_name', $brand_name, PDO::PARAM_STR);
    $status = $stmt->execute();
    // $item_output = $stmt->fetch(PDO::FETCH_ASSOC);
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $item_output .= '<form action="item_serch.php" method="POST">';
        $item_output .= "<div>{$result["kinds"]}</div>";
        $item_output .= "<input type='hidden' name='brand_name' value='{$result["brand_name"]}'>";
        $item_output .= "<input type='hidden' name='kinds' value='{$result["kinds"]}'>";
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
    <title>検索</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="index.php" method="POST" class="back">
        <input type="image" name="back" alt="back" src="img/iconmonstr-arrow-left-circle-thin.png" width="50px" height="50px">
    </form>
    <div>
        <h2>商品種類</h2>
    </div>
    <div>
        <?= $item_output ?>
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