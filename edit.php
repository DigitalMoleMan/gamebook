<?php
	session_start();
?>
<!doctype html>
<html lang="se">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">  
	<title>Soloäventyr - Redigera</title>
	<link href="https://fonts.googleapis.com/css?family=Merriweather|Merriweather+Sans" rel="stylesheet"> 
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav id="navbar">
	<a href="index.php">Hem</a>
	<a href="play.php?page=1">Spela</a>
	<a class="active" href="edit.php">Redigera</a>
</nav>	
<main class="content">
	<section>
		<h1>Redigera</h1>
		<form action="" method="POST"><br>
			table
			<input type="text" name="table"><br>
			id
			<input type="text" name="id"><br>
			text
			<textarea name="text"></textarea><br>
			<input type="submit" name="create" value="create">
            <input type="submit" name="read" value="read">
            <input type="submit" name="update" value="update">
            <input type="submit" name="delete" value="delete">
            <br>
			<input type="submit" name="readall" value="readall">
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

	/*
		echo "<pre>" . print_r($_POST, 1) . "</pre>";



		include_once 'include/dbinfo.php';
		
		// PDO
		$dbh = new PDO('mysql:host=localhost;dbname=gamebook;charset=utf8mb4', $dbuser, $dbpass);

		// TODO load requested page from DB using GET
		// prio before session
		// set session to remember
		
		for($i = 1; $i <= 10; $i++) {
			$stmt = $dbh->prepare("SELECT * FROM story WHERE id = :id");
			$stmt->bindParam(':id', $i);
			$stmt->execute();
		
		
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			//echo "<pre class='debug'> filteredPage = " . print_r($filteredPage) . "</pre>";
			echo "<pre class='debug'>story" . print_r($row,1) . "</pre>"; // echo story data array

			$stmt = $dbh->prepare("SELECT * FROM storylinks WHERE storyid = :id");
			
			$stmt->bindParam(':id', $i);
			$stmt->execute();
		
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			echo "<pre class='debug'>storylinks" . print_r($row,1) . "</pre>"; // echo story data array
			
		}
		echo "<pre class='debug'>storylinks" . print_r($row,1) . "</pre>";
		echo "<pre class='debug'> dbh = " . print_r($dbh,1) . "</pre>";
		echo "<pre class='debug'> stmt = " . print_r($stmt,1) . "</pre>";
	*/
		?>
</main>
<script src="js/navbar.js"></script>
</body>
</html>