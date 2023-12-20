<?php
include_once "./inc/header.php";
include_once "./inc/nav.php";
// Inclure le fichier contenant la classe Book
require_once "../models/bookModel.php";
require_once "../models/eventModel.php"; // Ajoutez cette ligne pour inclure la classe Event

// Vérifier si les données nécessaires sont disponibles
if (isset($_SESSION['id_user'], $_GET['event'], $_POST['place_reserve'])) {
    // Appeler la fonction addPanier de la classe Book
    Book::addPanier($_SESSION['id_user'], $_GET['event'], $_POST['place_reserve']);
}

// Récupérer les événements dans le panier
if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
    foreach ($_SESSION['panier'] as $item) {
        // Récupérer les détails de l'événement en utilisant l'ID de l'événement
        $eventId = $item[1];
        $eventDetails = Event::findEventById($eventId);

        // Afficher le titre de l'événement
        echo "Titre de l'événement : " . $eventDetails['titre'] . "<br>"."Catégorie : " . $eventDetails['categorie_name']."<br>"."Prix : " . $eventDetails['prix']. "<br><br>";
        // Vous pouvez afficher d'autres détails de l'événement si nécessaire
    }
}

// ... Le reste de votre code panier.php ...
?>
