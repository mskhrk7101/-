<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品登録</title>
</head>

<body>
    <div>
        <h1>商品登録フォーム</h2>

    </div>
    <div>
        <form action="item_resister_act.php" method="POST" enctype="multipart/form-data">
            <h2 class="contact-title">商品登録 内容入力</h1>
                <div class="brand_name">
                    <label>ブランド名</label><br>
                    <input type="text" name="brand_name" value="" size="30">
                </div>
                <div class="kinds">
                    <label>種類</label><br>
                    <input type="text" name="kinds" value="" size="30">
                </div>
                <div class="item_color">
                    <label>色</label><br>
                    <input type="text" name="item_color" value="" size="30">
                </div>
                <div class="item_image">
                    <label>商品画像</label><br>
                    <input type="file" name="item_image" accept="image/*" capture="camera">
                </div>

                <div class="item_name">
                    <label>商品名</label><br>
                    <input type="text" name="item_name" value="" size="30">
                </div>
                <div class="release_date">
                    <label>発売日</label><br>
                    <input type="date" name="release_date" value="" size="30">
                </div>

                <div class="submit">
                    <button type="submit">送信</button>
                </div>

                <a href="item_read.php">登録アイテム一覧</a>
                <a href="my_page.php">マイページへ</a>

        </form>
    </div>
</body>

</html>