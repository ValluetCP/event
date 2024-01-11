<?php
include_once "./inc/header.php";
include_once "./inc/nav.php";
include_once "./inc/functions.php";
require_once "../models/eventModel.php";
require_once "../models/bookModel.php";
require_once "../models/userModel.php";
require_once "../models/categorieModel.php";

$listEvent = Event::findAllEvent();
$userReservation = User::userReservation($_SESSION['id_user']);

// $userReservationIds = array_column($reservations, 'event_id');
$userReservationIds = Book::userReservationIds($_SESSION['id_user']); // Utilisez la nouvelle méthode

$currentDate = date('Y-m-d H:i:s'); // Date actuelle au format SQL (YYYY-MM-DD HH:MM:SS)

foreach ($listEvent as $event) {
    // Récupération des valeurs de categorie_id et categorie_name
    $categories[$event["categorie_id"]] = $event["categorie_name"];
}

// Utilisation de array_unique pour obtenir les valeurs uniques
// $categoriesUniques = array_unique($categories);
?>

<div class="container">
    <h1 class="m-5">Mes réservations</h1>
    <!-- Ajoutez le formulaire de filtre ici -->
    
    <!-- pour  le comparer avec le nombre de place -->
    <h2>Prochainement</h2>
    <table class="table">
        <thead>
            <tr>
                <!-- Table Event -->
                <th>Identifiant</th>
                <th>Titre de l'évènement</th>
                <th>Catégorie</th>
                <th>Date</th>
                <th>Action</th> 
            </tr>
        </thead>
        <tbody>
            <?php foreach($listEvent as $event){
                // Comparer la date de l'événement avec la date actuelle, si la date est déjà passé ne l'afficher ici

                if ($event['date_event'] >= $currentDate) { 
                    // Obtenir le nombre total de places réservées pour cet évènement
                    $totalPlacesReservees = Book::calculReservation($event['id_evenement']);
            ?>
                <tr>
                    <?php if(!empty($_SESSION['id_user'])){ 
                        if(in_array($event['id_evenement'], $userReservationIds) && $event['events_actif'] == 1){ ?>
                            <td><?= $event['id_evenement']; ?></td>
                            <td><?= $event['titre']; ?></td>
                            <td><?= $event['categorie_name']; ?></td>
                            <td><?= $event['date_event']; ?></td>
                            <td>
                                <a class="lien" href="./book.php?event=<?= $event['id_evenement']; ?>">Consulter</a>
                                <a class="lien" href="./billet.php?event=<?= $event['id_evenement']; ?>">Billet</a>
                            </td>
                        <?php } ?>
                    <?php } ?> 
                </tr>
            <?php }
            } ?>
        </tbody>
    </table>

    

    
</div>

<script>

</script>



<?php
include_once "./inc/footer.php";
?>
