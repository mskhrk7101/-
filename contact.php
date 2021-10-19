<?php
session_start();
include('functions.php');
$pdo = connect_to_db();

$user_name = $_SESSION['user_name'];
$user_id = $_SESSION['id'];

$sql = 'SELECT * FROM users_table WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
$status = $stmt->execute();
if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>お問い合わせ</title>
    <link rel="stylesheet" href="style.css">
    <style>
        h3 {
            margin: 35px 0 0 30px;
            /* padding: 10px 0 0 0;
            /* background-color: black; */
            color: black;
            /* width: 130px;
            height: 40px; */
            /* text-align: center; */
        }

        .sign_up {
            margin: 35px 0 0 80px;
        }

        .size {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .aa {
            width: 100%;
            /* background-color: #ff9a4a; */
            text-align: center;
            border: solid 1px black;
        }
    </style>
</head>

<body>
    <div class="head-menu">
        <!-- <div class="search">
            <input type="text" name="search" placeholder="検索" value="" size="20">
        </div> -->
        <a href="index.php">
            <h3>ホリマニア</h3>
        </a>
        <div class="log_in">
            <a href="log_in.php">ログイン/新規登録</a>
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
    <br><br><br><br>
    <div>
        <h1>お問い合わせフォーム</h1>
    </div>
    <div>
        <h2>お気軽にお問い合わせください</h2>
    </div>
    <div>
        <form action="contact_check.php" method="POST">
            <div class="size">
                <table>

                    <div style='width: 300px;'>お名前 </div>

                    <div style='width: 300px;'><input type="text" name="user_name" value="<?= $result['user_name'] ?>" size="30"></div>

                    <div style='width: 300px;'>メールアドレス </div>
                    <div><input type="text" name="email" value="<?= $result['email'] ?>" size="30"></div>

                    <div class="text">カテゴリ</div>
                    <div style='width: 300px;'>
                        <select name="content_title">
                            <option value="">項目を選択してください</option>
                            <option value="アカウントについて">アカウントについて</option>
                            <option value="発送方法について">発送方法について</option>
                            <option value="退会について">退会について</option>
                            <option value="その他">その他</option>
                        </select>
                    </div>


                    <div style='width: 300px;'>お問合せ内容</div>
                    <div><textarea name="content" rows="5" placeholder="内容を入力" type="text" size="30"></textarea></div>

                </table>
                <div style='width: 300px;' class='aa'>
                    <button type="submit">確認画面へ</button>
                </div>
            </div>
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