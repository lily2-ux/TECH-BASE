<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>m2-2</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="str"value="コメント">
        <!--フォーム入力欄に「コメント」と表示されるようにvalue値で設定する-->
        <input type="submit" name="submit">
    </form>
    
    <?php
        $str=$_POST["str"];
        if(!empty($_POST["str"])){
            // comment欄が空でないとき
        
        $filename="m2-2.txt";
        $fp=fopen($filename,"a");
        fwrite($fp, $str.PHP_EOL);
        fclose($fp);
        echo $str . "を受け付けました";
        $strs = file($filename);
        }
        
        if($str=="完成！"){
            echo "おめでとう！";
        }else{
        echo $str;
        }
        
    ?>
</body>
</html>