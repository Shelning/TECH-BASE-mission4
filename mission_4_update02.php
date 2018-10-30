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


$id = $_POST["edit"] ;
$name_edit = $_POST["name_edit"] ;
$comment_edit = $_POST["comment_edit"] ;
$password_new_edit = $_POST["password_new_edit"] ;
$new_datetime = new DateTime() ;
$new_datetime = $new_datetime -> format('Y-m-d H:i:s') ;
$sql = "update mission4 set name='$name_edit', comment='$comment_edit', datetime='$new_datetime', password='$password_new_edit' where id = $id" ;
$result = $pdo -> query($sql);
echo "正しく編集されました" ;
?>

<br><br>
<a href="mission_4_index.php" target="_self">トップページへ戻る</a>


</body>
</html>