<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
</head>

<body>
    <form action="index.php" method="POST" class="back">
        <input type="image" name="back" alt="back" src="img/iconmonstr-arrow-left-circle-thin.png" width="50px" height="50px">
    </form>
    <div>
        <h1>ログインフォーム</h2>
    </div>
    <form action="log_in_act.php" method="POST" class="form">
        <h2 class="ログイン見出し">ログイン画面</h2>
        <div class="ID">
            ユーザーネーム<br>
            <input type="text" name="user_name">
        </div>
        <div class="パスワード">
            パスワード<br>
            <input type="text" name="password">
        </div>
        <div class="log_in">
            <button>Login</button>
        </div>
        <div class="新規登録">
            <a href="sign_up.php">会員登録お済みではない方はこちら</a>
        </div>
    </form>

</html>
</body>

</html>