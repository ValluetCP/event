<?php
// Page - Affiche un évènement (côté CLIENT)
// session_start();
include_once "./inc/header.php";
include_once "./inc/nav.php";
include_once "./inc/functions.php";
require_once "../models/eventModel.php";
require_once "../models/bookModel.php";
require_once "../models/userModel.php";

// $listEvent = Event::findAllEvent();
$userReservation = User::userReservation($_GET['event']);
$eventId = $_GET['event'];
$ficheEvent = Event::findEventById($eventId);
$totalPlacesReservees = Book::calculReservation($eventId);
$placesDisponibles = $ficheEvent['nbr_place'] - $totalPlacesReservees;
$currentDate = date('Y-m-d H:i:s'); // Date actuelle au format SQL (YYYY-MM-DD HH:MM:SS)

// Ajoutez cette ligne pour récupérer l'historique des réservations de l'utilisateur pour cet événement
$userPreviousReservations = Book::getUserReservationsForEvent($_SESSION['id_user'], $eventId);
$userReservationIds = Book::userReservationIds($_SESSION['id_user']);  // Utilisez la nouvelle méthode
?>



<!-- PAGE "EVENT" - côté ADMIN -->

<div class="container">

    <h2><?= ucfirst($ficheEvent['titre']); ?></h2>

    <div><img src="./asset/img_event/<?= $ficheEvent['image']; ?>" alt=""></div>
    <p>Catégorie : <?= $ficheEvent['categorie_name']; ?></p>
    <p>Titre : <?= $ficheEvent['titre']; ?></p>
    <p>Date : <?= date('d-m-Y', strtotime($ficheEvent['date_event'])); ?></p>
    <p>Résumé : <?= $ficheEvent['resume']; ?></p>
    <p>Tarif : <?= $ficheEvent['prix']; ?></p>
    <p>Nombre de places disponible : <?= $placesDisponibles; ?></p>
 

    <!-- Si le rôle est ADMIN ... -->
    <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == "admin"){ ?>
        
        <p>Nombre de places total: <?= $ficheEvent['nbr_place']; ?></p>
        <p>Nombre de places réservées : <?= $totalPlacesReservees; ?></p>
                    
        <!-- ...impossible de réserver, retourne à la liste des évènements -->
        <a class="btn btn-outline-warning" href="./list_event_admin.php">Revenir à la liste des évènements</a>

    
    <?php } ?>

    <?php

    // Ajoutez ces lignes pour récupérer la catégorie de l'événement en cours
    $eventCategory = $ficheEvent['categorie_id'];

    // Ajoutez ces lignes pour trouver tous les événements associés à la catégorie
    $associatedEvents = Event::findEventsByCategory($eventCategory);

    ?>
    <!-- <?php var_dump($eventCategory); ?> -->
    <!-- <?php var_dump($associatedEvents); ?> -->
    <!-- Affichez les événements associés sans l'événement sélectionné-->
    <h3>Événements associés à la catégorie </h3>
    <ul>
        <?php foreach ($associatedEvents as $event) { ?>
            <?php if ($event['id_evenement'] != $eventId) { ?>
                <li><?= $event['titre']; ?> - <?= $event['date_event']; ?> - <?= $ficheEvent['categorie_name']; ?></li>
            <?php } ?>
        <?php } ?>
    </ul>
</div>


<?php
include_once "./inc/footer.php";
?>

<!-- 
    * Notez que cette modification n'empêchera pas complètement l'utilisateur de choisir plus de places disponibles. Vous devez également gérer cela du côté du serveur dans le fichier de traitement du formulaire (action.php). Assurez-vous de vérifier le nombre de places sélectionnées par l'utilisateur avant d'effectuer l'insertion dans la base de données pour éviter toute manipulation malveillante.
 -->
