<?php
// Page - Affiche un évènement (côté CLIENT)

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

        <a href="./list_book.php?book=<?= $ficheEvent['id_evenement']; ?>" class="btn btn-outline-warning">Ajouter cette évènement</a>
</div>

<script>

</script>

<?php
include_once "./inc/footer.php";
?>
