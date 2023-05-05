<?php

require_once 'bootstrap.php';

if(!isset($_SESSION['pseudo'])) {
    header('Location: index.php');
}
/**
 * @var $userInfo
 * @var $infoLibrary
 */
$user = User::showInfo($_GET['pseudo']);


?>


<!DOCTYPE html>
<html lang="fr">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="/src/css/styles.css">
    <title>Modification de profil</title>
</head>
<body>
    <?php include_once('navbar.php'); ?>

    <div class="container updateprofil"><br>
    <h2>Modification du profil de <?= $user->pseudo; ?></h2>
        <form method="POST" action="/updateUser?pseudo=<?php echo $user->pseudo?>">
            <div class="mb-3">
                <label for="firstname" class="form-label">Nom</label>
                <input type="text" value="<?= $user->firstname; ?>" class="form-control" id="pseudo" name="firstname" aria-describedby="pseudolHelp">
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Prénom</label>
                <input type="text" value="<?= $user->lastname; ?>" class="form-control" id="pseudo" name="lastname" aria-describedby="pseudolHelp">
            </div>
            <div class="mb-3">
                <label for="pseudo" class="form-label">Pseudo</label>
                <input type="text" value="<?= $user->pseudo; ?>" class="form-control" id="pseudo" name="pseudo" aria-describedby="pseudolHelp">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" value="<?= $user->email; ?>" class="form-control" id="pseudo" name="email" aria-describedby="pseudolHelp">
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
    
</body>
</html>