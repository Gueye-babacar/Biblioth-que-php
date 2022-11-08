<?php

// Souvent on identifie cet objet par la variable $conn ou $db
$pdo = new PDO ('mysql:host=localhost;dbname=Library',"root", "");

$sqlBook = 'SELECT b.*, a.name FROM book b LEFT JOIN author a ON a.id = b.author_id WHERE 1';

$title = "";
$author_id = "";

if (!empty($_POST)) {
    if (!empty($_POST['title'])) {
        $title = $_POST['title'];
        $sqlBook .= " AND b.title LIKE :title";
    }

    if (!empty($_POST['author_id'])) {
        $author_id = $_POST['author_id'];
        $sqlBook .= " AND b.author_id = :author_id";
    }
  }

  $query = $pdo->prepare($sqlBook);

  if (!empty($_POST)) {
    if (!empty($_POST['author_id'])) {
      $query->bindValue(':author_id', $_POST['author_id'], PDO::PARAM_INT);
    }

    if (!empty($_POST['title'])) {
      $query->bindValue(':title', '%'.$_POST['title'].'%', PDO::PARAM_STR);
    }
  }

try {
    $query->execute();
} catch (PDOException $pe) {
    echo $pe->getMessage(); die;
}
  
  $books = $query->fetchAll(PDO::FETCH_ASSOC);

  $authorsSql = "SELECT * FROM author";
  $authors = $pdo->query($authorsSql)->fetchAll();

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
            <form method="post">
                <input name="title" type="text" value="<?= $title ?>"/>
                <input name="author_id" type="text" value="<?= $author_id ?>"/>
                <input  class="btn btn-success" type="submit" value="Filtrer"/>
            </form>
        </div>
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