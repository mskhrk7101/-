<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
</head>

<body>
    <form action="index.php" method="POST" class="back" style="margin-top: 20px;">
        <input type="image" name="back" alt="back" src="img/iconmonstr-arrow-left-circle-thin.png" width="50px" height="50px">
    </form>

    <form action="log_in_act.php" method="POST" class="form">
        <h2 class="ログイン見出し">ログイン画面</h2>
        <br>

        <div style="display:flex;justify-content:center;align-items: center;flex-direction: column;  padding:10px; margin:10px">
            <div class="ID">
                ユーザーネーム<br>
                <input type="text" name="user_name" size="30">
            </div>
            <br>
            <div class="パスワード">
                パスワード<br>
                <input type="text" name="password" size="30">
            </div>
            <br>
            <div class="log_in">
                <button>Login</button>
            </div>

        </div>
    </form>
    <div class="新規登録" style="text-align: center; margin-top:30px;">
        <a href="sign_up.php">会員登録お済みではない方はこちら</a>
    </div>

</html>
</body>

</html>