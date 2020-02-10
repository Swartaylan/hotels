<?php
//外部ファイルを読み込む
require_once("database.php");
require_once("classes.php");
//データベース接続オブジェクトを取得
$pdo = connectDatabase();
//sql を設定
$sql = "select * from areas";
// SQL実行
$pstmt = $pdo->prepare($sql);
//sql
$pstmt->execute();
//結果セット取得
$rs = $pstmt->fetchAll();
//データベース接続オブジェクトを
disconnectDatabase($pdo);
//結果セットを配列
$areas = [];
foreach ($rs as $record) {
    $id = intval($record["id"]);
    $name = $record["name"];
    $area = new Area($id, $name);
    $areas[] = $area;
}

//結果セットの確認
/* echo "<pre>";
var_dump($areas);
echo "</pre>";
exit(0);
*/

?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<title>ホテル検索</title>
	<link rel="stylesheet" href="../assets/css/style.css" />
	<link rel="stylesheet" href="../assets/css/hotels.css" />
</head>

<body>
	<header>
		<h1>ホテルの検索</h1>
	</header>
	<main>
		<article>
			<p>ホテルの所在地を入力してください。所在地の一部でも構いません。</p>
			<form action="list.php" method="get">
				<input type="text" name="address" />
				<input type="submit" value="検索" />
			</form>
		</article>
	</main>
	<footer>
		<div id="copyright">(C) 2019 The Web System Development Course</div>
	</footer>
</body>

</html>