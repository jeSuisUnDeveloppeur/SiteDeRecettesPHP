<?php
session_start();

require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');

/**
 * On ne traite pas les super globales provenant de l'utilisateur directement,
 * ces données doivent être testées et vérifiées.
 */
$getData = $_GET;

if (!isset($getData['id']) || !is_numeric($getData['id'])) {
    echo('La recette n\'existe pas');
    return;
}

// On récupère la recette
$retrieveRecipeStatement = $mysqlClient->prepare('SELECT r.* FROM recipes r WHERE r.recipe_id = :id ');
$retrieveRecipeStatement->execute([
    'id' => (int)$getData['id'],
]);
$recipe = $retrieveRecipeStatement->fetch();

if (!$recipe) {
    echo('La recette n\'existe pas');
    return;
}

$retrieveCommentStatement = $mysqlClient->prepare(
    'SELECT c.comment,u.full_name 
    FROM comments c 
    LEFT JOIN users u 
    ON c.user_id = u.user_id 
    LEFT JOIN recipes r 
    ON c.recipe_id = r.recipe_id
    WHERE r.recipe_id = :id
    LIMIT 10;
    ');
$retrieveCommentStatement->execute([
    'id'=>(int) $getData['id'],
]);

$comments = $retrieveCommentStatement->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - <?php echo($recipe['title']); ?></title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">

        <?php require_once(__DIR__ . '/header.php'); ?>
        <h1 class="bg-success text-white text-center w-50 mx-auto p-2 rounded-3 shadow-lg"><?php echo($recipe['title']); ?></h1>
        <div class="row">
            <article class="col-12 bg-success text-center text-white mb-2 rounded-2">
                <h2>Recette</h2>
                <p><?php echo($recipe['recipe']); ?></p>
                <p class="text-warning"><i>Contribuée par <?php echo($recipe['author']); ?></i></p>
            </article>
            <aside class="col-12 d-flex flex-column align-items-center">
                <h3 class="bg-primary p-3 text-white shadow-lg rounded-3 w-100 text-center">Commentaires</h3>
                <?php 
                foreach($comments as $comment=>$value){
                    if($value['comment'] === null){
                        $value['comment'] = 'Aucun commentaire';
                        echo "
                        <p class='d-block w-50'>
                            {$value['comment']}
                        </p>";  
                    }
                    else{
                        echo "<div class='bg-primary text-light h-25 w-75 p-3 mt-5 rounded-2'>";
                            echo "<p class='d-block w-50' >{$value['comment']}</p>";
                            echo "
                            <p class='text-warning'>
                                <i>{$value['full_name']}</i>
                            </p>
                        </div>
                        ";
                    }
                }               
                ?>
            </aside>
        </div>
    </div>
    <?php require_once(__DIR__ . '/footer.php'); ?>
</body>
</html>
