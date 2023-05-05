<?php
require_once 'bootstrap.php';
$routes = [
    //Route pour afficher tous les livres de la BDD
    new Route('/index', 'BookController', 'showAll'),
    //Route pour afficher un livre par rapport à son titre
    new Route('/bookDetails.php', 'BookController', 'showBook'),
    
    

    //Route pour s'enregister
    new Route("/register", 'UserController', 'register'),
    new Route("/connect" ,"UserController", "connect"),
    new Route("/addBookLibrary", "UserController", "addBookLibrary"),
    new Route("/addBookWishList", "UserController", "addBookWishlist"),
    new Route("/deleteLibrary", "UserController", 'deleteBookLibrary'),
    new Route("/deleteWishlist", "UserController", 'deleteBookWishlist'),
    new Route("/removeWishlist", "UserController", "removeWhishlistToMoveLibrary"),
    new Route("/deleteUser", "UserController", "deleteUser"),
    new Route("/updateUser", "UserController", "updateUser"),
    new Route("/deleteBook", "BookController", "deleteBook"),
    new Route("/updateBook", "BookController", "updateBook"),
    new route("/createBook", "BookController", "createBook"),
    new route("/updateBook", "BookController", "updateBook")
];

$url = parse_url($_SERVER['REQUEST_URI'])['path'];

foreach($routes as $route){
    if($route->match($url)){
        $result = $route->run();
        break;
    }
}

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
    <link rel="stylesheet" href="./src/css/styles.css">
    <title>Manga-Book</title>
</head>
<body>
    <?php include_once('navbar.php'); ?>

    <!-- Connexion Modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel">Connexion</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/connect">
                        <div class="mb-3">
                            <label for="pseudo" class="form-label">Pseudo</label>
                            <input type="text" class="form-control" id="pseudo" name="pseudo" aria-describedby="pseudolHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
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
                    <h3 class="modal-title fs-5" id="exampleModalLabel">Inscription</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                <?php if(isset($erreur)){ ?>
                    <p><?php echo $erreur; ?></p>
                <?php } ?>

                    <form method="post" action="/register">
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

    <h1>Nos Mangas</h1>
    <div class="container d-flex flex-wrap" id="dataContainer">
        <?php foreach ($result as $item): ?>
            <div class="card">
            <img src="./src/images/manga/<?= $item->image; ?>" class="card-img-top" alt="<?= $item->titre; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $item->titre; ?></h5>
                    <p class="card-text">
                        <?php 
                            $excerpt = $item->resume;
                            $caracspe = "àâäéèêëîïôöùûüÿçÀÂÄÉÈÊËIÏOÖÙUÜŸÇ";
                            $words = str_word_count($excerpt, 1, $caracspe);
                            $first_40_words = implode(' ', array_slice($words, 0, 40));
                            echo $first_40_words;
                        ?> ...
                    </p>
                </div>
                <div class="link d-flex justify-content-around ">
                    <a href="bookDetails.php/?isbn=<?= $item->isbn; ?>" class="btn btn-dark d-flex align-items-center"><span class="material-symbols-outlined">
                    info
                    </span> &nbsp;Détails</a>
                    <?php 
                        if((!empty($_SESSION))):
                            ?>
                            <form method='POST' action="/addBookLibrary">
                                <input type="hidden" name="isbn" value="<?= $item->isbn; ?>">
                                <button class="btn btn-primary d-flex justify-content-around">
                                    <span class="material-symbols-outlined">library_books</span> &nbsp;Mangathèque
                                </button>
                            </form>
                            <form method='POST' action="/addBookWishList">
                                <input type="hidden" name="isbn" value="<?= $item->isbn; ?>">
                                <button class="btn btn-success d-flex justify-content-around">
                                    <span class="material-symbols-outlined">heart_plus</span> &nbsp;Wishlist
                                </button>
                            </form>
                                
                        <?php
                        endif;
                    ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <footer class="text-center text-white">
        <!-- Copyright -->
        <div class="text-center text-dark p-3">
            © 2023 Copyright:
            <a class="text-dark" href="#">Jonathan Fenoud-Viard</a>
        </div>
        <!-- Copyright -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
