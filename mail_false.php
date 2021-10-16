<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>問い合わせ失敗</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <div>
        <h2>お問い合わせフォーム</h2>
    </div>
    <div class="message">
        <div>お問い合わせできませんでした。</div>
        <div>再度お問い合わせ頂くか、</div>
        <div>カスタマーセンターへ</div>
        <div>お電話にてお問い合わせください。</div>
    </div>
    <div class="tel">お問合せ先<br>093 - 474 - ****</div>
    <div class="submit">
        <input type="button" value="同じ内容でお問い合わせ" onclick="history.back(-1)">
        <a href="my_page.php">マイページへ</a>
    </div>
    <div class="sub-top">
        <a href="index.php"><img alt="market" src="img/iconmonstr-shopping-cart-thin.png" width="50px" height="50px"> <br> マーケット</a> <br>

        <a href="media.php"><img alt="media" src="img/safari_logo_icon_144917.png" width="50px" height="50px"> <br> メディア</a> <br>

        <a href="post_status.php"><img alt="post_status" src="img/iconmonstr-plus-circle-thin.png" width="50px" height="50px"> <br> 出品</a> <br>

        <a href="like.php"><img alt="like" src="img/iconmonstr-heart-thin.png" width="50px" height="50px"> <br> お気に入り</a> <br>

        <a href="my_page.php"><img alt="my_page" src="img/iconmonstr-user-male-thin.png" width="50px" height="50px"> <br>マイページ</a> <br>
    </div>
</body>

</html>