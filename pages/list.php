<?php
require_once "database.php";
require_once "classes.php";

//step.1 リクエストパラメータを取得
$address = - 1;
if (isset($_REQUEST["address"])) {
    $search = $_REQUEST["address"];
}

//step.2 データベースの接続
$pdo = connectDatabase();

//step.3 実行するSQL設定
$sql = "select * from hotels where pref like '%$add%' or city like '%$add%' or address like '%$add%';";
$pstmt = $pdo->prepare($sql);
$pstmt->execute($params);
$rs = $pstmt->fetchAll();


$hotels = [];
foreach ($rs as $record) {
    $id = intval($record["id"]);
    $name = $record["name"];
    $price = intval($record["price"]);
    $pref = $record["pref"];
    $city = $record["city"];
    $address = $record["address"];
    $memo = (string) $record["memo"];
    $image = $record["image"];
    $hotel = new Hotel($id, $name, $price, $pref, $city, $address, $memo, $image);
    $hotels[] = $hotel;
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<title>ホテル検索結果一覧</title>
	<link rel="stylesheet" href="../assets/css/style.css" />
	<link rel="stylesheet" href="../assets/css/hotels.css" />
</head>

<body>
	<header>
		<h1>ホテル検索結果一覧</h1>
		<p><a href="./entry.php">検索ページに戻る</a></p>
	</header>
	<main>
		<article>
			<table>
			    <?php foreach ($hotels as $hotel) { ?>
			<tr>
					<td>
						<img src=../images/<?= $hotel->getImage()?> width="100" />
					</td>
					<td>
						<table class="detail">
							<tr>
								<td><?= $hotel->getName()?><br /></td>
							<tr>	
								<td><?= $hotel->getPref()?>
									<?= $hotel->getCity()?>
									<?= $hotel->getAddress() ?><br /></td>
							</tr>
							<tr>
								<td>宿泊料：&yen;<?= $hotel->getPrice()?></td>
							</tr>
							<tr>
								<td><?= $hotel->getMemo()?></td>
							</tr>
						</table>
			<?php } ?>
				<!--<tr>
					<td>
						<img src="../images/1.png" width="100" />
					</td>
					<td>
						<table class="detail">
							<tr>
								<td>ビジネスホテル大井町<br /></td>
							</tr>
							<tr>
								<td>東京都品川区大井 11-11-11</td>
							</tr>
							<tr>
								<td>宿泊料：&yen;7,000</td>
							</tr>
							<tr>
								<td></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<img src="../images/2.png" width="100" />
					</td>
					<td>
						<table class="detail">
							<tr>
								<td>グレースイン蒲田<br /></td>
							</tr>
							<tr>
								<td>東京都大田区蒲田 11-11-11</td>
							</tr>
							<tr>
								<td>宿泊料：&yen;7,200</td>
							</tr>
							<tr>
								<td></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<img src="../images/3.png" width="100" />
					</td>
					<td>
						<table class="detail">
							<tr>
								<td>ビジネスイン赤坂見附<br /></td>
							</tr>
							<tr>
								<td>東京都港区赤坂 11-11-11</td>
							</tr>
							<tr>
								<td>宿泊料：&yen;9,500</td>
							</tr>
							<tr>
								<td></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<img src="../images/4.png" width="100" />
					</td>
					<td>
						<table class="detail">
							<tr>
								<td>西新宿ステーションホテル<br /></td>
							</tr>
							<tr>
								<td>東京都新宿区西新宿 11-11-11</td>
							</tr>
							<tr>
								<td>宿泊料：&yen;8,500</td>
							</tr>
							<tr>
								<td>最寄駅：新宿駅、西新宿駅から徒歩5分</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<img src="../images/5.png" width="100" />
					</td>
					<td>
						<table class="detail">
							<tr>
								<td>ホテル蒲田IN<br /></td>
							</tr>
							<tr>
								<td>東京都大田区蒲田 22-22-22</td>
							</tr>
							<tr>
								<td>宿泊料：&yen;6,200</td>
							</tr>
							<tr>
								<td></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<img src="../images/6.png" width="100" />
					</td>
					<td>
						<table class="detail">
							<tr>
								<td>ホテル南新宿<br /></td>
							</tr>
							<tr>
								<td>東京都新宿区南新宿 11-11-11</td>
							</tr>
							<tr>
								<td>宿泊料：&yen;5,500</td>
							</tr>
							<tr>
								<td>最寄駅：新宿駅東口から徒歩9分</td>
							</tr>
						</table>
					</td>
				</tr>-->
			</table>
		</article>
	</main>
	<footer>
		<div id="copyright">(C) 2019 The Web System Development Course</div>
	</footer>
</body>

</html>