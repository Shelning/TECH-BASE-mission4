<!DOCTYPE html>
<html>
<head>
<title>Mission 4</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>


<p>
<strong>新規投稿</strong>
<form action="mission_4_insert.php" method="post">
名前: 
<input type="text" name="name"> <br>
コメント:<br>
<textarea name="comment" cols="40" rows="4" value="コメント" required></textarea> <br>
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
<input type="password" name="password" size="10" maxlength="20" required> <br>
<input type="submit" value="送信">
</form>
</p>


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


if ($_POST["comment"] == NULL) {
	echo "コメントを何か書いてください" ;
} elseif ($_POST["password_new"] == NULL) {
	echo "パスワードを記入してください" ;
} else {
//新規投稿機構
$sql = $pdo -> prepare("INSERT INTO mission4 (name, comment, datetime, password) VALUES (:name, :comment, :datetime, :password)") ;
 //name, comment...などに対しそれぞれ:name, :comment...のようにパラメータを与えている。これでここの値が変わってもOK

$sql -> bindParam(':name', $_POST["name"], PDO::PARAM_STR) ;
 //bindParam(パラメータ, 変数(数値は不可), 型指定), PDO::PARAM_STRは文字列を指す
$sql -> bindParam(':comment', $_POST["comment"], PDO::PARAM_STR) ;
$datetime = new DateTime() ;
$sql -> bindParam(':datetime', $datetime->format('Y-m-d H:i:s'), PDO::PARAM_STR) ;
$sql -> bindParam(':password', $_POST["password_new"], PDO::PARAM_STR) ;

$sql -> execute() ; //prepareで用意したSQLをここでDBへINSERT, 実行の為必須(ここで変数を評価)
//投稿機構終わり
}
?>


<h3>投稿一覧</h3>
<?php
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


//実験
//二次元配列を作る
//idがそのまま一次元目になる, またidもカラムに入る
$sql = 'SELECT id, mission4. * FROM mission4 ORDER BY id ASC' ;
$rows = $pdo -> query($sql) -> fetchALL(PDO::FETCH_ASSOC|PDO::FETCH_UNIQUE) ;
//二次元配列終わり

?>



</body>
</html>