<?php
session_start();
// require_once "../../models/classModel.php";
require_once "../../models/userModel.php";
require_once "../../models/eventModel.php";
require_once "../../models/categorieModel.php";
require_once "../../models/bookModel.php";
require_once "../inc/functions.php";


// require_once "../add_book.php";



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


// -- METHOD GET -- //

// Supprimer définitivement un user de la bdd

if (isset($_GET['id_user_delete'])) {
    // identifiant du user
    $id = $_GET['id_user_delete'];
    // appel de la methode deleteUserById
    $user = User::deleteUserById($id);
}


// Désactiver un user

if (isset($_GET['id_user_desactive'])) {
    // identifiant du user
    $id = $_GET['id_user_desactive'];
    // appel de la methode desactiveUserById
    $user = User::desactiveUserById($id);
}


// Activer un user

if (isset($_GET['id_user_active'])) {
    // identifiant du user
    $id = $_GET['id_user_active'];
    // appel de la methode activeUserById
    $user = User::activeUserById($id);
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

     // ----------  RECUPERER L'IMAGE ---------- //

    /*objectif : 
        - récupérer tous les fichiers (images) qui sont dans le formulaire.
        - copie l'image et la stock dans un endroit temporaire sur le serveur
        - on lui donnera par la suite le chemin d'accès à notre dossier
    */

    $imgName = $_FILES ['image']['name']; // nom de l'image
    // la 1ère valeur 'image' (récupéré dans le formulaire)
    // la 2ème valeur 'name' (toujours la même, ne change pas)

    $tmpName = $_FILES ['image']['tmp_name']; // localisation temporaire sur le server


    // ----------  DESTINATION DE L'IMAGE ---------- //

    //1
    $destination = $_SERVER['DOCUMENT_ROOT'].'/event/views/asset/img_event/'.$imgName; // destination finale de mon image
    // $_SERVER['DOCUMENT_ROOT'] + chemin du dossier image
    //['DOCUMENT_ROOT'] : syntaxe qui veut dire pointe à la racine du serveur, si on n'indique pas le chemin, il s'arrêra au dossier 'htdocs'

    // $_SERVER['DOCUMENT_ROOT'] pointe à la racine du server c'est à dire le dossier principal (dossier racine)
    
    //2
    //echo $destination;
    move_uploaded_file($tmpName,$destination);
    // permet de prendre l'image et de la mettre dans le dossier que l'on a pointé au dessus.
    // 1er paramètre, la destination temporaire où a été stocker le fichier temporairement
    // 2ème paramètre, c'est la destination que l'on souhaite


    // ----------  APPEL DE LA METHOD ---------- //

    // apeler la methode inscription de la classe Event
    Event::addEvent($titre,$prix,$resume,$dateEvent,$nbrPlace,$categorie_id,$imgName);
    // cette syntaxe uniquement pour appeler les méthodes static.
    // la méthode addEvent étant static donc on utilise le nom de la classe suivi de "::" ensuite le nom de la méthode qui est addEvent.

}


// ADMIN - Changer et modifier des infos du site - UPDATE

