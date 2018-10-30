<!DOCTYPE html>
<html>
<head>
<title>Mission 4</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>


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

//二次元配列を作る
//idがそのまま一次元目になる, またidもカラムに入る
$sql = 'SELECT id, mission4. * FROM mission4 ORDER BY id ASC' ;
$rows = $pdo -> query($sql) -> fetchALL(PDO::FETCH_ASSOC|PDO::FETCH_UNIQUE) ;
//二次元配列終わり


if ($_POST[edit]==$rows[$_POST["edit"]]['id']) {
	if ($_POST["password_edit"]==$rows[$_POST["edit"]]['password']) {
?> <! 命令の分離 ->

		<strong>編集してください</strong>
		<form action="mission_4_update02.php" method="post">
		<input type="hidden" name="edit" value="<?php echo $rows[$_POST["edit"]]['id']; ?>">
		名前: 
		<input type="text" name="name_edit" value="<?php echo $rows[$_POST["edit"]]['name']; ?>"> <br>
		コメント: 
		<input type="text" name="comment_edit" size="80" value="<?php echo $rows[$_POST["edit"]]['comment']; ?>" required> <br>
		パスワード: 
		<input type="password" name="password_new_edit" size="10" maxlength="20" required> <br>
		<input type="submit" value="送信">
		</form>

<?php //命令再開
	} else {
		echo "パスワードが違います" ;
	}
} else {
	echo "指定された投稿は存在しないか、削除されています" ;
}
?>


</body>
</html>