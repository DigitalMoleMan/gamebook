<?php
	session_start();
?>
<!doctype html>
<html lang="se">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Soloäventyr - Edit</title>
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
					<a class="nav-link" href="play.php?page=1">Play</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="edit.php">Edit</a>
				</li>
			</ul>
		</nav>
	<main class="content">
		<section>
			<h1>Redigera</h1>

			<form action="" method="POST"><br>
				<div class="container">

					<div class="row">
						<div class="col-sm">
							<div class="form-group">
								<label for="table">Table</label>
								<input type="text" id="table" class="form-control" name="table"><br>
							</div>
							<div class="form-group">
								<label for="id">ID</label>
								<input type="text" id="id" class="form-control" name="id"><br>
							</div>
							<div class="form-group">
								<label for="text">Text</label>
								<textarea name="text" class="form-control" id="text"></textarea><br>
							</div>
						</div>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-sm">
							<div class="btn-group" role="group" aria-label="Basic example">
								<input type="submit" class="btn btn-secondary" name="create" value="create">
								<input type="submit" class="btn btn-secondary" name="read" value="read">
								<input type="submit" class="btn btn-secondary" name="update" value="update">
								<input type="submit" class="btn btn-secondary" name="delete" value="delete">
								<input type="submit" class="btn btn-secondary" name="readall" value="readall">
							</div>
						</div>
					</div>
				</div>
				<br>
			</form>
			<?php
		
		include_once 'include/dbinfo.php';

		// PDO
		$dbh = new PDO('mysql:host=localhost;dbname=gamebook;charset=utf8mb4', $dbuser, $dbpass);

		if (isset($_POST['create'])) {
			if ($_POST['table'] = "story") {
			$stmt = $dbh->prepare("INSERT INTO story (text) VALUES (:text)");
		} else if ($_POST['table'] = "storylinks") {
			$stmt = $dbh->prepare("INSERT INTO storylinks (storyid, target, text) VALUES (:storyid, :target, :text)");
			$stmt->bindParam(':storyid', $_POST['storyid']);
			$stmt->bindParam(':target', $_POST['target']);
		}
			
			$stmt->bindParam(':text', $_POST['text']);
			$stmt->execute();

			$stmt = $dbh->prepare("SELECT * FROM story WHERE id = :id");
			$stmt->bindParam(':id', $_POST['id']);
			$stmt->execute();

			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			echo "<p>Created: </p>";
			foreach($row as $val) {
				echo "<pre>" . print_r($val, 1) . "</pre>";
			}
		}

		if (isset($_POST['read'])) {
			$stmt = $dbh->prepare("SELECT * FROM story WHERE id = :id");
			$stmt->bindParam(':id', $_POST['id']);
			$stmt->execute();

			echo "<p>Read: </p>";
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach($row as $val) {
				echo "<pre>" . print_r($val, 1) . "</pre>";
			}

			$stmt = $dbh->prepare("SELECT * FROM storylinks WHERE storyid = :id");
			$stmt->bindParam(':id', $_POST['id']);
			$stmt->execute();

			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach($row as $val) {
				echo "<pre>" . print_r($val, 1) . "</pre>";
			}
		}

		if (isset($_POST['readall'])) {
			$stmt = $dbh->prepare("SELECT * FROM story WHERE id != 0");
			$stmt->execute();

			

			echo "<p>Read all: </p>";
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach($row as $val) {
				echo "<pre>" . print_r($val, 1) . "</pre>";
			}
		}

		if (isset($_POST['update'])) {
			$stmt = $dbh->prepare("UPDATE story SET text = :text WHERE id = :id") ;
			$stmt->bindParam(':id', $_POST['id']);
			$stmt->bindParam(':text', $_POST['text']);
			$stmt->execute();

			echo "<p>Updated: </p>";
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach($row as $val) {
				echo "<pre>" . print_r($val, 1) . "</pre>";
			}
		}

		if (isset($_POST['delete'])) {
			$stmt = $dbh->prepare("SELECT * FROM story WHERE id = :id");
			$stmt->bindParam(':id', $_POST['id']);
			$stmt->execute();

			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			echo "<p>: </p>";
			foreach($row as $val) {
				echo "<pre>" . print_r($val, 1) . "</pre>";
			}

			$stmt = $dbh->prepare("DELETE FROM `story` WHERE id = :id") ;
			$stmt->bindParam(':id', $_POST['id']);
			$stmt->execute();
		}            
		?>
	</main>
	<script src="js/navbar.js"></script>
</body>

</html>