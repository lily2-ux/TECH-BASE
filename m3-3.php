<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>m3-3</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="name" placeholder="名前"><br>
        <input type="text" name="str" placeholder="コメント">
        <input type="submit" name="submit"value="送信"><br>
        
        <input type="number" name="delete" placeholder="削除対象番号">
        <input type="submit" name="submit" value="削除">
    </form>
    
  <?php
    $filename="m3-3.txt";
    
    if(!empty($_POST["str"]) && !empty($_POST["name"])){
    $name=$_POST["name"];
    $str=$_POST["str"];
    // 投稿日付の取得
    $date=date("Y年m月d日H時i分s秒");
    
    if(file_exists($filename)){
        $line=file($filename,FILE_SKIP_EMPTY_LINES);
        $n=count($line)-1;
        $postnum=mb_substr($line[$n],0,1)+1;
    }else{
        $postnum=1;
    }
    
    $comment=$postnum."<>".$name."<>".$str."<>".$date;
    
        $fp=fopen($filename,"a");
        fwrite($fp,$comment.PHP_EOL);
        fclose($fp);
    }
    
    // 削除機能
    if(!empty($_POST["delete"])){
        $delete=$_POST["delete"];
    // ファイルの中身を1行1要素として配列変数に代入する
        $lines=file($filename,FILE_IGNORE_NEW_LINES);
        $fp=fopen($filename,"w");
        
        for($i=0; $i<count($lines); $i++)
        {
        $line=explode("<>",$lines[$i]);
    
        $postnum=$line[0];
        // 投稿番号と削除対象番号が一致してないときは、書き込む
        if($postnum!=$delete)
         {
           fwrite($fp,$lines[$i].PHP_EOL);
         }
        }
        fclose($fp);
    }
    
    // 表示機能
    $lines=file($filename,FILE_IGNORE_NEW_LINES);
    foreach($lines as $comment)
    {
        $txt=explode("<>",$comment);
        for($i=0; $i<count($txt);$i++)
        {
         echo $txt[$i]."";
        }
        echo"<br>";
    }
  ?>
   
</body>
</html>