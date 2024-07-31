<!-- inclusion des variables et fonctions -->
<?php
session_start();
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/variables.php');
require_once(__DIR__ . '/functions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Page d'accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"defer></script>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php require_once(__DIR__ . '/header.php'); ?>
    <div class="container">
        <div class="row">
            <h1 class="text-center mx-auto bg-primary text-white my-5 rounded-2 p-3 col-8 col-sm-7 col-md-6 col-lg-5">Site de recettes</h1>
        </div>
        <div class="d-flex justify-content-center">
            <h3 class="bg-warning text-primary border border-5 border-warning  d-inline p-2 rounded mt-5">Les recettes :</h3>
        </div>
        <?php foreach (getRecipes($recipes) as $recipe) : ?>
            <article class="mt-5">
                <h3 class="bg-warning rounded d-inline-block p-2 mb-3"><a href="recipes_read.php?id=<?php echo($recipe['recipe_id']); ?>" class="text-decoration-none text-dark"><?php echo($recipe['title']); ?></a></h3>
                <p><?php echo $recipe['recipe']; ?></p>
                <i class="text-success "><?php echo displayAuthor($recipe['author'], $users); ?></i>
                <?php if(isset($_SESSION['LOGGED_USER'])):?>
                <ul class="list-group list-group-horizontal">
                    <li class="list-group-item "><a class="link-info" href="recipes_read.php?id=<?php echo($recipe['recipe_id']); ?>">commenter l'article</a></li>
                    <?php if (isset($_SESSION['LOGGED_USER']) && $recipe['author'] === $_SESSION['LOGGED_USER']['email']) : ?>
                        <li class="list-group-item "><a class="link-warning" href="recipes_update.php?id=<?php echo($recipe['recipe_id']); ?>">Editer l'article</a></li>
                        <li class="list-group-item "><a class="link-danger" href="recipes_delete.php?id=<?php echo($recipe['recipe_id']); ?>">Supprimer l'article</a></li>
                    <?php endif ?>
                </ul>
                <?php endif ?>
            </article>
        <?php endforeach ?>
    </div>

    <!-- inclusion du bas de page du site -->
    <?php require_once(__DIR__ . '/footer.php'); ?>
</body>
</html>
