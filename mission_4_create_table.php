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


 // mission_3-2, テーブルを作る(SQL作成&実行)
$sql = "CREATE TABLE mission4"
." ("
."id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,"
/*
AUTO_INCREMENT: 一ずつ増加する連番
NOT NULL PRIMARY KEY: 以前の番号とかぶらないようにする=削除されても続けて番号ふり
*/
."name char(40),"
."comment TEXT,"
."datetime DATETIME,"
."password char(20)"
.");" ;
$stmt = $pdo -> query($sql) ; //SQL実行, $stmtはPDOStatementと呼ばれるオブジェクト, $pdoとは別物


$stmt = $pdo->query('SET NAMES utf8');
if ($stmt == NULL) { //コマンドが正しく実行されないとNULLが帰る
  $info = $pdo -> errorInfo(); //先頭から順に「SQLのエラーコード」「ドライバ固有のエラーコード」「ドライバ固有のエラーメッセージ」が格納
  exit($info[2]);
}
?>


</body>
</html>