<?php
require_once 'bootstrap.php';

if(!isset($_SESSION['pseudo'])) {
    header('Location: index.php');
}
/**
 * @var $userInfo
 * @var $infoLibrary
 */
$userInfo = User::showInfo($_SESSION['pseudo']);

$infoLibrary = User::showLibrary($_SESSION['pseudo']);
$infoWishList = User::showWishList($_SESSION['pseudo']);


?>

<!DOCTYPE html>
<html lang="fr">
<head>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./src/css/styles.css">
    <title>Manga-Book Profil de <?php echo $_SESSION['pseudo'];?></title>
</head>
</head>
<body>
<?php include_once('navbar.php'); ?>
    <h1 class='title-profil'>Bonjour <?php echo $_SESSION['pseudo'];?></h1>
    <div class="container container_info d-flex justify-content-center" id="container_info">
        <div class="card d-flex align-items-center flex-row">
            <span class="material-symbols-outlined user">account_circle</span>
            <div class="card-body">
            <h4 class="card-title h5 h4-sm">Mes infos</h4>
                <p class="card-text"><b>Nom: </b><?php echo $userInfo->firstname ?></p>
                <p class="card-text"><b>Prémon: </b><?php echo $userInfo->lastname ?></p>
                <p class="card-text"><b>Email: </b><?php echo $userInfo->email ?></p>
            </div>
        </div>
    </div>

    <h3 class='title-info'>Ma Mangathèque</h3>
    <div class="container container_manga d-flex justify-content-center flex-wrap" id="container_manga">
        <?php foreach ($infoLibrary as $item): ?>
            <div class="card library-card">
                <img src="./src/images/manga/<?= $item->image; ?>" class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $item->titre ?></h5>
                </div>
                <div class="link d-flex justify-content-around flex-wrap align-items-center">
                    <div class="btn_manga">
                        <a class="btn btn-dark d-flex align-items-center" href="bookDetails.php/?isbn=<?= $item->isbn; ?>"><span class="material-symbols-outlined">info</span> &nbsp;Détails</a>
                    </div>
                    <div class="btn_manga">
                        <form method='POST' action="/deleteLibrary">
                            <input type="hidden" name="isbn" value="<?= $item->isbn; ?>">
                            <button class="btn btn-primary d-flex justify-content-around btn-danger">
                                <span class="material-symbols-outlined">delete</span> &nbsp;Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <h3 class='title-info'>Ma Whislist</h3>
    <div class="container container_manga d-flex justify-content-center flex-wrap" id="container_manga">
        <?php foreach ($infoWishList as $item): ?>
            <div class="card library-card">
                <img src="./src/images/manga/<?= $item->image; ?>" class="card-img-top" alt="<?= $item->titre; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $item->titre; ?></h5>
                </div>
                <div class="link d-flex justify-content-around flex-wrap align-items-center">
                    <div class="btn_manga">
                        <a class="btn btn-dark d-flex align-items-center link-profil" href="bookDetails.php/?isbn=<?= $item->isbn; ?>"><span class="material-symbols-outlined">info</span> &nbsp;Détails</a>
                    </div>
                    <div class="btn_manga">
                        <form method='POST' action="/removeWishlist">
                            <input type="hidden" name="isbn" value="<?= $item->isbn; ?>">
                            <button class="btn btn-primary d-flex justify-content-around">
                                <span class="material-symbols-outlined">library_books</span> &nbsp;Mangathèque
                            </button>
                        </form>
                    </div>
                    <div class="btn_manga">
                        <form method='POST' action="/deleteWishlist">
                            <input type="hidden" name="isbn" value="<?= $item->isbn; ?>">
                            <button class="btn btn-primary d-flex justify-content-around btn-danger">
                                <span class="material-symbols-outlined">delete</span> &nbsp;Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>