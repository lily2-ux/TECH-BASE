<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>m2-1</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="str"value="コメント">
        <!--フォーム入力欄に「コメント」と表示されるようにvalue値で設定する-->
        <input type="submit" name="submit">
    </form>
    
    <?php
        $str=$_POST["str"];
        
        if(isset($str)){
        echo $str . "を受け付けました<br>";
        }
    ?>
</body>
</html>