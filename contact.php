<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Page d'accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">

        <?php require_once(__DIR__ . '/header.php'); ?>
        <h1 class="text-center mx-auto w-50 bg-primary text-white my-5 rounded-2 p-3">Contactez nous</h1>
        <form action="submit_contact.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3 w-75 mx-auto">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help">
                <div id="email-help" class="form-text">Nous ne revendrons pas votre email.</div>
            </div>
            <div class="mb-3 w-75 mx-auto">
                <label for="message" class="form-label">Votre message</label>
                <textarea class="form-control" placeholder="Exprimez vous" id="message" name="message"></textarea>
            </div>
            <div class="mb-3 w-75 mx-auto">
                <label for="screenshot" class="form-label">Votre capture d'écran</label>
                <input type="file" class="form-control" id="screenshot" name="screenshot" />
            </div>
            <div class="row justify-content-center">
                <button type="submit" class="btn btn-primary col-4 col-sm-3 col-md-2 col-lg-1 ">Envoyer</button>
            </div>
        </form>
    </div>

    <?php require_once(__DIR__ . '/footer.php'); ?>
</body>
</html>
