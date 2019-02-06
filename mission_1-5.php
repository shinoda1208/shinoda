<html>

<head>
<meta charset="utf-8">
</head>

<body>
<form action="mission_1-5.php" method="post">
 <input type="text" name="comment" value="コメント">
 <input type="submit" value="送信" >
</form>
<?php
if(isset($_POST['comment'])&& $_POST['comment']!="")
{
$comment=$_POST['comment'];

$filename='mission_1-5_Shinoda.txt';
$fp=fopen($filename,'w');
fwrite($fp,'$comment');
fclose($fp);


if($comment=="完成")
{
echo"おめでとう!";
}
else
{
echo"ご入力ありがとうございます。<br>".date("Y年N月d日H時i分s秒")."に".$hensu."を受け付けました。";
}
}
?>
</body>
</html>