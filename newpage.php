<?php

// Souvent on identifie cet objet par la variable $conn ou $db
$pdo = new PDO ('mysql:host=localhost;dbname=Library',"root", "");


$books = $pdo->query('SELECT b.*, a.name FROM book b LEFT JOIN author a ON a.id = b.author_id');

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste de Livre</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" 
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" 
    crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col -12">
                <h1>Liste des livres</h1>
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach($books as $book) {
                            ?>
                                <tr>
                                    <td><?= $book['id'] ?></td> 
                                    <td><?= $book['title'] ?></td>
                                    <td><?= $book['name'] ?></td>
                                    <td><a class="btn btn-success" href="details.php?id=<?= $book['id'] ?>">voir</a></td>
                                    <td><a class="btn btn-success"  href="modify.php?id=<?= $book['id'] ?>">modifier</a></td>
                                    <td><a class="btn btn-success" href="supprime.php?id=<?= $book['id'] ?>">supprimer</a></td>

                                </tr>
                        <?php

                        }
                    

                        ?>

                        
                    </tbody>

                </table>
                
                <a href="add.php" class="btn btn-primary">Ajouter un livre</a>
            </section>

        </div>
</body>
</html>