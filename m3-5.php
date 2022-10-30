    <?php
        $filename = "m3-5.txt";
        
        if(!empty($_POST["name"]) && !empty($_POST["str"])){
            if(!empty($_POST["hidden"])){
            //編集実行
                //データ受け取りの変数
                $hidden = $_POST["hidden"];
                $name = $_POST["name"];
                $str = $_POST["str"];
                //日付を取得
                $date = date("Y年m月d日 H時i分s秒");
                $pass = $_POST["pass"];
                
                //コメント
                $comment = $hidden . "<>". $name. "<>". $str. "<>". $date."<>". $pass."<>";
                
                //$linesに配列として代入
                $lines = file($filename, FILE_IGNORE_NEW_LINES);
                
                //ファイルを上書きモードで開く
                $fp = fopen($filename, "w");
                
                for($i = 0; $i < count($lines); $i++){
                    //"<>"で区切って$lineに代入
                    $line = explode("<>",$lines[$i]);
                    
                    //投稿番号(hidden)の取得
                    $postnum = $line[0];
                    
                    //投稿番号と編集実行番号が一致したら差し替える
                    //一致しなかったらそのまま書き込む
                    if($postnum == $hidden){
                        fwrite($fp, $comment.PHP_EOL);
                    }else{
                        fwrite($fp, $lines[$i].PHP_EOL);
                    }
                }
                fclose($fp);
            }else{
                //投稿フォームの処理
                $name = $_POST["name"];
                $str = $_POST["str"];
                $date = date("Y年m月d日 H時i分s秒");
                $pass = $_POST["pass"];
                
                //ファイル名が存在したら、投稿番号+１
                if(file_exists($filename)){
                    $line = file($filename,FILE_SKIP_EMPTY_LINES);
                    $n = count($line)-1;
                    //$n = 行数
                    $postnum = mb_substr($line[$n],0,1)+1;
                    // mb_substr = 文字を割り出す = (対象文字列,取得開始位置の数値, 取得する長さの数値)
                }else{
                    $postnum = 1;
                    //ファイルが存在しなかったら投稿番号は１
                }
                
                $comment = $postnum."<>". $name. "<>". $str."<>" .$date ."<>".$pass."<>";
                
                //新規投稿の処理
                $fp = fopen($filename, "a");
                fwrite($fp, $comment.PHP_EOL);
                fclose($fp);
            }
        //投稿削除フォームの処理
        }elseif(!empty($_POST["delnum"])){
            //削除番号の取得
            $delnum = $_POST["delnum"];
            $delpass = $_POST["delpass"];
            
            $lines = file($filename, FILE_IGNORE_NEW_LINES);
            
            $fp_del = fopen($filename, "w");
            for($i = 0; $i <count($lines); $i++){
                $line = explode("<>",$lines[$i]);
                
                //投稿番号の取得
                $postnum = $line[0];
                $password = $line[4];
                
                // 投稿番号と削除対象番号が一致しない場合、
                // かつパスワードが一致しない場合のみ書き込む（削除はしない）
                if($postnum != $delnum){
                    fwrite($fp_del,$lines[$i].PHP_EOL);
                }elseif($password != $delpass){
                    fwrite($fp_del,$lines[$i].PHP_EOL);
                }
            }
            fclose($fp_del);
        //投稿編集フォームの処理
        }elseif(!empty($_POST["editnum"]) && !empty($_POST["editpass"])){
            $name = $_POST["name"];
            $str = $_POST["str"];
            $date = date("Y年m月d日 H時i分s秒");
            $editpass = $_POST["editpass"];
            //編集対象番号
            $editnum = $_POST["editnum"];
            
            $lines = file($filename,FILE_IGNORE_NEW_LINES);
            $fp_edit = fopen($filename, "w");
            for($i = 0; $i < count($lines); $i++){
                $line = explode("<>",$lines[$i]);
                
                $postnum = $line[0];
                $password = $line[4];
                
                //投稿番号と編集対象番号を比較。
                //同じ場合、かつパスワードが一致しているときのみ
                //その投稿の「名前」と「コメント」を取得
                if($postnum == $editnum && $password == $editpass){
                    $editname = $line[1];
                    $editstr = $line[2];
                }
                fwrite($fp_edit, $lines[$i].PHP_EOL);
            }
            fclose($fp_edit);
        }

    ?>
    
<!DOCTYPE html>
<html lang="ja">
  <head>
     <meta charset="UTF-8">
     <title>m3-5</title>
  </head>
  <body>
    
    <h1> 好きなお菓子 </h1>
    
    <!--入力フォーム-->
    <form action="" method="post">
        <h2>投稿フォーム</h2>
        <input type = "text" name = "name" placeholder = "名前" value=<?php if(!empty($editname)){echo $editname;} ?>><br>
        <input type = "text" name = "str" placeholder = "コメント" value=<?php if(!empty($editstr)){echo $editstr;} ?>><br>
        <input type = "text" name = "pass" placeholder = "パスワード">
        <input type = "submit" name = "submit" value = "送信"><br>
        <br>
        <h2>削除フォーム</h2>
        <input type = "text" name = "delnum" placeholder = "削除対象番号"><br>
        <input type = "text" name = "delpass" placeholder = "パスワード">
        <input type = "submit" name = "delete" value = "削除"><br>
        <br>
        <h2>編集フォーム</h2>
        <input type = "text" name = "editnum" placeholder = "編集対象番号"><br>
        <input type = "text" name = "editpass" placeholder = "パスワード">
        <input type = "submit" name = "edit" value = "編集"><br>
        <input type = "hidden" name = "hidden" value = <?php if(!empty($editnum)){echo $editnum;}?>>
        
    </form>
    </body>
</html>
    <?php
        //表示用
           // 表示機能
    if(file_exists($filename)){
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
    }
    ?>