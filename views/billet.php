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
$bookList = Book::findAllBookByIdUser();
$totalPlacesReservees = Book::calculReservation($eventId);
$placesDisponibles = $ficheEvent['nbr_place'] - $totalPlacesReservees;
$currentDate = date('Y-m-d H:i:s'); // Date actuelle au format SQL (YYYY-MM-DD HH:MM:SS)
?>

<div class="container">
    
    <h2><?= ucfirst($ficheEvent['titre']); ?></h2>

    <!-- <p>Identifiant : <?= $ficheEvent['id_evenement']; ?></p> -->

        <div><img src="./asset/img_event/<?= $ficheEvent['image']; ?>" alt=""></div>

        <p>Catégorie : <?= $ficheEvent['categorie_name']; ?></p>
        
        <p>Titre : <?= $ficheEvent['titre']; ?></p>

        <p>Date : <?= date('d-m-Y', strtotime($ficheEvent['date_event'])); ?></p>
        <p>Nombre de places réservées : <?= $totalPlacesReservees; ?></p>

</div>



<script>
    
</script>

<?php
include_once "./inc/footer.php";
?>