if (isset($_POST['update_event'])) {
    // var_dump($_FILES);die;
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


// -- METHOD GET -- //

// Supprimer définitivement un évènement 

if (isset($_GET['id_event_delete'])) {
    // identifiant du event
    $id = $_GET['id_event_delete'];
    // appel de la methode deleteEventById
    $event = Event::deleteEventById($id);
}


// Désactiver un évènement 

if (isset($_GET['id_event_desactive'])) {
    // identifiant du event
    $id = $_GET['id_event_desactive'];
    // appel de la methode desactiveEventById
    $event = Event::desactiveEventById($id);
}


// Activer un évènement 

if (isset($_GET['id_event_active'])) {
    // identifiant du event
    $id = $_GET['id_event_active'];
    // appel de la methode activeEventById
    $event = Event::activeEventById($id);
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

// Requête pour récupérer l'historique des réservations de l'utilisateur pour cet événement
// Book::getUserPreviousReservations($_SESSION['id_user'], $ficheEvent['id_evenement']);






// Ajouter une réservation  - INSERT INTO
// event.php
// if (isset($_POST['add_book'])) {
//     $idUser = $_SESSION['id_user'];
//     $idEvent = htmlspecialchars($_POST['id_event']);
//     $placeReserve = htmlspecialchars($_POST['place_reserve']);

//     Book::addBook($idUser, $idEvent, $placeReserve);
// }






// event.php
// if (isset($_POST['add_panier'])) {
//     $idUser = $_SESSION['id_user'];
//     $idEvent = htmlspecialchars($_POST['id_event']);
//     $placeReserve = htmlspecialchars($_POST['place_reserve']);

//     Book::addPanier($idUser, $idEvent, $placeReserve);
// }

// event.php
// var_dump($_POST);
// if (isset($_POST['valider_panier'])) {
//     $idUser = $_SESSION['id_user'];
//     $idEvenement = htmlspecialchars($_POST['id_evenement']);
//     $titre = htmlspecialchars($_POST['titre']);
//     $categorieName = htmlspecialchars($_POST['categorie_name']);
//     $prix = htmlspecialchars($_POST['prix']);
//     $quantity = htmlspecialchars($_POST['quantity']);
//     $price = htmlspecialchars($_POST['price']);

//     Book::validerPanier($idUser,$idEvenement,$titre,$categorieName,$prix,$quantity,$price);
// }

if (isset($_POST['valider_panier'])) {
    
    debug($_SESSION);die;
    $idUser = $_SESSION['id_user'];
    $idEvent = htmlspecialchars($_POST['id_evenement']);
    $placeReserve = htmlspecialchars($_POST['quantity']);

    Book::validerPanier($idUser, $idEvent, $placeReserve);
}


// Met à jour la quantité de places réservées en ajoutant la nouvelle quantité à l'ancienne.
if (isset($_POST['add_another_book'])) {
    $idUser = $_SESSION['id_user'];
    $eventId = htmlspecialchars($_POST['id_event']);
    // $idEvent = htmlspecialchars($_POST['id_event']);
    $placeReserve = htmlspecialchars($_POST['place_reserve']);

    Book::addAnotherBook($idUser, $eventId, $placeReserve);
    // Cette méthode commence par vérifier s'il existe déjà une réservation pour cet utilisateur et cet événement en appelant getUserPreviousReservations. Si une réservation existe, elle met à jour la quantité de places réservées en ajoutant la nouvelle quantité à l'ancienne. Sinon, elle appelle simplement la méthode addBook pour créer une nouvelle réservation.
}


// une méthode pour récupérer toutes les réservations d'un utilisateur pour un événement spécifique, triées par date de réservation
// if (isset($_POST['add_more_book'])) {
//     $userId = $_SESSION['id_user'];
//     $eventId = htmlspecialchars($_POST['id_event']);

//     Book::getUserReservationsForEvent($userId, $eventId);
    
// }

if (isset($_POST['add_book2'])) {
    // Récupérez les données du formulaire
    $eventId = $_POST['id_event'];
$placesToReserve = $_POST['place_reserve'];

// Effectuez la réservation en utilisant la méthode makeReservation de la classe Book
$reservationSuccess = Book::makeReservation($_SESSION['id_user'], $eventId, $placesToReserve);

// Vérifiez si la réservation a réussi
if ($reservationSuccess) {
    // Définissez le message de confirmation dans la session
    $_SESSION['reservation_confirmation'] = "Votre réservation a été confirmée avec succès!";
} else {
    // Gérez le cas où la réservation a échoué (par exemple, places épuisées)
    $_SESSION['reservation_error'] = "Désolé, la réservation a échoué. Veuillez réessayer.";
}

// Redirigez l'utilisateur vers la page de détails de l'événement avec un paramètre de confirmation
header("Location: ./event.php?event=$eventId&reservation_confirmation=" . ($reservationSuccess ? '1' : '0'));
exit();
}


// Requête pour récupérer l'historique des réservations de l'utilisateur pour cet événement
if (isset($_POST['historique_book'])) {
    $userId = $_SESSION['id_user'];
    $eventId = htmlspecialchars($_POST['id_event']);

    Book::getUserPreviousReservations($userId, $eventId);
    
}


// -- METHOD GET -- //

// Supprimer définitivement un user de la bdd

if (isset($_GET['id_book_delete'])) {
    // identifiant du book
    $id = $_GET['id_book_delete'];
    // appel de la methode deleteBookById
    $book = Book::deleteBookById($id);
}


// Désactiver un book

if (isset($_GET['id_book_desactive'])) {
    // identifiant du book
    $id = $_GET['id_book_desactive'];
    // appel de la methode desactiveBookById
    $book = Book::desactiveBookById($id);
}


// Activer un book

if (isset($_GET['id_book_active'])) {
    // identifiant du book
    $id = $_GET['id_book_active'];
    // appel de la methode activeBookById
    $book = Book::activeBookById($id);
}



// -- CODE SECURITE : limiter le nombre de choix de réservation -- //

// if (isset($_POST['add_book'])) {
//     $idUser = $_SESSION['id_user'];
//     $idEvent = htmlspecialchars($_POST['id_event']);
//     $placeReserve = htmlspecialchars($_POST['place_reserve']);

//     // Vérification du nombre de places disponibles avant d'effectuer l'insertion
//     $totalPlacesReservees = Book::calculReservation($idEvent);
//     $placesDisponibles = Event::findEventById($idEvent)['nbr_place'] - $totalPlacesReservees;

//     if ($placeReserve > 0 && $placeReserve <= $placesDisponibles && $placeReserve <= 4) {
//         // Le nombre de places sélectionnées est valide, effectuez l'insertion dans la base de données
//         Book::addBook($idUser, $idEvent, $placeReserve);

//         // Redirection ou autre traitement après la réservation réussie
//         header("Location: http://localhost/event/views/list_book.php");
//         exit();
//     } else {
//         // Le nombre de places sélectionnées n'est pas valide, gestion de l'erreur
//         echo "Erreur : Le nombre de places sélectionnées n'est pas valide.";
//     }
// }


// -- CODE SECURITE :  -- //

// if (isset($_POST['add_book'])) {
//     // Récupération des données du formulaire
//     $idUser = $_SESSION['id_user'];
//     $idEvent = htmlspecialchars($_POST['id_event']);
//     $placeReserve = htmlspecialchars($_POST['place_reserve']);

//     // Vérification du nombre de places disponibles avant d'effectuer l'insertion
//     $totalPlacesReservees = Book::calculReservation($idEvent);
//     $placesDisponibles = $ficheEvent['nbr_place'] - $totalPlacesReservees;

//     if ($placeReserve > 0 && $placeReserve <= $placesDisponibles) {
//         // Le nombre de places sélectionnées est valide, effectuez l'insertion dans la base de données
//         Book::addBook($idUser, $idEvent, $placeReserve);

//         // Redirection ou autre traitement après la réservation réussie
//         header("Location: page_de_redirection.php");
//         exit();
//     } else {
//         // Le nombre de places sélectionnées n'est pas valide, gestion de l'erreur
//         echo "Erreur : Le nombre de places sélectionnées n'est pas valide.";
//     }
// }


if (isset($_POST['add_panier'])) {
    extract($_POST);

        $quantite = $place_reserve ?: 1;
        $events = Event::findEventById($id_event);

        if( !array_key_exists('reservation', $_SESSION) ){
            $_SESSION['reservation'] = [];
        }

       	$panier = $_SESSION['reservation'];

        $eventsDejaDansPanier = false;
        foreach ($panier as $indice => $value) {
            if ($events['id_evenement'] == $value["events"]['id_evenement']) {                
                $panier[$indice]["quantite"] += $quantite;
                $eventsDejaDansPanier = true;
                break;  // pour sortir de la boucle foreach
            }
        }

        if (!$eventsDejaDansPanier) {
            $panier[] = ["quantite" => $quantite, "events" => $events];  // on ajoute une value au panier => $panier est un array d'array
        }

		$_SESSION['reservation'] = $panier; // je remets $panier dans la session, à l'indice 'reservation'

        $nb = 0;

        foreach ($panier as $value) {
            $nb += $value["quantite"];
        }

        $_SESSION["nombre"] = $nb;
        echo $nb;


        // création du panier dans la session
        // header("Location: http://localhost/event/views/panier_0.php");
}


// if (isset($_POST['add_panier'])) {
//     $idUser = $_SESSION['id_user'];
//     $idEvent = htmlspecialchars($_POST['id_event']);
//     $placeReserve = htmlspecialchars($_POST['place_reserve']);

//     Book::addPanier($idUser, $idEvent, $placeReserve);
// }