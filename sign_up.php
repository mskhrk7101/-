<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録</title>
</head>

<body>
    <div>
        <h1>会員登録フォーム</h2>

    </div>
    <div>

        <form action="sign_up_check.php" method="POST" onsubmit="return validate()">
            <h2 class="contact-title">会員登録 内容入力</h1>
                <p>お客様情報をご入力の上、「確認画面へ」ボタンをクリックしてください。</p>
                <div class="form">
                    <div class="user_name">
                        <label>ユーザーネーム</label><br>
                        <input type="text" name="user_name" placeholder="例）山田太郎" value="" size="30">
                    </div>
                    <div class="email">
                        <label>Email</label><br>
                        <input type="email" name="email" placeholder="例）example@example.com" value="" size="30">
                    </div>
                    <div class="address">
                        <label>住所</label><br>
                        <input type="text" name="address" placeholder="例）○県○市○区○○ ○丁目○-○-○○○" value="" size="30">
                    </div>
                    <div class="birthday">
                        <label>生年月日</label><br>
                        <input type="date" name="birthday" value="" size="30">
                    </div>
                    <div class="sex">
                        <label>性別</label><br>
                        <input type="text" name="sex" placeholder="例）男" value="" size="30">
                    </div>
                    <div class="password">
                        <label>パスワード</label><br>
                        <input type="text" name="password" placeholder="例）123456789" value="" size="30">
                    </div>
                </div>
                <div class="submit">
                    <button type="submit">確認画面へ</button>
                </div>
                <a href="log_in.php" class="log">ログインページはこちら</a>
        </form>
    </div>
</body>

</html>