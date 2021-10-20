<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();

// var_dump($_FILES);
// exit();

$brand_name = $_POST['brand_name'];
$kinds = $_POST['kinds'];
$item_id = $_POST['item_id'];
$item_name = $_POST['item_name'];
$size = $_POST['size'];
$item_status = $_POST['item_status'];
$item_color = $_POST['item_color'];
$filename_to_save2 = $_FILES['item_image2']['name'];
$filename_to_save3 = $_FILES['item_image3']['name'];
$filename_to_save4 = $_FILES['item_image4']['name'];
$filename_to_save5 = $_FILES['item_image5']['name'];
$filename_to_save6 = $_FILES['item_image6']['name'];


// var_dump($brand_name);
// var_dump($kinds);
// var_dump($item_id);
// var_dump($item_name);
// var_dump($size);
// var_dump($item_status);
// var_dump($item_color);
var_dump($filename_to_save2);
var_dump($filename_to_save3);
var_dump($filename_to_save4);
var_dump($filename_to_save5);
var_dump($filename_to_save6);

exit();
if (
    !isset($_POST['size']) || $_POST['size'] == NULL ||
    !isset($_POST['item_color']) || $_POST['item_color'] == NULL ||
    !isset($_POST['item_name']) || $_POST['item_name'] == NULL
) {
    exit('選択されていません');
}

if (isset($_FILES['item_image2']) && $_FILES['item_image2']['error'] == 0) {
    $uploaded_file_name = $_FILES['item_image2']['name']; //ファイル名を取得
    $temp_path = $_FILES['item_image2']['tmp_name']; //tmpフォルダの場所
    $directory_path = 'upload/'; //アップロード先フォルダ(自分で決める)
    $extension1 = pathinfo($uploaded_file_name, PATHINFO_EXTENSION);
    $unique_name = date('YmdHis') . md5(session_id()) . "." . $extension1;
    $filename_to_save2 = $directory_path . $unique_name;
    if (is_uploaded_file($temp_path)) {

        if (move_uploaded_file($temp_path, $filename_to_save2)) {
            chmod($filename_to_save2, 0644);
        } else {
            exit('ERROR:アップロードできませんでした');
        }
    } else {
        exit('ERROR:画像がありません');
    }
} else {
    exit('error:画像が送信されていません');
}
if (isset($_FILES['item_image3']) && $_FILES['item_image3']['error'] == 0) {
    $uploaded_file_name2 = $_FILES['item_image3']['name']; //ファイル名を取得
    $temp_path2 = $_FILES['item_image3']['tmp_name']; //tmpフォルダの場所
    $directory_path2 = 'upload/'; //アップロード先ォルダ(自分で決める)
    $extension2 = pathinfo($uploaded_file_name2, PATHINFO_EXTENSION);
    $unique_name = date('YmdHis') . md5(session_id()) . "." . $extension;
    $filename_to_save3 = $directory_path2 . $unique_name;
    if (is_uploaded_file($temp_path2)) {

        if (move_uploaded_file($temp_path2, $filename_to_save3)) {
            chmod($filename_to_save3, 0644);
        } else {
            exit('ERROR:アップロードできませんでした');
        }
    } else {
        exit('ERROR:画像がありません');
    }
} else {
    exit('error:画像が送信されていません');
}
if (isset($_FILES['item_image4']) && $_FILES['item_image4']['error'] == 0) {
    $uploaded_file_name3 = $_FILES['item_image4']['name']; //ファイル名を取得
    $temp_path = $_FILES['item_image4']['tmp_name']; //tmpフォルダの場所
    $directory_path = 'upload/'; //アップロード先ォルダ(自分で決める)
    $extension3 = pathinfo($uploaded_file_name3, PATHINFO_EXTENSION);
    $unique_name = date('YmdHis') . md5(session_id()) . "." . $extension;
    $filename_to_save4 = $directory_path . $unique_name;
    if (is_uploaded_file($temp_path)) {

        if (move_uploaded_file($temp_path, $filename_to_save4)) {
            chmod($filename_to_save4, 0644);
        } else {
            exit('ERROR:アップロードできませんでした');
        }
    } else {
        exit('ERROR:画像がありません');
    }
} else {
    exit('error:画像が送信されていません');
}
if (isset($_FILES['item_image5']) && $_FILES['item_image5']['error'] == 0) {
    $uploaded_file_name4 = $_FILES['item_image5']['name']; //ファイル名を取得
    $temp_path = $_FILES['item_image5']['tmp_name']; //tmpフォルダの場所
    $directory_path = 'upload/'; //アップロード先ォルダ(自分で決める)
    $extension4 = pathinfo($uploaded_file_name4, PATHINFO_EXTENSION);
    $unique_name = date('YmdHis') . md5(session_id()) . "." . $extension;
    $filename_to_save5 = $directory_path . $unique_name;
    if (is_uploaded_file($temp_path)) {

        if (move_uploaded_file($temp_path, $filename_to_save5)) {
            chmod($filename_to_save5, 0644);
        } else {
            exit('ERROR:アップロードできませんでした');
        }
    } else {
        exit('ERROR:画像がありません');
    }
} else {
    exit('error:画像が送信されていません');
}

