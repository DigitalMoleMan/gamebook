<?php
	session_start();
?>
<!doctype html>
<html lang="se">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Soloäventyr - Play</title>
	<link href="https://fonts.googleapis.com/css?family=Merriweather|Merriweather+Sans" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
	 crossorigin="anonymous">
</head>

<body>
	<nav id="navbar" class="navbar navbar-light bg-light">
			<ul class="nav nav-pills">
				<li class="nav-item">
					<a class="nav-link" href="index.php">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="play.php?page=1">Play</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="edit.php">Edit</a>
				</li>
			</ul>
		</nav>
	<main class="content">
		<section>
			<h1>Spela</h1>
			<div class="container">
				<div class="row">
					<div class="col-sm">
						<!--
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit hic aliquid nostrum quibusdam veritatis? Eaque accusantium odit id deserunt, quae minima adipisci nesciunt illum ipsa ea placeat, earum laboriosam corrupti.</p>
		<footer class="gotopagelinks">
			<p>
				<a href="play.php?page=1">Nästa sida</a>
				<a href="play.php?page=2">Gå till sidan</a>
			</p>
		</footer>
-->
						<?php
	$debug = 0; 

	include_once 'include/dbinfo.php';

	// PDO
	$dbh = new PDO('mysql:host=localhost;dbname=gamebook;charset=utf8mb4', $dbuser, $dbpass);

	if ($debug) echo "<pre class='debug'>" . print_r($dbh,1) . "</pre>";

	if (isset($_GET['page'])) {

		// TODO load requested page from DB using GET
		// prio before session
		// set session to remember
		$filteredPage = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);
		if ($debug) echo "<pre  class='debug'>filteredPage = " . $filteredPage . "</pre>";

		$stmt = $dbh->prepare("SELECT * FROM story WHERE id = :id");
		$stmt->bindParam(':id', $filteredPage);
		$stmt->execute();

		if($debug) echo "<pre class='debug'> stmt = " . print_r($stmt,1) . "</pre>";

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($debug) echo "<pre class='debug'>" . print_r($row,1) . "</pre>"; // echo story data array
		echo "<div class=\"card\"><div class= \"card-body\">";
		echo $row['text'];
		echo "</div></div>";
		
		$stmt = $dbh->prepare("SELECT * FROM storylinks WHERE storyid = :id");
		$stmt->bindParam(':id', $filteredPage);
		$stmt->execute();

		$row = $stmt->fetchall(PDO::FETCH_ASSOC);

		if ($debug) echo "<pre class='debug'>" . print_r($row,1) . "</pre>"; // echo storylinks data array
		echo "<div class=\"container\"><div class=\"row\">";
		foreach ($row as $val) {
			echo "<div class=\"col-sm\"><a class=\"btn btn-secondary btn-lg btn-block\" href=\"?page=" . $val['target'] . "\">" . $val['text'] . "</a></div>";
		}

	} else if (isset($_SESSION['page'])) {
		// TODO load page from db
		// use for returning player / cookie
	} else {
		// TODO load start of story from DB
	}
?>


					</div>
				</div>
	</main>
	<script src="js/navbar.js"></script>
</body>

</html>