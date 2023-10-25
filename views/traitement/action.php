
<?php
// require_once "../../models/classModel.php";
require_once "../../models/userModel.php";
require_once "../../models/eventModel.php";
require_once "../../models/categorieModel.php";


// ------------------ USER ------------------//


// Afficher la Liste des utilisateurs - SELECT ALL
// User::findAllUser();
// return $userList;


// Ajouter un utilisateur  - INSERT INTO
// inscription.php
if(isset($_POST['register'])){
    $statut = htmlspecialchars($_POST['statut']);
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $mdp = htmlspecialchars($_POST['mdp']);
    $password = password_hash($mdp, PASSWORD_DEFAULT);
    $role = htmlspecialchars($_POST['role']);
    // var_dump($mdp);
    // var_dump($password);
    // apeler la methode inscription de la classe User
    User::addUser($statut,$nom,$prenom,$pseudo,$email,$password,$role);
    // cette syntaxe uniquement pour appeler les méthodes static.
    // la méthode inscription étant static donc on utilise le nom de la classe suivi de "::" ensuite le nom de la méthode qui est inscriptions.

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
    $id = htmlspecialchars($_POST['id_evenement']);
    $statut = htmlspecialchars($_POST['statut']);
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $mdp = htmlspecialchars($_POST['mdp']);
    $password = password_hash($mdp, PASSWORD_DEFAULT);
    $role = htmlspecialchars($_POST['role']);

    // apeler la methode inscription de la classe User
    User::updateUserById($id,$statut,$nom,$prenom,$pseudo,$email,$password,$role);

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
    $duree = htmlspecialchars($_POST['duree']);
    $prix = htmlspecialchars($_POST['prix']);
    $resume = htmlspecialchars($_POST['resume']);
    $nbr_place = htmlspecialchars($_POST['nbr_place']);
    $categorie_id = htmlspecialchars($_POST['categorie']);

    // apeler la methode inscription de la classe Event
    Event::addEvent($titre,$duree,$prix,$resume,$nbr_place,$categorie_id);
    // cette syntaxe uniquement pour appeler les méthodes static.
    // la méthode addEvent étant static donc on utilise le nom de la classe suivi de "::" ensuite le nom de la méthode qui est addEvent.

}


// ADMIN - Changer et modifier des infos du site - UPDATE

if (isset($_POST['update_event'])) {
    $id = htmlspecialchars($_POST['id']);
    $titre = htmlspecialchars($_POST['titre']);
    $duree = htmlspecialchars($_POST['duree']);
    $prix = htmlspecialchars($_POST['prix']);
    $resume = htmlspecialchars($_POST['resume']);
    $nbr_place = htmlspecialchars($_POST['nbr_place']);
    $categorie_id = htmlspecialchars($_POST['categorie_id']);

    // apeler la methode inscription de la classe User
    Event::updateEventById($id,$titre,$duree,$prix,$resume,$nbr_place,$categorie_id);

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
    $id = htmlspecialchars($_POST['id']);
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





