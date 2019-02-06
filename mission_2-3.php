<html>

	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<form action="mission_2-3.php" method="post">
 			<input type="text" name="comment" placeholder="コメント"><br/>
			 <input type="text" name="name" placeholder="名前">
			 <input type="submit" value="送信" ><br/>
			 <input type="text" name="deleteNumber" placeholder="番号">
			 <input type="submit" value="削除">
		</form>
		<?php
	if(isset($_POST['comment'])&& $_POST['comment']!=""&&isset($_POST['name'])&& $_POST['name']!="")
	{	
	$comment=$_POST['comment'];
	$name=$_POST['name'];
	$date=date("Y/m/d H:i:s");

	$filename="mission_2-3_Shinoda.txt";
	$fp=fopen($filename,'a');
	$lines=file($filename);
	$num=count($lines);
	$num++;
	fwrite($fp,$num.'<>'.$name.'<>'.$comment.'<>'.$date."\n");
	fclose($fp);

	}


	
	if(isset($_POST['deleteNumber'])&&$_POST['deleteNumber']!="")
	{
		$deleteNumber=$_POST['deleteNumber'];
		$part="<>";
		$filename="mission_2-3_Shinoda.txt";
		$lines=file($filename);
		$fp=fopen($filename,"w");
		fclose($fp);
		$fp=fopen($filename,"a");

		foreach($lines as $value)
		{
			$lines2=explode($part,$value);
			if($lines2[0]!=$deleteNumber)
			{
				fwrite($fp,$value);
			}
		}
		fclose($fp);
	}
		

	$part="<>";//区切り文字
	$filename="mission_2-3_Shinoda.txt";
	$string="";//表示する文字列を入れる変数
	$lines=file($filename);//テキストファイルの内容を取得
	foreach($lines as $value)//テキストファイルから一行取得
	{
		$i=0;//ループカウンタ
		$lines2=explode($part,$value);//＄partで区分けして配列に入れる
		foreach($lines2 as $value2)//配列＄lines２から要素一つ取得
		{
			if($i==4)//五回目のループに入ったら$stringの更新は終了
			{
				break;
			}
			else
			{
				$string=$string.$value2." ";//表示する文字列の内容を更新
			}
			$i++;//ループカウンタを更新
		}

		echo$string."<br/>\n";
		$string="";//変数をリセット
	}	
	?>


	</body>
</html>