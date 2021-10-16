<?php
session_start();
include('functions.php');
$pdo = connect_to_db();

$user_name = $_POST["user_name"];
$email = $_POST["email"];
$address = $_POST["address"];
$birthday = $_POST["birthday"];
$sex = $_POST["sex"];
$password = $_POST["password"];
// var_dump($_POST);
// exit();
// 
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録</title>
</head>

<body>
    <div>
        <h2>会員登録フォーム</h2>
    </div>
    <div>
        <form action="sign_up_act.php" method="POST">
            <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
            <input type="hidden" name="email" value="<?php echo $email; ?>">
            <input type="hidden" name="address" value="<?php echo $address; ?>">
            <input type="hidden" name="birthday" value="<?php echo $birthday; ?>">
            <input type="hidden" name="sex" value="<?php echo $sex; ?>">
            <input type="hidden" name="password" value="<?php echo $password; ?>">
            <h1 class="contact-title">会員登録 内容確認</h1>
            <p>お客様情報はこちらで宜しいでしょうか？<br>よろしければ「送信する」ボタンを押して下さい。</p>
            <div class="check">
                <div class="user_name">
                    <label>お名前</label>
                    <p><?php echo $user_name; ?></p>
                </div>
                <div class="email">
                    <label>メールアドレス</label>
                    <p><?php echo $email; ?></p>
                </div>
                <div class="address">
                    <label>住所</label>
                    <p><?php echo $address; ?></p>
                </div>
                <div class="birthday">
                    <label>生年月日</label>
                    <p><?php echo $birthday; ?></p>
                </div>
                <div class="sex">
                    <label>性別</label>
                    <p><?php echo $sex; ?></p>
                </div>
                <div class="password">
                    <label>パスワード</label>
                    <p><?php echo $password; ?></p>
                </div>
            </div>
            <div class="btn2">
                <input type="button" value="内容を修正する" onclick="history.back(-1)">
                <button type="submit" name="submit">送信する</button>
            </div>
        </form>
    </div>
</body>

</html>