<?php
$pdo = new PDO ('mysql:host=localhost;dbname=Library',"root", "");

if(!empty($_GET['id'])) {
    // on nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $books = $pdo->query('SELECT b.*, a.name FROM book b LEFT JOIN author a ON a.id = b.author_id WHERE b.id = ' . $_GET['id']);
    $book= $books->fetch();

    // on vérifie si le livre existe
    if(!$book){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('location:newpage.php');
    }
}else{
    header('location: newpage.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" 
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" 
    crossorigin="anonymous">
</head>
<body>
    <h1>Les détail du livre</h1>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <p>ID <?=$book['id'] ?></p>
                <p>Titre du livre <?= $book['title'] ?></p>
                <p>Nom de l'auteur <?= $book['name'] ?></p>
                
            </section>
        </div>
       <a href="newpage.php" class="btn btn-primary">Retour à la liste des livres</a>
    </main>
</body>
</html>