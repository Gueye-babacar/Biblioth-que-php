<?php

$pdo = new PDO ('mysql:host=localhost;dbname=Library',"root", "");

$authorsql = $pdo->query('SELECT * FROM author');

$deleteBook = $pdo->query('DELETE FROM book WHERE id = '. $_GET['id']);

header('Location:newpage.php');

?>