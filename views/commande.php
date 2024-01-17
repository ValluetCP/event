<?php
include_once "./inc/header.php";
include_once "./inc/nav.php";
include_once "./inc/functions.php";
require_once "../models/bookModel.php";


?>

<h1>Félicitation ! Votre commande a bien été enregistrée !</h1>

<?php
// commande.php

// Inclure les fichiers nécessaires
require_once "../models/bookModel.php";

// Récupérez l'ID de l'utilisateur depuis la session (ajustez selon votre structure de session)
$userId = $_SESSION['id_user'];

// Parcourez chaque élément du panier et insérez-le dans la base de données
foreach ($_SESSION['reservation'] as $item) {
    $eventId = $item['events']['id_evenement'];
    $quantity = $item['quantite'];

    // Utilisez la méthode d'insertion que vous avez définie dans bookModel.php
    $insertResult = Book::insertReservation($userId, $eventId, $quantity);

    // Gérez le résultat de l'insertion (par exemple, affichez un message d'erreur si nécessaire)
    if (!$insertResult) {
        echo "Erreur lors de l'insertion de la réservation pour l'événement ID $eventId.";
    }
}

// Effacez le panier après l'insertion dans la base de données (vous pouvez ajuster cette étape selon votre logique)
unset($_SESSION['reservation']);
unset($_SESSION["nombre"]);

// ... Le reste de votre code pour la page de confirmation de commande ...
?>
<a href="./home.php" class="btn btn-outline-warning mt-3 mb-5">Retour à l'accueil</a>