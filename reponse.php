<?php

$pdo = new PDO ('mysql:host=localhost;dbname=Library',"root", "");

$result = "no";
// on prépare la requête
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "INSERT INTO book (title, author_id) VALUES (:title, :author_id)";

    if (isset($_POST['book_id'])) {
        $sql = 'UPDATE book SET title=:title, author_id=:author_id WHERE id = ' . $_POST['book_id'];
    }

    $insertion = $pdo->prepare($sql);

    $insertion->bindValue(':title', $_POST['title']);
    $insertion->bindValue(':author_id', $_POST['author_id']);

    $insertion->execute();


}

header('Location: /newpage.php'); /* Redirection du navigateur */

exit;


