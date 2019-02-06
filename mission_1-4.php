<html>

<head>
<meta charset="utf-8">
</head>

<body>
<form action="mission_1-4.php" method="post">
 <input type="text" name="文字列" value="コメント">
 <input type="submit" value="送信" >
</form>
<?php
if(isset($_POST['文字列']))
$hensu=$_POST['文字列'];
echo"ご入力ありがとうございます。<br>".date("Y年N月d日H時i分s秒")."に".$hensu."を受け付けました。";
?>
</body>
</html>