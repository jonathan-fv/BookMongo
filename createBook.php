<?php
require_once 'bootstrap.php';

if(!isset($_SESSION['pseudo'])) {
    header('Location: index.php');
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="/src/css/styles.css">
    <title>Manga-Book - Ajout d'un manga</title>
</head>
<body>
<?php include_once('navbar.php'); ?>
<section>
        <div class="container container-section">
            <h2>Formulaire d'ajout de manga</h2>
            <form method="POST" action="/createBook" enctype="multipart/form-data">
                <div class="d-flex justify-content-around mt-5">
                    <div class="mb-3 input-box" width="50%">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="text" class="form-control" id="isbn" name="isbn" aria-describedby="pseudolHelp">
                    </div>
                    <div class="mb-3 input-box" width="50%">
                        <label for="titre" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="titre" name="titre" aria-describedby="pseudolHelp">
                    </div>
                </div>
                <div class="d-flex justify-content-around mt-2">
                    <div class="mb-3 input-box" width="50%">
                        <label for="auteur" class="form-label">Auteur</label>
                        <input type="text" class="form-control" id="auteur" name="auteur" aria-describedby="pseudolHelp">
                    </div>
                    <div class="mb-3 input-box" width="50%">
                        <label for="editeur" class="form-label">Editeur</label>
                        <input type="text" class="form-control" id="editeur" name="editeur" aria-describedby="pseudolHelp">
                    </div>
                </div>
                <div class="d-flex justify-content-around mt-2">
                    <div class="mb-3 input-box" width="50%">
                        <label for="date_de_publication" class="form-label">Date de publication</label>
                        <input type="text" class="form-control" id="date_de_publication" name="date_de_publication" aria-describedby="pseudolHelp">
                    </div>
                    <div class="mb-3 input-box" width="50%">
                        <label for="format" class="form-label">Format</label>
                        <input type="text" class="form-control" id="format" name="format" aria-describedby="pseudolHelp">
                    </div>
                </div>
                <div class="d-flex justify-content-around mt-2">
                    <div class="mb-3 input-box" width="50%">
                        <label for="genre" class="form-label">Genre</label>
                        <input type="text" class="form-control" id="genre" name="genre" aria-describedby="pseudolHelp">
                    </div>
                    <div class="mb-3 input-box" width="50%">
                        <label for="nb_pages" class="form-label">Nombre de pages</label>
                        <input type="number" class="form-control" id="nb_page" name="nb_pages" aria-describedby="pseudolHelp">
                    </div>
                </div>
                <div class="mb-3 input-img">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image" aria-describedby="pseudolHelp">
                </div>
                <div class="mb-3 input-img">
                    <label for="resume" class="form-label">Résumé</label>
                    <textarea name="resume"  class="form-control" cols="200" rows="10"></textarea>
                </div>
                <br>
                <div class="d-flex justify-content-end">
                    <button id="create" name="create" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>