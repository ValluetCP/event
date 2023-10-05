
<?php
// require_once "../../models/classModel.php";
require_once "../../models/userModel.php";
require_once "../../models/eventModel.php";


// ------------------ USER ------------------//


// Liste des utilisateurs
// User::findAllUser();


// Ajouter un utilisateur 
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

    // apeler la methode inscription de la classe User
    User::addUser($statut,$nom,$prenom,$pseudo,$email,$password,$role);
    // cette syntaxe uniquement pour appeler les méthodes static.
    // la méthode inscription étant static donc on utilise le nom de la classe suivi de "::" ensuite le nom de la méthode qui est inscriptions.

}


// Se connecter
// connexion.php
if(isset($_POST['login'])){
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $password = htmlspecialchars($_POST['password']);

   // apeler la methode connexion de la classe User 
   User::connexion($pseudo,$password);
}


// Changer et modifier des infos utilisateur
// si le client souhaite modifier ses infos personnels depuis son profil

if (isset($_POST['update_user'])) {
    $id = htmlspecialchars($_POST['id']);
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


// Ajouter un évènement 
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

    // apeler la methode inscription de la classe User
    Event::addEvent($statut,$nom,$prenom,$pseudo,$email,$password,$role);
    // cette syntaxe uniquement pour appeler les méthodes static.
    // la méthode inscription étant static donc on utilise le nom de la classe suivi de "::" ensuite le nom de la méthode qui est inscriptions.

}



