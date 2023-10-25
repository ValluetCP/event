<?php
// Page - Affiche un évènement (côté ADMIN)

include_once "./inc/header.php";
include_once "./inc/nav.php";
require_once "../models/eventModel.php";
// $listEvent = Event::findAllEvent();
$eventId = $_GET['event'];
$ficheEvent = Event::findEventById($eventId);
?>

<div class="container">
    <h1 class="m-5">évènements (admin)</h1>
    <!-- pour  le comparer avec le nombre de place -->
    
        <h2><?= $ficheEvent['titre']; ?></h2>
        <p><?= $ficheEvent['id_evenement']; ?></p>
        <p><?= $ficheEvent['titre']; ?></p>
        <p><?= $ficheEvent['duree']; ?></p>
        <p><?= $ficheEvent['resume']; ?></p>
        <p><?= $ficheEvent['prix']; ?></p>
        <p><?= $ficheEvent['nbr_place']; ?></p>
        <p><?= $ficheEvent['categorie_name']; ?></p>

        <a class="lien" href="./client_event.php?event=<?= $ficheEvent['id_evenement']; ?>">Consulter</a>
        <a href="./add_event.php?id_event_update=<?= $ficheEvent['id_evenement']; ?>">Update</a>
        <a href="traitement/action.php?id_event_delete=<?= $ficheEvent['id_evenement']; ?>">Delete</a>
</div>

<script>

</script>

<?php
include_once "./inc/footer.php";
?>
