<?php
class BookController {

    public function showAll() {
        return Book::showAll();
    }

    public function showBook() {
        return Book::showBook($_GET['isbn']);
    }

    public function deleteBook(){
        return Book::deleteBook($_POST['isbn']);
    }

    public function updateBook(){
        return Book::updateBook($_GET['isbn']);
    }

    public function createBook(){
        return Book::createBook($_POST['titre'],$_POST['resume'], $_POST['auteur'], $_POST['format'], $_POST['editeur'], $_POST['genre'], $_POST['nb_pages'], $_POST['isbn'], $_POST['date_de_publication'], $_POST['image']);
    }
}