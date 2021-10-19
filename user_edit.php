<?php
session_start();
include('functions.php');
check_session_id();
$pdo = connect_to_db();
$user_id = $_SESSION['user_id'];

$sql = 'SELECT * FROM users_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>アカウント編集</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- ハンバーガーメニュー -->
    <div class="menu-btn">
        <i class="fa fa-bars" aria-hidden="true"></i>
    </div>
    <div class="menu">
        <a href="user_edit.php" class="menu__item">アカウント編集</a>
        <a href="setting.php" class="menu__item">設定</a>
        <a href="company.php" class="menu__item">ホリマニアとは？</a>
        <a href="help.php" class="menu__item">ヘルプ</a>
        <a href="contact.php" class="menu__item">お問い合わせ</a>
    </div>
    <div>
        <h1>アカウント編集</h1>
    </div>
    <div>
        <div>お客様情報をご入力の上、「確認画面へ」 <br> ボタンをクリックしてください。</div>
        <form action="user_update.php" method="POST" name="form" onsubmit="return validate()" enctype="multipart/form-data">
            <fieldset>
                <legend>会員情報編集</legend>
                <div>
                    <div>
                        <label>名前</label><br>
                        <input type="text" name="user_name" value="<?= $record["user_name"] ?>">
                    </div>
                    <div>
                        <label>メールアドレス</label><br>
                        <input type="text" name="email" value="<?= $record["email"] ?>">
                    </div>
                    <div>
                        <label>パスワード</label><br>
                        <input type="text" name="password" value="<?= $record["password"] ?>">
                    </div>
                    <div>
                        <label>住所</label><br>
                        <input type="text" name="address" value="<?= $record["address"] ?>">
                    </div>

                </div>
            </fieldset>
            <div>
                <button type="submit">変更する</button>
            </div>

        </form>
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