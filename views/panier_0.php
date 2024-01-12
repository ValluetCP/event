<?php
include_once "./inc/header.php";
include_once "./inc/nav.php";
include_once "./inc/functions.php";
// Inclure le fichier contenant la classe Book
require_once "../models/bookModel.php";
require_once "../models/eventModel.php"; // Ajoutez cette ligne pour inclure la classe Event

// Vérifier si les données nécessaires sont disponibles
// if (isset($_SESSION['id_user'], $_GET['event'], $_POST['place_reserve'])) {
    
//     $tab = [$idUser,$eventId,$placeReserve];
//     $_SESSION['panier'][]= $tab;

//     // rediriger vers la page list_user.php
//     // header("Location: http://localhost/event/views/panier_0.php");
//     // Appeler la fonction addPanier de la classe Book
//     // Book::addPanier($_SESSION['id_user'], $_GET['event'], $_POST['place_reserve']);
// }

// Récupérer les événements dans le panier
if (isset($_SESSION['reservation']) && !empty($_SESSION['reservation'])) {
    // Utiliser un tableau associatif pour éviter les doublons
    // $panierItems = array();
    // $totalMontant = 0;

    $prixTotal = 0;
    foreach ($_SESSION['reservation'] as $item) {
        // Récupérer les détails de l'événement en utilisant l'ID de l'événement
        $eventId = $item["events"]["id_evenement"];
        $eventDetails = Event::findEventById($eventId);
            $prixTotalEvent = $eventDetails['prix'] * $item["quantite"];
            $prixTotal += $prixTotalEvent;
            ?>
        
            <a href="./event.php?event=<?= $eventDetails['id_evenement']; ?>">
                <div>
                    <p>Titre de l'événement :<?= $eventDetails['titre']; ?></p>
                    <p>Catégorie :<?= $eventDetails['categorie_name']; ?></p>
                    <p>Prix unitaire :<?= $eventDetails['prix']; ?></p>
                    <p>Quantité :<?= $item["quantite"]; ?></p>
                    <p>Prix total :<?= $prixTotalEvent; ?></p><br><br>
                </div>
            </a>
            
    <?php 
    } 

    // Afficher le montant total en bas de la page
    echo "Montant total : " . $prixTotal. "<br>";
?>

<?php
    

}
    // unset($_SESSION["reservation"]);
    // unset($_SESSION["nombre"]);
?>
