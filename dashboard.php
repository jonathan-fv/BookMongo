<?php

require_once 'bootstrap.php';

if(!isset($_SESSION['pseudo'])) {
    header('Location: index.php');
}
/**
 * @var $userInfo
 * @var $infoLibrary
 */
$users = User::showUsers();
$books = Book::showAll();

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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./src/css/styles.css">
    <title>Manga-Book - Dashboard</title>
</head>
<body>
    <?php include_once('navbar.php'); ?>
    <section>
        <div class="container container-section">
            <h2>Liste des utilisateurs</h2><br>
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Pseudo</th>
                    <th scope="col">Mail</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?php echo $user->pseudo ; ?></td>
                        <td><?php echo $user->email ; ?></td>
                        <td>
                            <div class="d-flex">
                                <form method='POST' action="" class="form-button">
                                    <div>
                                        <a class='btn btn-dark link-btn' href='updateProfil.php/?pseudo=<?= $user->pseudo; ?>'>
                                            <span class="material-symbols-outlined">edit</span>
                                        </a>
                                    </div>
                                </form>
                                <form method='POST' action="/deleteUser" class="form-button">
                                    <input type="hidden" name="pseudo" value="<?php echo $user->pseudo ; ?>">
                                    <button class="btn btn-danger d-flex justify-content-around">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
    </section>
    
    <section>
        <div class="container container-section">
        <div class="d-flex justify-content-end m-3">
            <a href="/createBook.php" class="btn btn-primary d-flex align-items-center">
                <span class="material-symbols-outlined">add</span> &nbsp;Ajouter un manga
            </a>
        </div>
            <h2>Liste des mangas</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">ISBN</th>
                    <th scope="col">Image</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($books as $book) : ?>
                        <tr>
                            <td scope="row"><?php echo $book->isbn ; ?></td>
                            <td width="5%"><img src="src/images/manga/<?php echo $book->image ; ?>" alt=""></td>
                            <td><?php echo $book->titre ; ?></td>
                            <td>
                                <div class="d-flex">
                                    <form method='POST' action="" class="form-button">
                                        <div>
                                            <a class='btn btn-dark link-btn' href='updateBook.php/?isbn=<?= $book->isbn; ?>'>
                                                <span class="material-symbols-outlined">edit</span>
                                            </a>
                                        </div>
                                    </form>
                                    <form method='POST' action="/deleteBook" class="form-button">
                                        <input type="hidden" name="isbn" value="<?php echo $book->isbn ; ?>">
                                        <button class="btn btn-danger d-flex justify-content-around">
                                            <span class="material-symbols-outlined">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    
                </tbody>
            </table>
        </div>
    </section>
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>