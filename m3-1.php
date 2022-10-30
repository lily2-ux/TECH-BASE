<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>m3-1</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="str"value="名前"><br>
        <input type="text" name="str"value="コメント"><br>
        <!--フォーム入力欄に「コメント」と表示されるようにvalue値で設定する-->
        <input type="submit" name="submit">
    </form>
<?php
    
    // 値の受け取りと変数への代入
    $name=$_POST["name"];
    $str=$_POST["str"];
    
    // 日付の取得
    $date=date("Y年m月d日H時i分s秒");
    
    // 投稿番号の取得
    if(file_exists($filename)){
        $num=count(file($filename))+1;
    }else{
        $num=1;
    }
    
    // 投稿の作成
    $comment=$num."<>".$name."<>".$str."<>".$date;
    
    // ファイルの指定
    $filename="m3-1.txt";
    
    // ファイルを開く
    $fp = fopen($filename,"a");
    
    // ファイルに記入
    fwrite($fp,$comment.PHP_EOL);
    
    // ファイルを閉じる
    fclose($fp);
    
?>

</body>
</html>