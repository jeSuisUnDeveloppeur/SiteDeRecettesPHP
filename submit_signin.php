<?php
session_start();
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/variables.php');
require_once(__DIR__ . '/functions.php');

if(
    empty($_POST['name'])
    ||empty($_POST['firstName'])
    ||empty($_POST['age'])
    ||empty($_POST['email'])
    ||empty($_POST['password'])
){
    $_SESSION['SIGNIN_ERROR'] = 'merci de remplir tout les champs avec un \' * \'';
    redirectToUrl('signin.php');
}

$name = sanitize($_POST['name']);
$firstName = sanitize($_POST['firstName']);
$age = sanitize($_POST['age']);
$email = sanitize($_POST['email']);
$password = sanitize($_POST['password']);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $_SESSION['SIGNIN_ERROR'] = "format d'email invalide";
    redirectToUrl('signin.php');
}

try{
    $queryDuplicateEmail = "SELECT COUNT(*) AS 'doublon' FROM users WHERE email = :email";
    $statementDuplicateEmail = $mysqlClient->prepare($queryDuplicateEmail);
    $statementDuplicateEmail->execute([
        'email'=>(string)$email,
    ]);
    $duplicate = $statementDuplicateEmail->fetch();
}catch(Exception $e){
    die('Erreur :'.$e->getMessage());
}

if($duplicate['doublon']){
    $_SESSION['SIGNIN_ERROR'] = "Un compte est déjà associé à cette email";
    redirectToUrl('signin.php');
}

try{
    $queryAddUser = "INSERT INTO users VALUES(:user_id,:full_name,:email,:password,:age)";
    $queryAddUser = $mysqlClient->prepare($queryAddUser);
    $queryAddUser->bindValue('user_id',NULL,PDO::PARAM_NULL);
    $queryAddUser->bindValue('full_name',$firstName." ".$name,PDO::PARAM_STR);
    $queryAddUser->bindValue('email',$email,PDO::PARAM_STR);
    $queryAddUser->bindValue('password',$password,PDO::PARAM_STR);
    $queryAddUser->bindValue('age',$age,PDO::PARAM_INT);
    $queryAddUser->execute();
    $_SESSION['ACCOUNT_CREATED'] = "Votre compte à bien été créer vous pouvez vous connecter depuis cette page pour accéder à toute les fonctionalité du site et réer des recettes pour la communautée !";
    redirectToUrl('login.php');
}catch(Exception $e){
    die('Erreur: '.$e->getMessage());
}



?>