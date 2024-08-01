<?php 
session_start();
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/variables.php');
require_once(__DIR__ . '/functions.php');
?>

<!DOCTYPE html>
   <html lang="en">
   <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recette - page de connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"defer></script>
   </head>
   <body>
    <?php require_once 'header.php'?>
   <div class="row justify-content-center text-center">
            <h2 class="bg-primary col-5 col-sm-4 col-md-3 col-lg-2 p-2 my-5 rounded-2 text-light">Création de compte</h2>
    </div>
    <form action="submit_signin.php" method="POST" class="mt-5">
        <div class="mb-3 w-75 mx-auto">
            <label for="name" class="form-label ">Nom *</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="mb-3 w-75 mx-auto">
            <label for="firstName" class="form-label ">Prénom *</label>
            <input type="text" class="form-control" id="firstName" name="firstName">
        </div>
        <div class="mb-3 w-75 mx-auto">
            <label for="age" class="form-label ">age *</label>
            <input type="number" class="form-control" id="age" name="age">
        </div>
        <div class="mb-3 w-75 mx-auto">
            <label for="email" class="form-label ">Email *</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help" placeholder="you@exemple.com">
        </div>
        <div class="mb-3 mx-auto w-75">
            <label for="password" class="form-label">Mot de passe *</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <?php if(isset( $_SESSION['SIGNIN_ERROR'])):?>
            <p class="alert alert-danger text-center w-50 mx-auto" role="alert"><?= $_SESSION['SIGNIN_ERROR']?></p>
            <?php unset( $_SESSION['SIGNIN_ERROR'])?>
        <?php endif?>
        <div class="row justify-content-center">
            <button type="submit" class="btn btn-primary col-4 col-sm-3 col-md-2 col-lg-1 ">Envoyer</button>
        </div>
    </form>