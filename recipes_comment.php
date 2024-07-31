<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>site de recette - commenter une recette</title>
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
    >
</head>
<body>
    <div class="container mt-5 bg-primary p-5 rounded-3 text-white fw-bold shadow-lg">
        <form action="submit_comment.php" method="post">
            <div class="my-5 w-100 row justify-content-center">
                <label for="comment" class="form-label text-center fs-3">Ecrivez vôtre commentaire ici</label>
                <textarea class="form-control" id="comment" name="comment" rows="8"></textarea>
                <input type="hidden" name="id" value="<?=$_GET['id']?>">
                <button type="submit" class="mt-5 btn btn-light col-5 col-sm-4 col-md-3 col-lg-2">Envoyer</button>
            </div>
        </form>
    </div>
    
</body>
</html>