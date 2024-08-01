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
try{
    $retrieveRecipeStatement = $mysqlClient->prepare('SELECT r.* FROM recipes r WHERE r.recipe_id = :id ');
    $retrieveRecipeStatement->execute([
        'id' => (int)$getData['id'],
    ]);
    $recipe = $retrieveRecipeStatement->fetch();
}catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}

if (!$recipe) {
    echo('La recette n\'existe pas');
    return;
}

try{
        $retrieveCommentStatement = $mysqlClient->prepare(
        "SELECT c.comment,u.full_name,c.created_at AS dateTime,DATE_FORMAT(c.created_at,'%d/%m/%Y') AS date
        FROM comments c 
        LEFT JOIN users u 
        ON c.user_id = u.user_id 
        LEFT JOIN recipes r 
        ON c.recipe_id = r.recipe_id
        WHERE r.recipe_id = :id
        ORDER BY dateTime DESC 
        LIMIT 10;
        ");
    $retrieveCommentStatement->execute([
        'id'=>(int) $getData['id'],
    ]);

    $comments = $retrieveCommentStatement->fetchAll();
}catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}

try{
    $queryGetReview = "SELECT AVG(c.review) AS average_review FROM comments c LEFT JOIN recipes r ON c.recipe_id = r.recipe_id WHERE r.recipe_id = :id";
    $statementGetReview = $mysqlClient->prepare($queryGetReview);
    $statementGetReview->execute([
        'id'=>(int) $getData['id'],
    ]);
    $average = $statementGetReview->fetch();
}catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - <?php echo($recipe['title']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"defer></script>
    <link href="style/style.css" rel="stylesheet" type="text/CSS"/>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php require_once(__DIR__ . '/header.php'); ?>
    <div class="container">
        <div class="row justify-content-center gap-5 align-items-end">
            <h1 class="col-lg-3 bg-success text-white text-center p-2 rounded-3 shadow-lg mt-5"><?php echo($recipe['title']); ?></h1>
            <p class="col-lg-3 p-2 fw-semibold fst-italic bg-dark text-warning rounded"> <u>Note moyenne de la recette</u> : <?=$average['average_review']?> / 5</p>
        </div>
        <div class="row">
            <article class="col-12 bg-success text-center text-white mb-2 rounded-2">
                <h2>Recette</h2>
                <p><?php echo($recipe['recipe']); ?></p>
                <p class="text-warning"><i>Contribuée par <?php echo($recipe['author']); ?></i></p>
            </article>
            <aside class="col-12 d-flex flex-column align-items-center">
                <h3 class="bg-primary p-3 text-white shadow-lg rounded-3 w-100 text-center">Commentaires</h3>
                <?php 
                 if($comments === []){
                    $noComment = 'Aucun commentaire';
                    echo "<div class=' bg-primary text-light h-auto w-50 p-3 mt-5 rounded-2'>";
                    echo "
                        <p class='d-block text-center '>
                            {$noComment}
                        </p>
                    </div>
                    ";      
                }
                
                foreach($comments as $comment=>$value){
                        echo "<div class='bg-primary text-light h-auto w-75 p-3 mt-5 rounded-2'>";
                            echo "<p class='d-block w-100 fs-6' >{$value['comment']}</p>";
                            echo "
                            <p class='text-warning lh-lg fw-normal'>
                                <b>{$value['full_name']}</b><br/>
                                <i>publié le : {$value['date']}</i>
                            </p>
                        </div>
                        ";
                    
                }              
                ?>
            </aside>
        </div>   
    </div>
    <?php if(isset($_SESSION['LOGGED_USER'])):?>
    <div class="container-fluid">
        <hr class="my-3">
        <form action="submit_comment.php" method="post" class="bg-secondary rounded px-4 py-1 ">
            <div class="my-5 w-100 d-flex flex-column align-items-center">

                <label for="comment" class="form-label text-center fs-3 text-white">Ajouter un commentaire</label>
                <textarea class="form-control w-75 text-center" id="comment" name="comment" rows="8" placeholder="merci de rester poli et courtois"></textarea>
                <?php if(isset($_GET['id'])):?>
                    <?php $_SESSION['id'] = $_GET['id']?>
                    <input type="hidden" name="id" value=<?=$_GET['id']?>>
                <?php else:?>
                    <input type="hidden" name="id" value=<?=$_SESSION['id']?>>
                <?php endif ?>
                <?php if(isset($_SESSION['ERROR_COMMENT'])):?>
                    <div class="alert alert-danger mt-3 text-center" role="alert">
                        <?= $_SESSION['ERROR_COMMENT']?>
                        <?php unset($_SESSION['ERROR_COMMENT']);?>
                </div>
                <?php endif?>
                <fieldset>
                    <legend class="text-white text-center">Donnez une note</legend>
                    <p class="wrapper-rating">
                        <input name="note" id="note_0" value="-1" type="radio" checked >
                        <span class="star">
                            <input name="note" id="note_1" value="1" type="radio">
                            <label for="note_1" title="Très mauvaise"><svg><use href="etoile.svg#star"></use></svg></label>
                            <span class="star">
                            <input name="note" id="note_2" value="2" type="radio">
                            <label for="note_2" title="Médiocre"><svg><use href="etoile.svg#star"></use></svg></label>
                            <span class="star">
                                <input name="note" id="note_3" value="3" type="radio">
                                <label for="note_3" title="Moyenne"><svg><use href="etoile.svg#star"></use></svg></label>
                                <span class="star">
                                    <input name="note" id="note_4" value="4" type="radio">
                                    <label for="note_4" title="Bonne"><svg><use href="etoile.svg#star"></use></svg></label>
                                    <span class="star">
                                        <input name="note" id="note_5" value="5" type="radio">
                                        <label for="note_5" title="Excellente"><svg><use href="etoile.svg#star"></use></svg></label>
                                    </span>
                                </span>
                            </span>
                            </span>
                        </span>
                    </p>
                </fieldset>
                <button type="submit" class="mt-5 btn btn-light col-5 col-sm-3 col-md-2 col-lg-1">Envoyer</button>
            </div>
        </form>
    </div>
    <?php endif?>
    <?php require_once(__DIR__ . '/footer.php'); ?>
</body>
</html>
