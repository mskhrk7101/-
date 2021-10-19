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
        <h1>発売情報登録フォーム</h2>

    </div>
    <div>
        <form action="launch_resister_act.php" method="POST" enctype="multipart/form-data">
            <div>
                <label>写真</label><br>
                <input type="file" name="image" accept="image/*" capture="camera">
            </div>
            <div>
                <label>ブランド</label><br>
                <input type="text" name="brand_name">
            </div>
            <div>
                <label>種類</label><br>
                <input type="text" name="kinds">
            </div>
            <div>
                <input type="date" name="release_date" value="" size="30">
            </div>
            <div>
                <label>商品</label><br>
                <input type="text" name="shoes">
            </div>
            <div>
                <button type="submit">登録</button>
            </div>

        </form>
    </div>
    <a href="my_page.php">マイページへ</a>
</body>

</html>