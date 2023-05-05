<?php
require_once 'bootstrap.php';
$result = (new BookController)->showBook();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="/src/css/styles.css">
    <title>MangaBook - <?= $result->titre; ?></title>
</head>
<body>

<?php include_once('navbar.php'); ?>

    <!-- Connexion Modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Connexion</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <button type="submit" class="btn btn-primary">Se connecter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- SignUp Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Inscription</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                <?php if(isset($erreur)){ ?>
                    <p><?php echo $erreur; ?></p>
                <?php } ?>

                    <form method="post" action="/login">
                        <div class="mb-3">
                            <label for="firstname" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="pseudo" class="form-label">Pseudo</label>
                            <input type="text" class="form-control" id="pseudo" name="pseudo" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary">S'incrire</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container container_book" id="container_book">
        <div class="card card_book">
            <h2><?= $result->titre; ?></h2>
            <div class="infos d-flex align-self-start">
                <div class="cover">
                    <img src="/src/images/manga/<?= $result->image; ?>" alt="<?= $result->titre; ?>">
                    
                </div>
                <div class="details">
                    <p><span>Auteur:</span> <?= $result->auteur; ?></p>
                    <p><span>Editeur:</span><?= $result->editeur; ?></p>
                    <p><span>Date de parution:</span> <?= $result->date_de_publication ?>;</p>
                    <p><span>Format:</span> <?= $result->format; ?></p>
                    <p><span>Genre:</span> <?= $result->genre; ?></p>
                    <p><span>Nombre de pages:</span> <?= $result->nb_pages; ?> pages</p>
                    <p><span>ISBN:</span> <?= $result->isbn; ?></p>
                </div>
            </div>
            <div class="resume">
                <p><span>Résumé:</span></p>
                <p> <?= $result->resume; ?></p>
            </div>
            <div class="add d-flex justify-content-end">
            <form method='POST' action="/addBookLibrary">
                <input type="hidden" name="isbn" value="<?= $result->isbn; ?>">
                <button class="btn btn-primary d-flex justify-content-around">
                    <span class="material-symbols-outlined">library_books</span> &nbsp;Mangathèque
                </button>
            </form>
            <form method='POST' action="/addBookWishList">
                <input type="hidden" name="isbn" value="<?= $result->isbn; ?>">
                <button class="btn btn-success d-flex justify-content-around">
                    <span class="material-symbols-outlined">heart_plus</span> &nbsp;Wishlist
                </button>
            </form>
            </div>
        </div>
    </div>
    
</body>
</html>