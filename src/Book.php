<?php

class Book {
    protected $id;
    protected $titre;
    protected $resume;
    protected $auteur;
    protected $format;
    protected $editeur;
    protected $genre;
    protected $nb_pages;
    protected $isbn;
    protected $date_de_publication;
    protected $image;


    public function __construct($id, $titre, $resume, $auteur, $format, $editeur, $genre, $nb_pages, $isbn, $date_de_publication, $image){
        $this->id = $id;
        $this->titre= $titre ;
        $this->resume = $resume;
        $this->auteur = $auteur;
        $this->format = $format;
        $this->editeur = $editeur;
        $this->genre = $genre;
        $this->nb_pages = $nb_pages;
        $this->isbn = $isbn;
        $this->image = $image;
        $this->date_de_publication = $date_de_publication;
    }



    public static function showAll(){
        $result = [];

        /**
         * @var MongoDB\Driver\Cursor
         */
        $selectAll = MongoDatabaseConnectionService::get()
            ->selectCollection('Books')
            ->find([], [
                'sort' => [
                    'titre' => 1
                ]
            ]);
            
        foreach($selectAll as $document) {
            $result[] = $document;
        }
        return $result;
    }

    public static function showBook($isbn){
        $result = MongoDatabaseConnectionService::get()
            ->selectCollection('Books')
            ->findOne(['isbn'=> $isbn]);
        return $result;
    }

    public static function deleteBook($isbn){
        $database = MongoDatabaseConnectionService::get()
            ->selectCollection('Books');
        $result = $database->deleteOne(['isbn' => $isbn]);
        header('Location: /dashboard.php');
        exit();
        return $result;
    }

    public static function createBook($titre, $resume, $auteur, $format, $editeur, $genre, $nb_pages, $isbn, $date_de_publication, $image){
        $collection = MongoDatabaseConnectionService::get()->selectCollection('Books');
        if(isset($_POST['create'])) {
            $data= [
                'titre'=> $titre,
                'auteur'=>$auteur,
                'editeur'=> $editeur,
                'date_de-publication'=> $date_de_publication,
                'format'=> $format,
                'genre'=> $genre,
                'nb_pages'=>$nb_pages,
                'isbn'=> $isbn,
                'resume'=> $resume,
            ];

            if(isset($_FILES['image'])) {
                // Récupérer le fichier image
                $image = $_POST['titre'];

                // Remplacer les espaces par des underscores dans le nom de l'image
                $image = str_replace(' ', '_', $image);
                $image = strtolower($image);
                $data['image'] = $image.'.jpg';


                if(!move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/images/manga/'.$data['image'])) {
                    throw new Exception("Failed to upload file. " . $data['image']);
                }
                
            }

            $result = $collection->insertOne($data);
            if($result->getInsertedCount()> 0) {
                header('Location: /dashboard.php');
                exit();
                return $result;

            } else {
                echo "Failed to create Article";
            }
        }
        
    }

    public static function updateBook($isbn){
        $database = MongoDatabaseConnectionService::get();
        $update = $database->selectCollection('Books')
            ->updateOne(
                    ['isbn' => $isbn],
                    [
                        '$set' => [
                            'titre' => $_POST['titre'],
                            'auteur' => $_POST['auteur'],
                            'editeur' => $_POST['editeur'],
                            'date_de_publication' => $_POST['date_de_publication'],
                            'format' => $_POST['format'],
                            'genre' => $_POST['genre'],
                            'nb_pages' => $_POST['nb_pages'],
                            'isbn' => $_POST['isbn'],
                            'resume' => $_POST['resume'],
                        ]
                    ]);

                header('Location: /dashboard.php');
                exit();
                return $update;
    }

}