<?php

if(isset($_POST['deletenumber'])&&$_POST['deletenumber']!=""&&isset($_POST['deletepass'])&&$_POST['deletepass']!="")//削除投稿番号が空白でないかつパスワードが空白でないという条件の場合以下の｛｝内の処理を行う
{
	 $deletenumber=$_POST['deletenumber'];//deletenumberを削除対象番号として受け取る
	 $pass=$_POST['deletepass'];//passをパスワードとして受け取る
	 $filename="mission_2-3_Shinoda.txt";//テキストファイル
	 $lines=file($filename);//配列としてテキストファイルを読み込む
	 $fp=fopen($filename,'w');//ファイルを上書きモードで開く
	 fclose($fp);//ファイルを閉じる

	 $fp=fopen($filename,'a');//ファイルを追記モードで開く
	 foreach($lines as $value)//テキストファイルから１行取得
	 {
		 $lines2=explode("<>",$value);//$valueを<>で分割して$lines2に入れる
		  if($lines2[0]!=$deletenumber)//削除する投稿番号と一致しなかったら以下の｛｝内の処理をする
		  {
			   if($lines2[3]!=$pass)//削除する投稿番号のパスワードと一致しなかったら以下の｛｝内の処理をする
			   {
			   	fwrite($fp,$value);//テキストファイルに書き込む
			   }
		  }
	 }
	 fclose($fp);//ファイルを閉じる
}




if(isset($_POST['editnumber'])&&$_POST['editnumber']!=""&&isset($_POST['editpass'])&&$_POST['editpass']!="")//編集番号が空白でないかつパスワードが空白でないという条件の場合以下の｛｝内の処理を行う
{
	 $editnumber=$_POST['editnumber'];//editnumberを編集番号として受け取る
	 $pass=$_POST['editpass'];//passをパスワードとして受け取る

	 $filename="mission_2-3_Shinoda.txt";//テキストファイル
	 $lines=file($filename);//配列としてテキストファイルを読み込む
	 foreach($lines as $value)//テキストファイルから１行取得
	  {
		  $lines2=explode("<>",$value);//$valueを<>で分割して$lines2に入れる

		  if($lines2[0]==$editnumber)//編集する投稿番号と一致したら以下の｛｝内の処理をする
		   {
			   if($lines2[3]==$pass)//編集する投稿番号のパスワードと一致したら以下の｛｝内の処理をする
			    {
				    $no=$editnumber;//編集番号を隠されたフォームに表示
				    $data1=$lines2[1];//名前を取得して投稿フォームに表示
				    $data2=$lines2[2];//コメントを取得して投稿フォームに表示
				    $data3=$lines2[3];//パスワードを取得して投稿フォームに表示
			    }
		   }
	  }
}

if(isset($_POST['comment'])&&$_POST['comment']!=""&&isset($_POST['name'])&&$_POST['name']!=""&&isset($_POST['commentpass'])&&$_POST['commentpass']!="")//名前が空白でないかつコメントが空白でないかつパスワードが空白でないという条件の場合以下の｛｝内の処理を行う
{
	if(isset($_POST['commentnumber'])&&$_POST['commentnumber']!="")//編集番号が入力されている場合は編集処理、そうでない場合は新規投稿
	{

		$filename="mission_2-3_Shinoda.txt";//テキストファイル
		$lines=file($filename);//配列としてテキストファイルを読み込む

		$commentnumber=$_POST['commentnumber'];//commentnumberを受け取る
		$name=$_POST['name'];//nameを新しい名前として受け取る
		$comment=$_POST['comment'];//commentを新しいコメントとして受け取る
		$pass=$_POST['commentpass'];//passをパスワードとして受け取る
		  
		$fp=fopen($filename,'w');//ファイルを上書きモードで開く（ファイルの中身を削除（初期化する））
		fclose($fp);//ファイルを閉じる

		$filename="mission_2-3_Shinoda.txt";//テキストファイル
		$fp=fopen($filename,'a');//ファイルを追記モードで開く

		foreach($lines as $value)//テキストファイルから１行取得
		{
			$lines2=explode("<>",$value);//$valueを<>で分割して$lines2に入れる

			if($lines2[0]!=$commentnumber)//編集する投稿の番号と一致しなければファイルにそのまま書き込む
			{
				fwrite($fp,$value);
			}
			else//編集する投稿番号と一致したら内容更新
			{
				$postdate=date("Y/m/d H:i:s");//日付の取得
				fwrite($fp,$commentnumber.'<>'.$name.'<>'.$comment.'<>'.$pass.'<>'.$postdate."\n");//(投稿番号)<>(名前)<>(コメント)<>(パスワード)<>(投稿された時間)をファイルに書き込む
			}
		}
		fclose($fp);//ファイルを閉じる
	}
	else//新規投稿処理
	{
		$name=$_POST['name'];//nameを名前として受け取る
		$comment=$_POST['comment'];//commentをコメントとして受け取る
		$pass=$_POST['commentpass'];//passをパスワードとして受け取る
		$postdate=date("Y/m/d H:i:s");//投稿日時を受け取る
		$filename='mission_2-3_Shinoda.txt';//テキストファイル

		$fp=fopen($filename,'a');//ファイルを追記モードで開く
		$num=count(file($filename));//ファイルのデータの行数を数えて$numに代入
		$num++;//投稿番号を取得
		fwrite($fp,$num.'<>'.$name.'<>'.$comment.'<>'.$pass.'<>'.$postdate."\n");//(投稿番号)<>(名前)<>(コメント)<>(パスワード)<>(投稿された時間)をファイルに書き込む
		fclose($fp);//ファイルを閉じる
	}
}
?>

<html>

	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<form action="mission_2-5.php" method="post">
 			 <input type="text" name="name" placeholder="名前"  value="<?php echo $data1;?>"><br/>
			 <input type="text" name="comment" placeholder="コメント" value="<?php echo $data2;?>"><br/>
			 <input type="password" name="commentpass" placeholder="パスワード" value = "<?php echo $data3;?>">
			 <input type="submit" value="送信" ><br/><br/>
			 <input type="hidden" name="commentnumber" value="<?php echo $no;?>"><br/>
			 <input type="text" name="deletenumber" placeholder="削除対象番号"><br/>
			 <input type="password" name="deletepass" placeholder="パスワード">
			 <input type="submit" value="削除"><br/><br/>
			 <input type="text" name="editnumber" placeholder="編集対象番号"><br/>
		       	 <input type="password" name="editpass" placeholder="パスワード">
			 <input type="submit" value="編集">
		</form>
	</body>
</html>

<?php
	$part="<>";//区切り文字
	$filename="mission_2-3_Shinoda.txt";
	$lines=file($filename);//テキストファイルの内容を取得
	foreach($lines as $value)//テキストファイルから一行取得
	{
		$lines2 = explode("<>",$value);
		echo $lines2[0]." ".$lines2[1]." ".$lines2[2]." ".$lines2[4]."<br>";
	}
?>
