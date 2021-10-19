<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();
$user_id = $_SESSION['user_id'];
// var_dump($_POST);
// exit();
if (
    !isset($_POST['item_status']) || $_POST['item_status'] == ''
) {
    exit('Param Error');
}

// var_dump($item_status);
// exit();
$item_status = $_POST["item_status"];
$brand_name = $_POST["brand_name"];
$kinds = $_POST["kinds"];
$item_color = $_POST["item_color"];
$item_image = $_POST["item_image"];
$item_image2 = $_POST["item_image2"];
$item_image3 = $_POST["item_image3"];
$item_image4 = $_POST["item_image4"];
$item_image5 = $_POST["item_image5"];
$item_image6 = $_POST["item_image6"];
$item_name = $_POST["item_name"];
$good = $_POST["good"];
$size = $_POST["size"];
$owner_id = $_POST["owner_id"];
$is_status = $_POST["is_status"];
$treaditem_id = $_POST["treaditem_id"];
$send_status = $_POST["send_status"];
// var_dump($_POST);
// exit();
// var_dump($item_status);
// exit();
try {
    $sql = 'INSERT INTO item_table (id, item_status, brand_name, kinds, item_color, item_image, item_image2, item_image3, item_image4, item_image5,item_image6, item_name, good, size, owner_id, is_status, treaditem_id, send_status, created_at, updated_at)
VALUES  (NULL, :item_status, :brand_name, :kinds, :item_color, :item_image, :item_image2, :item_image3, :item_image4, :item_image5,:item_image6, :item_name, :good, :size, :owner_id, :is_status, :treaditem_id, :send_status, sysdate(), sysdate())';
    // var_dump('ok');
    // exit();
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':item_status', $item_status, PDO::PARAM_STR);
    $stmt->bindValue(':brand_name', $brand_name, PDO::PARAM_STR);
    $stmt->bindValue(':kinds', $kinds, PDO::PARAM_STR);
    $stmt->bindValue(':item_color', $item_color, PDO::PARAM_STR);
    $stmt->bindValue(':item_image', $item_image, PDO::PARAM_STR);
    $stmt->bindValue(':item_image2', $item_image2, PDO::PARAM_STR);
    $stmt->bindValue(':item_image3', $item_image3, PDO::PARAM_STR);
    $stmt->bindValue(':item_image4', $item_image4, PDO::PARAM_STR);
    $stmt->bindValue(':item_image5', $item_image5, PDO::PARAM_STR);
    $stmt->bindValue(':item_image6', $item_image6, PDO::PARAM_STR);
    $stmt->bindValue(':item_name', $item_name, PDO::PARAM_STR);
    $stmt->bindValue(':good', $good, PDO::PARAM_STR);
    $stmt->bindValue(':size', $size, PDO::PARAM_STR);
    $stmt->bindValue(':owner_id', $owner_id, PDO::PARAM_STR);
    $stmt->bindValue(':is_status', $is_status, PDO::PARAM_STR);
    $stmt->bindValue(':treaditem_id', $treaditem_id, PDO::PARAM_STR);
    $stmt->bindValue(':send_status', $send_status, PDO::PARAM_STR);
    $status = $stmt->execute();
} catch (Exception $e) {
    var_dump($e);
    exit();
}
// var_dump($_POST);
// exit();
if ($status == false) {
    $error = $stmt->errorInfo();
    exit('sqlError:' . $error[2]);
} else {

    $sql = 'SELECT * FROM item_table ORDER BY created_at DESC';
    $stmt = $pdo->prepare($sql);
    $status = $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <input type="image" name="back" alt="back" src="img/iconmonstr-arrow-left-circle-thin.png" width="50px" height="50px" style="margin-top: 20px;">
    </form>
    <div>
        <h1>ブランド選択</h1>
    </div>

    <br>
    <div class=" brand">
        <form action="post_new_kinds.php" method="POST">
            <input type="hidden" name="item_id" value="<?= $result[0]['id'] ?>">
            <input type="hidden" name="item_status" value="<?= $item_status ?>">
            <button type="submit" value="NIKE" name="brand_name"><img src="img/nike.png" alt="" width="70px" height="50px"><br> nike</button>
        </form>

        <form action="post_new_kinds.php" method="POST">
            <input type="hidden" name="item_id" value="<?= $result[0]['id'] ?>">
            <input type="hidden" name="item_status" value="<?= $item_status ?>">
            <button type="submit" value="JORDAN" name="brand_name"><img src="img/jordan.png" alt="" width="70px" height="50px"><br> jordan</button>
        </form>

        <form action="post_new_kinds.php" method="POST">
            <input type="hidden" name="item_id" value="<?= $result[0]['id'] ?>">
            <input type="hidden" name="item_status" value="<?= $item_status ?>">
            <button type="submit" value="adidas" name="brand_name"><img src="img/adidas.png" alt="" width="70px" height="50px"><br> adidas</button>
        </form>
    </div>

    <br>
    <br>

    <div class="brand">
        <form action="post_new_kinds.php" method="POST">
            <input type="hidden" name="item_id" value="<?= $result[0]['id'] ?>">
            <input type="hidden" name="item_status" value="<?= $item_status ?>">
            <button type="submit" value="Reebok" name="brand_name"><img src="img/reebok.gif" alt="" width="70px" height="50px"><br> reebok</button>
        </form>
        <form action="post_new_kinds.php" method="POST">
            <input type="hidden" name="item_id" value="<?= $result[0]['id'] ?>">
            <input type="hidden" name="item_status" value="<?= $item_status ?>">
            <button type="submit" value="New balance" name="brand_name"><img src="img/new balance.gif" alt="" width="70px" height="50px"><br> New balance</button>
        </form>
        <form action="post_new_kinds.php" method="POST">
            <input type="hidden" name="item_id" value="<?= $result[0]['id'] ?>">
            <input type="hidden" name="item_status" value="<?= $item_status ?>">
            <button type="submit" value="others" name="brand_name"><img src="img/iconmonstr-share-2.png" alt="" width="70px" height="50px"><br> others</button>
        </form>
    </div>

    <br><br><br><br><br><br>


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