<?php

class UserController{
    public function register(){
        return User::register($_POST['firstname'],$_POST['lastname'], $_POST['pseudo'], $_POST['email'], $_POST['password']);
    }

    public function connect(){
        return User::connect( $_POST['pseudo'], $_POST['password'], $_GET['role']);
    }

    public function showInfo(){
        return User::showInfo($_GET['pseudo']);
    }

    public function addBookLibrary(){
        return User::addBookLibrary();
    }

    public function addBookWishList(){
        return User::addBookWishList();
    } 

    public function showLibrary(){
        return User::showLibrary($_GET['pseudo']);
    }

    public function showWishList(){
        return User::showLibrary($_GET['pseudo']);
    }

    public function deleteBookLibrary(){
        return User::deleteBookLibrary($_POST['isbn']);
    }

    public function deleteBookWishlist(){
        return User::deleteBookWishlist($_POST['isbn']);
    }

    public function removeWhishlistToMoveLibrary(){
        return User::removeWhishlistToMoveLibrary($_POST['isbn']);
    }

    public function showUsers(){
        return User::showUsers();
    }

    public function deleteUser(){
        return User::deleteUser($_POST['pseudo']);
    }

    public function updateUser(){
        return User::updateUser($_GET['pseudo']);
    }

}