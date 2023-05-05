<?php

use MongoDB\Driver\Cursor;

class User{
    private $id;
    private $firstname;
    private $lastname;
    private $pseudo;
    private $email;
    private $password;
    private $role;

    public function __construct($id, $firstname, $lastname, $pseudo, $email, $password, $role){
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public static function register(){
        $database = MongoDatabaseConnectionService::get();
        // Vérifie si le formulaire à été soumis
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            // Recupère les valeurs des champs du formulaire
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $pseudo = $_POST['pseudo'];
            $email= $_POST['email'];
            $password = $_POST['password'];

            // Vérifie ques les champs ne sont pas vides
            if(!empty($firstname) && !empty($lastname) && !empty($pseudo) && !empty($email)  && !empty($password)){
                 // Crée un document pour la nouvelle entrée dans la bdd
                    $document = [
                        "firstname" => $firstname,
                        "lastname"=> $lastname,
                        "pseudo"=> $pseudo,
                        "email"=> $email,
                        "password" => password_hash($password, PASSWORD_DEFAULT),
                    ];
                    $_SESSION["pseudo"] = $pseudo;
                    $database->selectCollection('Users')->insertOne($document);
                     // Redirige l'utilisateur
                    header('Location: /index');
                    exit();
            }
            else{
                // Affiche un message d'erreur
                $erreur = "Veuille remplir tous les champs.";
            }
        }
    }

    public static function connect($pseudo, $password, $role){

        $database = MongoDatabaseConnectionService::get();
        
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            // Recupère les valeurs des champs du formulaire
            $pseudo = $_POST["pseudo"];
            $password = $_POST["password"];
            // Vérifie que les champs sont pas vide
            if(!empty($pseudo) && !empty($password)){
                // Crée une requête de recherche pour l'email de l'utilisateur
                $filter = ["pseudo" => $pseudo];
                $document = $database->selectCollection('Users')->findOne($filter);
        
                // Vérifie si l'utilisateur à été trouvé
                if($document){
                    // Vérifie si le mot de passe est correct
                    if(password_verify($password, $document->password)){
                        // Démarre une session pour l'utilisateur
                        $_SESSION["pseudo"] = $pseudo;
                        $_SESSION["role"] = $document->role;
                        // Redirige l'tilisiateur
                        header('Location: /index');
                        exit();
                    }
                    else{
                        // Affiche un message d'erreur
                        $erreur = "Mot de passe incorrect.";
                    }
                }
                else{
                    // Affiche un message d'erreur
                    $erreur = "Utilisateur non trouvé.";
                }
            }
            else{
                // Affiche un message d'erreur
                $erreur = "Veuillez remplir tous les champs.";
            }
        }
    }

    public static function showInfo($pseudo){
        $database = MongoDatabaseConnectionService::get();
        $filter = ["pseudo" => $pseudo];
        $document = $database->selectCollection('Users')->findOne($filter);
        return $document;
    }

    public static function addBookLibrary(){
        $isbn = $_POST['isbn'];
        $database = MongoDatabaseConnectionService::get();
        $update = $database->selectCollection('Users')
            ->updateOne(
                ['pseudo' => $_SESSION['pseudo']],
                [
                    '$addToSet' => [
                        'library' => $isbn
                    ]
                ]);
                header('Location: /index');
                exit();
        return $update;
    }

    public static function addBookWishList(){
        $isbn = $_POST['isbn'];
        $database = MongoDatabaseConnectionService::get();
        $update = $database->selectCollection('Users')
            ->updateOne(
                ['pseudo' => $_SESSION['pseudo']],
                [
                    '$addToSet' => [
                        'wishlist' => $isbn
                    ]
                ]);
                header('Location: /index');
                exit();
        return $update;
    }

    public static function showLibrary($pseudo){
        $database = MongoDatabaseConnectionService::get();
        $userscollection = $database->selectCollection("Users");

        $pipeline = [
            [
                '$match'=>[
                    "pseudo" => $pseudo,
                ]
            ],
            [
                '$lookup' => [
                    "from"=> "Books",
                    "localField"=> "library",
                    "foreignField"=> 'isbn',
                    "as"=> "library",
                ]
            ]
        ];
        $result = $userscollection->aggregate($pipeline);
        /** @var Cursor $result */
        $documents = $result->toArray();

        if(count($documents) === 0) {
            // Utilisateur non trouvé
            return [];
        }

        return $documents[0]->library;
    }

    public static function showWishList($pseudo){
        $database = MongoDatabaseConnectionService::get();
        $userscollection = $database->selectCollection("Users");

        $pipeline = [
            [
                '$match'=>[
                    "pseudo" => $pseudo,
                ]
            ],
            [
                '$lookup' => [
                    "from"=> "Books",
                    "localField"=> "wishlist",
                    "foreignField"=> 'isbn',
                    "as"=> "wishlist",
                ]
            ]
        ];
        /** @var Cursor $result */
        $result = $userscollection->aggregate($pipeline);

        $documents = $result->toArray();

        if(count($documents) === 0) {
            // Utilisateur non trouvé
            return [];
        }

        return $documents[0]->wishlist;
    }

    public static function deleteBookLibrary(){
        $database = MongoDatabaseConnectionService::get();
        $isbn = $_POST['isbn']; 
        $update = $database->selectCollection('Users')
            ->updateOne(
                ['pseudo' => $_SESSION['pseudo']],
                [
                    '$pull'=>[
                        'library' => $isbn
                    ]
                ]);
            header('Location: /profil.php');
            exit();
            return $update;
    }

    public static function deleteBookWishlist(){
        $database = MongoDatabaseConnectionService::get();
        $isbn = $_POST['isbn']; 
        $update = $database->selectCollection('Users')
            ->updateOne(
                ['pseudo' => $_SESSION['pseudo']],
                [
                    '$pull'=>[
                        'wishlist' => $isbn
                    ]
                ]);
            header('Location: /profil.php');
            exit();
            return $update;
    }

    public static function removeWhishlistToMoveLibrary(){
        $isbn = $_POST['isbn'];
        $database = MongoDatabaseConnectionService::get();
        $result = $database->selectCollection('Users')
            ->updateOne(
                ['pseudo' => $_SESSION['pseudo']],
                [
                    '$addToSet' => [
                        'library' => $isbn
                    ],
                    '$pull'=>[
                        'wishlist' => $isbn
                    ]
                ]);
            header('Location: /profil.php');
            exit();
            return $result;
    }

    public static function showUsers(){
        $result = [];

        /**
         * @var MongoDB\Driver\Cursor
         */
        $selectAll = MongoDatabaseConnectionService::get()
            ->selectCollection('Users')
            ->find();
            
        foreach($selectAll as $document) {
            $result[] = $document;
        }
        return $result;

    }

    public static function deleteUser($pseudo){
        $database = MongoDatabaseConnectionService::get()
            ->selectCollection('Users');
        $result = $database->deleteOne(['pseudo' => $pseudo]);
        header('Location: /dashboard.php');
        exit();
        return $result;
    }

    public static function updateUser($pseudo){
        $database = MongoDatabaseConnectionService::get();
        $update = $database->selectCollection('Users')
            ->updateOne(
                    ['pseudo' => $pseudo],
                    [
                        '$set' => [
                            'lastname' => $_POST['lastname'],
                            'firstname' => $_POST['firstname'],
                            'pseudo' => $_POST['pseudo'],
                            'email' => $_POST['email']
                        ]
                    ]);
                header('Location: /dashboard.php');
                exit();
                return $update;
    }
}