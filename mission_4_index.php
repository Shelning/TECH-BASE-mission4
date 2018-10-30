<!DOCTYPE html>
<html>
<head>
<title>しょーまの掲示板</title>
<meta charset="UTF-8">
</head>
<body>

<p>
<strong>新規投稿</strong>
<form action="mission_4_insert.php" method="post">
名前: 
<input type="text" name="name"> <br>
コメント: 
<input type="text" name="comment" size="80" value="コメント" required> <br>
パスワード: 
<input type="password" name="password_new" size="10" maxlength="20" required> <br>
<input type="submit" value="送信">
</form>
</p>

<p>
<strong>投稿を削除</strong>
<form action="mission_4_delete.php" method="post">
削除対象番号: 
<input type="text" name="delete" size="10" required> <br>
パスワード: 
<input type="password" name="password_delete" size="10" maxlength="20" required> <br>
<input type="submit" value="送信">
</form>
</p>

<p>
<strong>投稿を編集</strong>
<form action="mission_4_update.php" method="post">
編集対象番号: 
<input type="text" name="edit" size="10" required> <br>
パスワード: 
<input type="password" name="password_edit" size="10" maxlength="20" required> <br>
<input type="submit" value="送信">
</form>
</p>


<h3>投稿一覧</h3>
動作確認のためにパスワードも表示してあります(最終段階では表示させません) <br><br>
<?php
$dsn = "database" ;
$user = "user" ;
$password = "password" ;

try {
	$pdo = new PDO($dsn, $user, $password) ; //MySQLに接続・データベース選択
} catch (PDOException $e) { //$eに例外の情報が格納される
  exit('データベースに接続できませんでした。' . $e->getMessage()) ; //$e->getMessage()で格納されたエラーメッセージを表示
}
/*
try {
  チェックしたい処理
} catch (PDOException $e) {
  例外が発生したときの処理
}
*/

//表示機構
$sql = 'SELECT * FROM mission4 ORDER BY id ASC' ;
$results = $pdo -> query($sql) ;
foreach ($results as $row) {
	//$rowの中にはテーブルのカラム名が入る
	echo $row['id'].' ' ;
	echo $row['name'].': ' ;
	echo "「".$row['comment'].'」' ;
	echo $row['datetime'].' ' ;
	echo $row['password'].'<br>' ;
}
//表示機構終わり
?>


</body>
</html>