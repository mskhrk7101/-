<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();

// var_dump($_POST);
// exit();
$id =$_SESSION['id'];
$brand_name = $_POST['brand_name'];
$kinds = $_POST['kinds'];
$item_id = $_POST['item_id'];
$item_image = $_POST['item_image'];
$item_name = $_POST['item_name'];
$item_status = $_POST['item_status'];
$item_color = $_POST['item_color'];

if (
    !isset($_POST['item_image']) || $_POST['item_image'] == NULL ||
    !isset($_POST['item_color']) || $_POST['item_color'] == NULL ||
    !isset($_POST['item_name']) || $_POST['item_name'] == NULL
) {
    exit('商品が選択されていません');
}

try {
    $sql = 'UPDATE item_table SET  item_name = :item_name, item_image=:item_image,item_color=:item_color WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':item_name', $item_name, PDO::PARAM_STR);
    $stmt->bindValue(':item_color', $item_color, PDO::PARAM_STR);
    $stmt->bindValue(':item_image', $item_image, PDO::PARAM_STR);
    $stmt->bindValue(':id', $item_id, PDO::PARAM_INT);
    $status = $stmt->execute();
} catch (Exception $e) {
    var_dump($e);
    exit();
}
if ($status == false) {
    $error = $stmt->errorInfo();
    exit('sqlError:' . $error[2]);
} else {
    $sql = 'SELECT * FROM item_table WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $item_id, PDO::PARAM_INT);
    $status = $stmt->execute();
    $item = $stmt->fetch(PDO::FETCH_ASSOC);
}
try {
    $sql = 'SELECT * FROM users_table WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $status = $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    var_dump($e);
    exit();
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
    <form action="post_old_item.php" method="POST" class="back">
        <input type="image" name="back" alt="back" src="img/iconmonstr-arrow-left-circle-thin.png" width="50px" height="50px">
    </form>
    <div>
        <h1>選択中の項目</h1>
    </div>

    <div>
        <h2>画像選択</h2>
        <div style="color: red;">画像は５枚必要です！！！</div>
    </div>
    <form action="post_old_check.php" method="POST" enctype="multipart/form-data">
        <label>商品画像1</label><br>
        <input type="file" name="item_image2" accept="image/*" capture="camera"><br>
        <label>商品画像2</label><br>
        <input type="file" name="item_image3" accept="image/*" capture="camera"><br>
        <label>商品画像3</label><br>
        <input type="file" name="item_image4" accept="image/*" capture="camera"><br>
        <label>商品画像4</label><br>
        <input type="file" name="item_image5" accept="image/*" capture="camera"><br>
        <label>商品画像5</label><br>
        <input type="file" name="item_image6" accept="image/*" capture="camera"><br>
        <div>
            <h2>サイズ選択</h2>
        </div>
        <select name="size">
            <option value="">-</option>
            <option value="23.0">23.0</option>
            <option value="23.5">23.5</option>
            <option value="24.0">24.0</option>
            <option value="24.5">24.5</option>
            <option value="25.0">25.0</option>
            <option value="25.5">25.5</option>
            <option value="26.0">26.0</option>
            <option value="26.5">26.5</option>
            <option value="27.0">27.0</option>
            <option value="27.5">27.5</option>
            <option value="28.0">28.0</option>
            <option value="28.5">28.5</option>
            <option value="29.0">29.0</option>
            <option value="29.5">29.5</option>
            <option value="30.0">30.0</option>
        </select>
        <input type="hidden" name="item_color" value="<?= $item_color ?>">
        <input type="hidden" name="item_id" value="<?= $item_id ?>">
        <input type="hidden" name="item_status" value="<?= $item_status ?>">
        <input type="hidden" name="brand_name" value="<?= $brand_name ?>">
        <input type="hidden" name="kinds" value="<?= $kinds ?>">
        <input type="hidden" name="item_name" value="<?= $item_name ?>">
        <input type="hidden" name="id" value="<?= $_SESSION["id"] ?>"><br>
        <button type="submit">確認画面へ</button>
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