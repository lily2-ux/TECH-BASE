<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title<mission_1-20<title>
</head>
<body>
    <form action=""method="post">
        <input type="text" name="str">
        <input type="submit" name="submit">
    </form>
    <?php
        $str=$_POST["str"];
        echo $str;
    ?>
</body>
    </title>
</head>
</html>

<!--HTMLの入力フォームを使って、データの送受信を行っている。
入力フォームの送信ボタンが押され、ページが更新されると、$_POST 変数に入力フォームの中のデータが渡される。-->