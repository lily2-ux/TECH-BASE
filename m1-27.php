<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>m1-27</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="num" placeholder="数字を入力してください">
        <input type="submit" name="submit">
    </form>
    <?php
        $num=$_POST["num"];
        
        $filename="m1-27.txt";
        $fp=fopen($filename,"a");
        fwrite($fp, $num.PHP_EOL);
        fclose($fp);
            echo "書き込み成功！<br>";
            
        if(file_exists($filename)){
        $numbers=file($filename,FILE_IGNORE_NEW_LINES);
        foreach($numbers as $number){
       
        
        if($number%3==0 && $number%5==0) {
            echo "FizzBuzz";
        } elseif ($num%3==0) {
            echo "Fizz";
        } elseif ($num%5==0) {
            echo "Buzz";
        } else {
            echo $number ;}
        }
    }
    ?>          
</body>
</html>

<!-- <input type="text" name="num" placeholder="数字を入力してください">-->
<!--fwrite($fp, $num.PHP_EOL);-->