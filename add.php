<?php

$pdo = new PDO ('mysql:host=localhost;dbname=Library',"root", "");

$authors = $pdo->query('SELECT * FROM author');
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>
Formulaire html
</title>
</head>
<body>
<p>Ajouter un Livre</p>

<form action="reponse.php" method="post">
Titre du livre :<input type="text" name="title">
<label for="author_name_select">Nom de l'auteur:</label>
     <select name="author_id" id="authors-select">
        <option value="author_choice">--Choix de l'auteur--</option>
        <?php
          foreach ($authors as $author) {
            echo '<option value="' . $author['id'] . '">' . $author['name'] . '</option>';
          }
        ?>
      </select>
<input type=submit value="Ajouter un Livre">
</form>
</body>
</html>
