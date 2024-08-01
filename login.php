<?php session_start();?>
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
            <h2 class="bg-primary col-5 col-sm-4 col-md-3 col-lg-2 p-2 my-5 rounded-2 text-light">Page de connexion</h2>
        </div>
<?php if (!isset($_SESSION['LOGGED_USER'])) : ?>
    <form action="submit_login.php" method="POST" class="mt-5">
        <!-- si message d'erreur on l'affiche -->
        <?php if (isset($_SESSION['LOGIN_ERROR_MESSAGE'])) : ?>
            <div class="alert alert-danger text-center mx-auto w-50" role="alert">
                <?php echo $_SESSION['LOGIN_ERROR_MESSAGE'];
                unset($_SESSION['LOGIN_ERROR_MESSAGE']); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['ACCOUNT_CREATED'])):?>
            <div class="alert alert-success text-center mx-auto w-50" role="alert">
                <?php echo $_SESSION['ACCOUNT_CREATED'];
                unset($_SESSION['ACCOUNT_CREATED']); ?>
            </div>
        <?php endif?>
        <div class="mb-3 w-75 mx-auto">
            <label for="email" class="form-label ">Email</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help" placeholder="you@exemple.com">
            <div id="email-help" class="form-text">L'email utilisé lors de la création de compte.</div>
        </div>
        <div class="mb-3 mx-auto w-75">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="row justify-content-center">
            <button type="submit" class="btn btn-primary col-4 col-sm-3 col-md-2 col-lg-1 ">Envoyer</button>
        </div>
    </form>
    <!-- Si utilisateur/trice bien connectée on affiche un message de succès -->
<?php else : ?>
    <div class="alert alert-success mt-3 text-center" role="alert">
        Bonjour <?php echo $_SESSION['LOGGED_USER']['email']; ?> et bienvenue sur le site !
    </div>
    <?php if(isset($_SESSION['COMMENT_SUCCESS'])):?>
        <div class="alert alert-primary mt-3" role="alert">
            <?= $_SESSION['COMMENT_SUCCESS']?>
            <?php unset($_SESSION['COMMENT_SUCCESS'])?>
        </div>
    <?php endif ?>
<?php endif; ?>
<?php require_once 'footer.php'?>
</body>
</html>

