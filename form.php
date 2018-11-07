<?php
	session_start();
?>
<!doctype html>
<html lang="se">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">  
	<title>form</title>
</head>
<body>
<main class="content">
	<section>
		<h1>form</h1>
		<form action="" method="POST"><br>
			place
			<input type="text" name="place"><br>
			text
			<textarea name="text"></textarea><br>
			<input type="submit" name="create" value="create">
            <input type="submit" name="read" value="read">
            <input type="submit" name="update" value="update">
            <input type="submit" name="delete" value="delete">
            <br>
		</form>
        <?php

		    include_once 'include/dbinfo.php';

            // PDO
		    $dbh = new PDO('mysql:host=localhost;dbname=gamebook;charset=utf8mb4', $dbuser, $dbpass);

            if (isset($_POST['create'])) {
                $stmt = $dbh->prepare("INSERT INTO form (place, text) VALUES (:place, :text)");
                $stmt->bindParam(':place', $_POST['place']);
                $stmt->bindParam(':text', $_POST['text']);
                $stmt->execute();

                $stmt = $dbh->prepare("SELECT * FROM form WHERE place = :place");
                $stmt->bindParam(':place', $_POST['place']);
                $stmt->execute();

                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo "<p>Created: </p>";
                foreach($row as $val) {
                    echo "<pre>" . print_r($val, 1) . "</pre>";
                }
            }

            if (isset($_POST['read'])) {
                $stmt = $dbh->prepare("SELECT * FROM form WHERE place = :place");
                $stmt->bindParam(':place', $_POST['place']);
                $stmt->execute();

                echo "<p>Read: </p>";
                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($row as $val) {
                    echo "<pre>" . print_r($val, 1) . "</pre>";
                }
            }

            if (isset($_POST['update'])) {
                $stmt = $dbh->prepare("UPDATE form SET text = :text WHERE place = :place") ;
                $stmt->bindParam(':place', $_POST['place']);
                $stmt->bindParam(':text', $_POST['text']);
                $stmt->execute();

                echo "<p>Updated: </p>";
                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($row as $val) {
                    echo "<pre>" . print_r($val, 1) . "</pre>";
                }
            }

            if (isset($_POST['delete'])) {
                $stmt = $dbh->prepare("SELECT * FROM form WHERE place = :place");
                $stmt->bindParam(':place', $_POST['place']);
                $stmt->execute();

                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo "<p>: </p>";
                foreach($row as $val) {
                    echo "<pre>" . print_r($val, 1) . "</pre>";
                }

                $stmt = $dbh->prepare("DELETE FROM `form` WHERE place = :place") ;
                $stmt->bindParam(':place', $_POST['place']);
                $stmt->execute();
            }            
        ?>
    </section>
</main>
</body>
</html>