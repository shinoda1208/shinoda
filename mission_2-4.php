
	<?php
	$part="<>";//区切り文字
	if(isset($_POST['comment'])&& $_POST['comment']!=""&&isset($_POST['name'])&& $_POST['name']!="")
	{	
		if(empty($_POST['commentnumber']))
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
		

	if(isset($_POST['editnumber'])&&$_POST['editnumber']!="")//編集番号が入力されていたら以下の処理をする
	{
		$editnumber=$_POST['editnumber'];//editnumberを編集番号として受け取る
		$filename="mission_2-3_Shinoda.txt";
		$lines=file($filename);
		foreach($lines as $value)
		{
			$lines2=explode($part,$value);
			if($lines2[0]==$editnumber)
			{
				$no=$editnumber;//編集番号を隠されたフォームに表示
				$data1=$lines2[1];//名前を取得して投稿フォームに表示
				$data2=$lines2[2];//コメントを取得して投稿フォームに表示
			}
		}
	}

	if(isset($_POST['comment'])&&$_POST['comment']!=""&&isset($_POST['name'])&&$_POST['name']!="")//名前が空白でないかつコメントが空白でないという条件の場合以下の｛｝内の処理を行う
	{
		if(isset($_POST['commentnumber'])&&$_POST['commentnumber']!="")//編集番号が入力されている場合は編集処理、そうでない場合は新規投稿〈1〉
		{
			$filename="mission_2-3_Shinoda.txt";
			$lines=file($filename);//配列としてテキストファイルを読み込む
			$commentnumber=$_POST['commentnumber'];//commentnumberを受け取る
			$name=$_POST['name'];//nameを新しい名前として受け取る
			$comment=$_POST['comment'];//コメントを新しいコメントとして受け取る
			$fp=fopen($filename,'w');//ファイルを上書きモードで開く
			fclose($fp);//ファイルを閉じる
			$filename="mission_2-3_Shinoda.txt";
			$fp=fopen($filename,'a');//ファイルを追記モードで開く
			foreach($lines as $value)
			{
				$lines2=explode($part,$value);
				if($lines2[0]!=$commentnumber)
				{
					fwrite($fp,$value);
				}
					else
				{
					$date=date("Y/m/d H:i:s");
					fwrite($fp,$commentnumber.'<>'.$name.'<>'.$comment.'<>'.$date."\n");
				}
			}
			fclose($fp);
		}
	}
	?>


<html>

	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<form action="mission_2-4.php" method="post">
 			 <input type="text" name="name" placeholder="名前"  value="<?php echo $data1;?>"><br/>
			 <input type="text" name="comment" placeholder="コメント" value="<?php echo $data2;?>">
			 
			 <input type="submit" value="送信" ><br/><br/>
			 <input type="hidden" name="commentnumber" value="<?php echo $no;?>"><br/>
			 <input type="text" name="deleteNumber" placeholder="削除対象番号">
			 <input type="submit" value="削除"><br/><br/>
			 <input type="text" name="editnumber" placeholder="編集対象番号">
			 <input type="submit" value="編集">
		</form>

	</body>
</html>


	<?php
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