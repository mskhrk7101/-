<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();
// var_dump($_POST);
// exit();

$brand_name = $_POST['brand_name'];
$kinds = $_POST['kinds'];
$item_id = $_POST['item_id'];


if (
    !isset($_POST['kinds']) || $_POST['kinds'] == NULL
) {
    exit('種類が選択されていません');
}
$sql = 'UPDATE item_table SET  kinds = :kinds WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':kinds', $kinds, PDO::PARAM_STR);
$stmt->bindValue(':id', $item_id, PDO::PARAM_INT);
$status = $stmt->execute();

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
    $sql = 'SELECT * FROM item_master_table WHERE kinds=:kinds';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':kinds', $kinds, PDO::PARAM_STR);
    $status = $stmt->execute();
} catch (Exception $e) {
    var_dump($e);
    exit();
}
if ($status == false) {
    $error = $stmt->errorInfo();
    exit('sqlError:' . $error[2]);
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $item_output .= '<form action="post_old_size.php" method="POST">';
        $item_output .= "<img src='{$result['item_image']}'width='375px'>";
        $item_output .= "<div>商品名:{$result["item_name"]}</div>";
        $item_output .= "<input type='hidden' name='item_color' value='{$result["item_color"]}'>";
        $item_output .= "<input type='hidden' name='item_image' value='{$result["item_image"]}'>";
        $item_output .= "<input type='hidden' name='item_name' value='{$result["item_name"]}'>";
        $item_output .= "<input type='hidden' name='brand_name' value='{$result["brand_name"]}'>";
        $item_output .= "<input type='hidden' name='kinds' value='{$result["kinds"]}'>";
        $item_output .= "<input type='hidden' name='item_id' value='{$item["id"]}'>";
        $item_output .= "<input type='hidden' name='item_status' value='{$item["item_status"]}'>";
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
    <title>新品</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="post_old_kinds.php" method="POST" class="back">
        <input type="image" name="back" alt="back" src="img/iconmonstr-arrow-left-circle-thin.png" width="50px" height="50px">
    </form>
    <fieldset>
        <legend>選択中の項目</legend>
        <?= $item['item_status'] ?><br>
        ブランド名:<?= $item['brand_name'] ?>
        種類:<?= $item['kinds'] ?>
    </fieldset>
    <label for="row">並び替え</label>

    <select name="row" id="row">
        <option value="new">新しい順</option>
        <option value="old">古い順</option>
        <option value="brand">ブランド順</option>
    </select>
    <div></div>
    <h2>商品名</h2>
    </div>
    <?= $item_output ?>

    <form action="contact.php" method="POST" class="contact">
        <label>商品がない場合はこちら</label> <br>
        <input type="image" name="contact" alt="contact" src="img/iconmonstr-speech-bubble-thin.png" width="50px" height="50px">
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