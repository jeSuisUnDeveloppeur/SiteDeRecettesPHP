<nav class="navbar navbar-expand-lg navbar-light bg-light position-fixed z-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Site de recettes</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <?php if(!isset($_SESSION['LOGGED_USER'])):?>
                <li class="nav-item ">
                    <a class="nav-link bg-success rounded text-light lh-sm" href="login.php">log in</a>
                    
                </li>
                <li class="nav-item">
                    <a class="nav-link bg-primary  rounded text-light lh-sm ms-2" href="signin.php">sign in</a>
                </li>
                <?php endif?>
                <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="recipes_create.php">Ajoutez une recette !</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link bg-danger rounded text-light lh-sm" href="logout.php">Déconnexion</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
