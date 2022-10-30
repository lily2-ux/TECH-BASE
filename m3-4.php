  <?php
    $name=$_POST["name"];
    $str=$_POST["str"];
    $delnum=$_POST["delnum"];
    $editnum=$_POST["editnum"];
    $hidden=$_POST["hidden"];

    $date=date("Y年m月d日H時i分s秒");
    $filename="m3-4.txt";
    
    // ファイルの存在がある場合は投稿番号+1
    if(file_exists($filename)){
        $line=file($filename,FILE_SKIP_EMPTY_LINES);
        $n=count($line)-1;
        $postnum=mb_substr($line[$n],0,1)+1;
    }else{
        $postnum=1;
    }
    // 書き込む文字列を組み合わせた変数
    $comment=$postnum."<>".$name."<>".$str."<>".$date;
    $commentA=$hidden."<>".$name."<>".$str."<>".$date;
    
    // フォームが空でない場合に以下を実行
    if(!empty($name && $str) && empty($hidden)){
    // 投稿日付の取得
        // ファイルを追記保存モードでオープンする
        $fp=fopen($filename,"a");
        // 入力ファイル書き込み
        fwrite($fp,$comment.PHP_EOL);
        fclose($fp);
      }
    
    
    //削除機能
    if(!empty($delnum)){
        
        // 読み込んだファイルの中身を配列に格納する
        $lines=file($filename,FILE_IGNORE_NEW_LINES);
        //ファイルを書き込みモードでオープンし、中身を空にする
        $fp2=fopen($filename,"w");
        
        for($i=0; $i<count($lines); $i++){
        //explode関数でそれぞれの値を取得
        $txt=explode("<>",$lines[$i]);
    
        $postnum=$txt[0];
        // 投稿番号と編集対象番号が一致してないときは、書き込む
        if($postnum!=$delnum)
         {
           // 入力データの書き込み
           fwrite($fp2,$lines[$i].PHP_EOL);
         }
        }
        fclose($fp2);
    }
    
    // 編集フォームの送信の有無で処理を分岐
    if(!empty($editnum)){
    // ファイルの中身を1行1要素として配列変数に代入する
        $lines=file($filename,FILE_IGNORE_NEW_LINES);
        for($i=0; $i<count($lines); $i++){
         $txt=explode("<>",$lines[$i]);
    
         $postnum=$txt[0];
        // 投稿番号と編集対象番号が一致してないときは、書き込む
         if($postnum==$editnum){
            $editname=$txt[1];
            $editstr=$txt[2];
         }
    
        }
    }
    
        
    // 新規投稿か編集か判断する
    if(!empty($hidden)){
    //編集実行機能
    
    //読み込んだファイルの中身を配列に格納
    $lines=file($filename,FILE_IGNORE_NEW_LINES);
    //ファイルを書き込みモードでオープンし、中身を空にする
    $fp3=fopen($filename,"w");
    for($i=0; $i<count($lines);$i++){
    //配列の数だけループ
        //explode関数でそれぞれの値を取得
        $txt=explode("<>",$lines[$i]);
        //投稿番号と編集対象番号が一致したら
        $postnum=$txt[0];
            //編集フォームから送信された値と差し替えて上書き
        if($postnum!=$hidden){
            fwrite($fp3,$lines[$i].PHP_EOL);
        }
        else{
            //一致しなかったところは書き込む
            fwrite($fp3,$commentA.PHP_EOL);
        }
        
    }
      fclose($fp3);
    }
    
    ?>
    
    <!DOCTYPE html>
    <html lang="ja">
      <head>
         <meta charset="UTF-8">
         <title>m3-4</title>
      </head>
      <body>
    
    <form action="" method="post">
        <input type="text" name="name" placeholder="名前" value=<?php if(!empty($editnum)){echo $editname;}?>><br>
        <input type="text" name="str" placeholder="コメント" value=<?php if(!empty($editnum)){echo $editstr;}?>>
        <input type="submit" name="submit" value="送信"><br>
        <br>
        <input type="text" name="delnum" placeholder="削除対象番号">
        <input type="submit" name="delete" value="削除"><br>
        <br>
        <input type="text" name="editnum" placeholder="編集対象番号">
        <input type="submit" name="edit" value="編集"><br>
        <input type="hidden" name="hidden" value=<?php echo $editnum?>>
    </form>
    </body>
</html>

 <?php
       // 表示機能
    $lines=file($filename,FILE_IGNORE_NEW_LINES);
    foreach((array)$lines as $line)
      {
        $txt=explode("<>",$line);
        for($i=0; $i<count($txt); $i++)
        {
         echo $txt[$i]." ";
        }
        echo "<br>";
      }
 ?>