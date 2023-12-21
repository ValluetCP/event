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
    // Utiliser un tableau associatif pour éviter les doublons
    $panierItems = array();
    $totalMontant = 0;

    foreach ($_SESSION['panier'] as $item) {
        // Récupérer les détails de l'événement en utilisant l'ID de l'événement
        $eventId = $item[1];
        $eventDetails = Event::findEventById($eventId);

        // Récupérer le nombre de places réservées pour cet événement
        $placesReservees = $item[2];

        // Vérifier si l'événement est déjà dans le panier
        if (array_key_exists($eventId, $panierItems)) {
            // L'événement est déjà dans le panier, mettre à jour la quantité et le prix
            $panierItems[$eventId]['quantity'] += $placesReservees;
            $panierItems[$eventId]['price'] += $eventDetails['prix'] * $placesReservees;
        } else {
            // L'événement n'est pas encore dans le panier, l'ajouter
            $panierItems[$eventId] = array(
                'eventDetails' => $eventDetails,
                'quantity' => $placesReservees,
                'price' => $eventDetails['prix'] * $placesReservees
            );
        }

        // Ajouter le prix total de l'événement au total général
        $totalMontant += $panierItems[$eventId]['price'];
    }

    // Afficher les éléments du panier
    foreach ($panierItems as $itemId => $itemDetails) { ?>
        <a href="./event.php?event=<?= $itemDetails['eventDetails']['id_evenement']; ?>">
            <div>
                <p>Titre de l'événement :<?= $itemDetails['eventDetails']['titre']; ?></p>
                <p>Catégorie :<?= $itemDetails['eventDetails']['categorie_name']; ?></p>
                <p>Prix unitaire :<?= $itemDetails['eventDetails']['prix']; ?></p>
                <p>Quantité :<?= $itemDetails['quantity']; ?></p>
                <p>Prix total :<?= $itemDetails['price']; ?></p><br><br>
            </div>
        </a>
    <?php } 
    

    // Afficher le montant total en bas de la page
    echo "Montant total : " . $totalMontant . "<br>";
}

// ... Le reste de votre code panier.php ...
?>
</a>