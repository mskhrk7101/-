<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>出品ページ</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="head-menu">
        <div class="search">
            <input type="text" name="search" placeholder="検索" value="" size="20">
        </div>
        <div class="info">
            <a href="info.php">🔔</a>
        </div>
        <div class="log_out">
            <a href="log_out.php">ログアウト</a>
        </div>
    </div>
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
    <form action="index.php" method="POST" class="market">
        <input type="image" name="market" alt="market" src="img/iconmonstr-shopping-cart-thin.png" width="50px" height="50px">
    </form>
    <form action="media.php" method="POST" class="media">
        <input type="image" name="media" alt="media" src="img/safari_logo_icon_144917.png" width="50px" height="50px">
    </form>
    <form action="post_status.php" method="POST" class="post_status">
        <input type="image" name="post_status" alt="post_status" src="img/iconmonstr-plus-circle-thin.png" width="50px" height="50px">
    </form>
    <form action="like.php" method="POST" class="like">
        <input type="image" name="like" alt="like" src="img/iconmonstr-heart-thin.png" width="50px" height="50px">
    </form>
    <form action="my_page.php" method="POST" class="my_page">
        <input type="image" name="my_page" alt="my_page" src="img/iconmonstr-user-male-thin.png" width="50px" height="50px">
    </form>
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