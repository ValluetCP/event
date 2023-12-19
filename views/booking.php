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

// $placeList = Book::calculReservation($eventId);
// var_dump($placeList);
// ["SUM(place_reserve)"]=> NULL
// var_dump($userReservation);
?>

<div class="container">
    
    
    <?= ($totalPlacesReservees == null) ? '<h1 class="m-5">évènement</h1>' : '<h1 class="m-5">Ma réservation</h1>'?>
    <!-- <h1 class="m-5">évènement</h1> -->
    
    <h2><?= ucfirst($ficheEvent['titre']); ?></h2>


    <!-- Ajouter cette partie pour afficher l'état de l'événement -->
    <?php if (!empty($_SESSION['id_user']) && isset($userReservation['user_id'])): ?>
        <?php if ($ficheEvent['date_event'] >= $currentDate): ?>
            <?php if ($ficheEvent['events_actif'] == 0): ?>
                <div class="alert alert-secondary" role="alert">
                    Événement annulé.
                </div>
            <?php elseif ($totalPlacesReservees >= $ficheEvent['nbr_place']): ?>
                <?php if ($userReservation['user_id'] == $_SESSION['id_user']): ?>
                    <div class="alert alert-warning" role="alert">
                        Réservation confirmée. Événement complet.
                </div>
                <?php else: ?>
                    <div class="alert alert-danger" role="alert">
                        Événement complet. <a href="">Me contacter si de la place se libère</a>!
                    </div>
                    <?php endif; ?>
            <?php elseif ($userReservation['user_id'] == $_SESSION['id_user']): ?>
                <div class="alert alert-success" role="alert">
                    Réservation confirmée. Pour toutes modifications de votre réservation merci de nous <a href="">contacter</a>!
                </div>
            <?php endif; ?>
        <?php else: ?>
            <!-- Si l'événement est passé -->
            <div class="alert alert-info" role="alert">
                Terminée. OUPS ! Cette évènement est déjà passé, pensez à nous laisser un avis !
            </div>
        <?php endif; ?>
    <?php endif; ?>


    <!-- <p>Identifiant : <?= $ficheEvent['id_evenement']; ?></p> -->

        <div><img src="./asset/img_event/<?= $ficheEvent['image']; ?>" alt=""></div>

        <p>Catégorie : <?= $ficheEvent['categorie_name']; ?></p>
        
        <p>Titre : <?= $ficheEvent['titre']; ?></p>

        <p>Date : <?= date('d-m-Y', strtotime($ficheEvent['date_event'])); ?></p>

        <p>Résumé : <?= $ficheEvent['resume']; ?></p>

        <p>Tarif : <?= $ficheEvent['prix']; ?></p>

        <p>Nombre de places total: <?= $ficheEvent['nbr_place']; ?></p>
        <p>Nombre de places réservées : <?= $totalPlacesReservees; ?></p>
        <p>Nombre de places disponible : <?= $placesDisponibles; ?></p>

        <a class="btn btn-outline-warning" href="./list_book.php">Retour à mes réservations</a>

            
</div>

<script>
    
</script>

<?php
include_once "./inc/footer.php";
?>

<!-- 
    * Notez que cette modification n'empêchera pas complètement l'utilisateur de choisir plus de places disponibles. Vous devez également gérer cela du côté du serveur dans le fichier de traitement du formulaire (action.php). Assurez-vous de vérifier le nombre de places sélectionnées par l'utilisateur avant d'effectuer l'insertion dans la base de données pour éviter toute manipulation malveillante.
 -->
