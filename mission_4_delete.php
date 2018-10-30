<!DOCTYPE html>
<html>
<head>
<title>削除画面</title>
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

if ($_POST[delete]==$rows[$_POST[delete]]['id']) {
	if ($_POST["password_delete"]==$rows[$_POST[delete]]['password']) {
		$sql2 = "delete from mission4 where id = $_POST[delete]" ;
		$result = $pdo -> query($sql2);
		echo "正しく削除されました" ;
	} else {
		echo "パスワードが違います" ;
	}
} else {
	echo "指定された投稿は存在しないか、既に削除されています" ;
}
?>

<br><br>
<a href="mission_4_index.php" target="_self">トップページへ戻る</a>


</body>
</html>