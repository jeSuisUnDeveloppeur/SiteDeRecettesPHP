<?php
session_start();

require_once(__DIR__ . '/isConnect.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Ajout de recette</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"defer></script>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php require_once(__DIR__ . '/header.php'); ?>
    <div class="container">
        <h1 class="text-center mx-auto w-50 bg-primary text-white my-5 rounded-2 p-3">Ajoutez une recette</h1>
        <form action="recipes_post_create.php" method="POST">
            <div class="mb-3 mx-auto w-75">
                <label for="title" class="form-label">Titre de la recette</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="title-help">
                <div id="title-help" class="form-text">Choisissez un titre percutant !</div>
            </div>
            <div class="mb-3 mx-auto w-75">
                <label for="recipe" class="form-label">Description de la recette</label>
                <textarea class="form-control" placeholder="Seulement du contenu vous appartenant ou libre de droits." id="recipe" name="recipe"></textarea>
            </div>
            <div class="row justify-content-center">
                <button type="submit" class="btn btn-primary col-4 col-sm-3 col-md-2 col-lg-1 ">Ajouter</button>
            </div>
        </form>
    </div>

    <?php require_once(__DIR__ . '/footer.php'); ?>
</body>
</html>
