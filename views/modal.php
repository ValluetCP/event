<?php
// Page - Affiche un évènement (côté CLIENT)
// session_start();
include_once "./inc/header.php";
include_once "./inc/nav.php";
include_once "./inc/functions.php";
require_once "../models/eventModel.php";
require_once "../models/bookModel.php";
require_once "../models/userModel.php";

// $userReservation = User::userReservation($_GET['event']);
// $eventId = $_GET['event'];
// $ficheEvent = Event::findEventById($eventId);
// $totalPlacesReservees = Book::calculReservation($eventId);
// $placesDisponibles = $ficheEvent['nbr_place'] - $totalPlacesReservees;
$currentDate = date('Y-m-d H:i:s'); // Date actuelle au format SQL (YYYY-MM-DD HH:MM:SS)

// Ajoutez cette ligne pour récupérer l'historique des réservations de l'utilisateur pour cet événement
// $userPreviousReservations = Book::getUserPreviousReservations($_SESSION['id_user'], $eventId);
// $userPreviousReservations = Book::getUserReservationsForEvent($_SESSION['id_user'], $eventId);
$userReservationIds = Book::userReservationIds($_SESSION['id_user']);  // Utilisez la nouvelle méthode
?>

<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Pour cette évènement</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php
            // Ajoutez une requête pour récupérer l'historique des réservations de l'utilisateur pour cet événement
            $userPreviousReservations = Book::getUserPreviousReservations($_SESSION['id_user'], $ficheEvent['id_evenement']);

            if ($userPreviousReservations){
                ?>
                <p>Votre historique de réservations pour cet événement :</p>
                <ul>
                    <?php foreach ($userPreviousReservations as $reservation) { ?>
                        <li>Date de réservation : <?= date('d-m-Y H:i:s', strtotime($reservation['date_reservation'])); ?>, Quantité : <?= $reservation['place_reserve']; ?></li>
                    <?php } ?>
                </ul>
            <?php } else { ?>
                <p>Vous n'avez pas encore effectué de réservation pour cet événement.</p>
            <?php } ?>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Open second modal</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Modal 2</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Hide this modal and show the first with the button below.
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Back to first</button>
      </div>
    </div>
  </div>
</div>
<button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Open first modal</button>


<?php
include_once "./inc/footer.php";
?>