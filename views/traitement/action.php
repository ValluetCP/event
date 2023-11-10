<?php
session_start();
// require_once "../../models/classModel.php";
require_once "../../models/userModel.php";
require_once "../../models/eventModel.php";
require_once "../../models/categorieModel.php";
require_once "../../models/bookModel.php";



// ------------------ USER ------------------//


// Afficher la Liste des utilisateurs - SELECT ALL
// User::findAllUser();
// return $userList;
// User::findUserById


// Ajouter un utilisateur  - INSERT INTO
// inscription.php
if(isset($_POST['register'])){
    // $statut = htmlspecialchars($_POST['statut']);
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $mdp = htmlspecialchars($_POST['mdp']);
    // $2y$10$g4tOfTKgXZ4fKgKDC5QQROV0Qg5.VgJo8Qy2fjxCFdIL9JG3DWBSq
    // $2y$10$8RvIgBpQrf8H8rTk94Cp3eaaubQZiwDC76/BC4rcbkC
    $password = password_hash($mdp, PASSWORD_DEFAULT);
    
    // apeler la methode inscription de la classe User
    // User::addUser($statut,$nom,$prenom,$pseudo,$email,$password,$role);
    User::addUser($nom,$prenom,$pseudo,$email,$password);
    
}


// Se connecter - SELECT BY
// connexion.php
if(isset($_POST['login'])){
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $password = htmlspecialchars($_POST['password']);

   // apeler la methode connexion de la classe User 
   User::connexion($pseudo,$password);
}


// Changer et modifier des infos utilisateur  - UPDATE
// si le client souhaite modifier ses infos personnels depuis son profil

if (isset($_POST['update_user'])) {
    // $statut = htmlspecialchars($_POST['statut']);
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    // $mdp = htmlspecialchars($_POST['mdp']);
    // $password = password_hash($mdp, PASSWORD_DEFAULT);
    // $role = htmlspecialchars($_POST['role']);

    // apeler la methode inscription de la classe User
    User::updateUserById($nom,$prenom,$pseudo,$email);

}


// METHOD GET


if (isset($_GET['id_user_delete'])) {
    // identifiant du user
    $id = $_GET['id_user_delete'];
    // appel de la methode deleteUserById
    $user = User::deleteUserById($id);
}


// ------------------ EVENT ------------------//


//  Afficher la Liste des évènements - SELECT ALL
// Event::findAllEvent();
// return $eventList;
// Event::findEventById($id);

// Ajouter un évènement  - INSERT INTO 
// inscription.php
if(isset($_POST['add_event'])){
    $titre = htmlspecialchars($_POST['titre']);
    // $duree = htmlspecialchars($_POST['duree']);
    $prix = htmlspecialchars($_POST['prix']);
    $resume = htmlspecialchars($_POST['resume']);
    // $nbr_place = htmlspecialchars($_POST['nbr_place']);
    $dateEvent = htmlspecialchars($_POST['date_event']);
    $nbrPlace = htmlspecialchars($_POST['nbr_place']);
    $categorie_id = htmlspecialchars($_POST['categorie']);

    // apeler la methode inscription de la classe Event
    Event::addEvent($titre,$prix,$resume,$dateEvent,$nbrPlace,$categorie_id);
    // cette syntaxe uniquement pour appeler les méthodes static.
    // la méthode addEvent étant static donc on utilise le nom de la classe suivi de "::" ensuite le nom de la méthode qui est addEvent.

}


// ADMIN - Changer et modifier des infos du site - UPDATE

if (isset($_POST['update_event'])) {
    // Pour les id se référer au name du formulaire
    $id = htmlspecialchars($_POST['id_evenement']);
    $titre = htmlspecialchars($_POST['titre']);
    // $duree = htmlspecialchars($_POST['duree']);
    $prix = htmlspecialchars($_POST['prix']);
    $resume = htmlspecialchars($_POST['resume']);
    $dateEvent = htmlspecialchars($_POST['date_event']);
    $nbrPlace = htmlspecialchars($_POST['nbr_place']);
    $categorie_id = htmlspecialchars($_POST['categorie_id']);

    // apeler la methode inscription de la classe User
    Event::updateEventById($id,$titre,$prix,$resume,$dateEvent,$nbrPlace,$categorie_id);

    
    // CALCUL TARIF
}


// METHOD GET


if (isset($_GET['id_event_delete'])) {
    // identifiant du event
    $id = $_GET['id_event_delete'];
    // appel de la methode deleteEventById
    $event = Event::deleteEventById($id);
}






// ------------------ CATEGORIE ------------------//


//  Afficher la Liste des catégories - SELECT ALL
// Categorie::findAllCategorie();
// return $categorieList;
// findCategorieById

// Ajouter une catégorie  - INSERT INTO 
// add_categorie.php
// categorieModel.php
if(isset($_POST['add_categorie'])){
    $categorieName = htmlspecialchars($_POST['categorie_name']);

    // apeler la methode inscription de la classe Event
    Categorie::addCategorie($categorieName);

}



// ADMIN - Changer et modifier des infos du site - UPDATE

if (isset($_POST['update_categorie'])) {
    $id = htmlspecialchars($_POST['id_categorie']);
    $categorieName = htmlspecialchars($_POST['categorie_name']);

    // apeler la methode inscription de la classe Categorie
    Categorie::updateCategorieById($id,$categorieName);

}


// METHOD GET


if (isset($_GET['id_categorie_delete'])) {
    // identifiant du categorie
    $id = $_GET['id_categorie_delete'];
    // appel de la methode deleteCategorieById
    $categorie = Categorie::deleteCategorieById($id);
}



// ------------------ BOOK - Réservation ------------------//


//  Afficher la Liste des réservations - SELECT ALL
// Event::findAllBook();
// return $bookList;
// Event::findBookById($id);


// Ajouter une réservation  - INSERT INTO
// event.php
if(isset($_POST['add_book'])){
    $idUser = $_SESSION['id_user'];
    $idEvent = htmlspecialchars($_POST['id_event']);
    $placeReserve = htmlspecialchars($_POST['place_reserve']);
    
    // apeler la methode book de la classe User
    Book::addBook($idUser,$idEvent,$placeReserve);
}




