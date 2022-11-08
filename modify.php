<?php

$pdo = new PDO ('mysql:host=localhost;dbname=Library',"root", "");

$authors= $pdo->query('SELECT * FROM author');
$books = $pdo->query('SELECT * FROM book WHERE id = ' . $_GET['id']);
$book = $books->fetch();
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>
Formulaire html
</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" 
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" 
    crossorigin="anonymous">
</head>
<body>
    <p>Modifier un Livre</p>

<form action="reponse.php" method="post">
    <input type="hidden" name="book_id" value="<?php echo $book['id'];?>">
    <input type="text" name="title" value="<?php echo $book['title'];?>">

    <label for="author_name_select">Nom de l'auteur:</label>
    <select name="author_id" id="authors-select">
        <option value="author_choice"></option><?php echo $author['author'];?>">
        <?php
            foreach ($authors as $author) {
                echo '<option value="' . $author['id'] . '"';
                if($author['id']===$book['author_id']){
                echo 'selected';
                }
                echo '>' . $author['name'];
            }   
        ?>
    </select>
    <input type=submit value="modifier un livre">

    <div>
        <a href="newpage.php" class="btn btn-primary">Retour à la liste des livres</a>
    </div>
</form>
</body>
</html>