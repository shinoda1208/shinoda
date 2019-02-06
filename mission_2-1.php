<html>

<head>
<meta charset="utf-8">
</head>

<body>
<form action="mission_2-1.php" method="post">
 <input type="text" name="comment" value="コメント"><br/>
 <input type="text" name="name" value="名前"><br/>
 <input type="submit" value="送信" >
</form>
<?php
if(isset($_POST['comment'])&& $_POST['comment']!=""&&isset($_POST['name'])&& $_POST['name']!="")
{
$comment=$_POST['comment'];
$name=$_POST['name'];
$date=date("Y/m/d H:i:s");

$filename='mission_2-1_Shinoda.txt';
$fp=fopen($filename,'a');
$lines=file($filename);
$num=count($lines);
$num++;
fwrite($fp,$num.'<>'.$name.'<>'.$comment.'<>'.$date."\n");
fclose($fp);


}

?>
</body>
</html>