<?php 
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/variables.php');
require_once(__DIR__ . '/functions.php');
session_start();
    if(!isset($_POST['comment'])){
        echo "Erreur, non autorisé !! Vous devez remplir un formulaire pour accéder à cette page";
        return;
    }
    if(isset($_POST['comment']) && empty($_POST['comment'])){
        $_SESSION['ERROR_COMMENT'] = "le champs du commentaire de dois pas être vide";
        redirectToUrl('recipes_read.php');
    }
    $comment = sanitize($_POST['comment']);
    try{
    $queryAddComment = 'INSERT INTO comments VALUES(:comment_id,:user_id,:recip_id,:comment,:created_at,:review)';
    $statementAddComment = $mysqlClient->prepare($queryAddComment);
    $statementAddComment->bindValue('comment_id',NULL,PDO::PARAM_INT);
    $statementAddComment->bindValue('user_id',$_SESSION['LOGGED_USER']['user_id'],PDO::PARAM_INT);
    $statementAddComment->bindValue('recip_id',$_POST['id'],PDO::PARAM_INT);
    $statementAddComment->bindValue('comment',$comment,PDO::PARAM_STR);
    $statementAddComment->bindValue('created_at',NULL,PDO::PARAM_STR);
    $statementAddComment->bindValue('review',$_POST['note'],PDO::PARAM_INT);
    
        $statementAddComment->execute();
        $_SESSION['COMMENT_SUCCESS'] = "commentaire ajouté avec succès !";
        redirectToUrl('index.php');
    }catch(Exception $e){
        die('Erreur de base de donnée : '.$e->getMessage());
    }
?>