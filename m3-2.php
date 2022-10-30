<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>m3-2</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="name" placeholder="名前"><br>
        <input type="text" name="str" placeholder="コメント"><br>
        <input type="submit" name="submit">
    </form>
<?php
    $name=$_POST["name"];
    $str=$_POST["str"];
    
    $filename="m3-2.txt";
    
    $date=date("Y年m月d日H時i分s秒");
    
    if(file_exists($filename)){
        $num=count(file($filename,FILE_IGNORE_NEW_LINES))+1;
    }else{
        $num=1;}
    
    $comment=$num."<>".$name."<>".$str."<>".$date;
    
    $fp=fopen($filename,"a");
    if(!empty($str) && !empty($name)){
    fwrite($fp,$comment.PHP_EOL);}
    fclose($fp);
    
    // ファイルを1行ずつ読み込み、配列変数に代入する
    $lines=file($filename,FILE_IGNORE_NEW_LINES);
    // ファイルを読み込んだ配列を、配列の数（＝行数）だけループさせる
    foreach($lines as $line){
    // ループ処理内：区切り文字「<>」で分割して、それぞれの値を取得
    $txt=explode("<>",$line);
    for($i=0; $i<count($txt); $i++){
        echo $txt[$i]."";
    }
    echo"<br>";
    }
?>
</body>
</html>