if (isset($_FILES['item_image6']) && $_FILES['item_image6']['error'] == 0) {
    $uploaded_file_name5 = $_FILES['item_image6']['name']; //ファイル名を取得
    $temp_path = $_FILES['item_image6']['tmp_name']; //tmpフォルダの場所
    $directory_path = 'upload/'; //アップロード先ォルダ(自分で決める)
    $extension5 = pathinfo($uploaded_file_name5, PATHINFO_EXTENSION);
    $unique_name = date('YmdHis') . md5(session_id()) . "." . $extension;
    $filename_to_save6 = $directory_path . $unique_name;
    if (is_uploaded_file($temp_path)) {

        if (move_uploaded_file($temp_path, $filename_to_save6)) {
            chmod($filename_to_save6, 0644);
        } else {
            exit('ERROR:アップロードできませんでした');
        }
    } else {
        exit('ERROR:画像がありません');
    }
} else {
    exit('error:画像が送信されていません');
}

try {
    $sql = 'UPDATE item_table SET  item_name = :item_name, item_image2=:item_image2, item_image3=:item_image3,item_image4=:item_image4,item_image5=:item_image5,item_image6=:item_image6,item_color=:item_color, size=:size,owner_id=:owner_id WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':size', $size, PDO::PARAM_STR);
    $stmt->bindValue(':owner_id', $owner_id, PDO::PARAM_INT);
    $stmt->bindValue(':item_name', $item_name, PDO::PARAM_STR);
    $stmt->bindValue(':item_color', $item_color, PDO::PARAM_STR);
    $stmt->bindValue(':item_image2', $filename_to_save2, PDO::PARAM_STR);
    $stmt->bindValue(':item_image3', $filename_to_save3, PDO::PARAM_STR);
    $stmt->bindValue(':item_image4', $filename_to_save4, PDO::PARAM_STR);
    $stmt->bindValue(':item_image5', $filename_to_save5, PDO::PARAM_STR);
    $stmt->bindValue(':item_image6', $filename_to_save6, PDO::PARAM_STR);
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


if (
    !isset($_POST['size']) || $_POST['size'] == NULL ||
    !isset($_POST['item_color']) || $_POST['item_color'] == NULL ||
    !isset($_POST['item_name']) || $_POST['item_name'] == NULL
) {
    exit('選択されていません');
}
// var_dump($filename_to_save2);
// var_dump($filename_to_save3);
// exit();
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

    </form>
    <div>
        <h1>出品確認</h1>
    </div>
    <form action="post_display.php" method="POST" class="check">

        <fieldset>
            商品状態：<?= $item_status ?>
            ブランド名： <?= $brand_name ?><br>
            種類：<?= $kinds ?><br>
            <img src=<?= $filename_to_save2 ?> alt="" width="360px">
            <img src=<?= $filename_to_save3 ?> alt="" width="360px"> <br>
            <img src=<?= $filename_to_save4 ?> alt="" width="360px">
            <img src=<?= $filename_to_save5 ?> alt="" width="360px"> <br>
            <img src=<?= $filename_to_save6 ?> dalt="" width="360px"> <br>
            商品名：<?= $item_name ?><br>
            サイズ：<?= $size ?><br>
        </fieldset>
        <input type="submit" value="出品" name="send">
    </form>
    <br>
    <br>
    <br>
    <br>

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