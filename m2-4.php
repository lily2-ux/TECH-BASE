<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>m2-4</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="str"value="名前を入力">
        <!--フォーム入力欄に「コメント」と表示されるようにvalue値で設定する-->
        <input type="submit" name="submit">
    </form>

<?php
    $str = $_POST['str'] ;
    if(!empty($_POST["str"])){
    $filename="m2-4.txt";
    $fp = fopen($filename,"a");
    fwrite($fp,$str.PHP_EOL);
    fclose($fp);
    $strs = file($filename);
    }
    
    foreach((array)$strs as $str){
        echo "おめでとう！by $str<br>";
    }
?>

</body>
</html>