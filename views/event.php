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

// $placeList = Book::calculReservation($eventId);
// var_dump($placeList);
// ["SUM(place_reserve)"]=> NULL
// var_dump($userReservation);
?>

<div class="container">
    
    
    <?= ($totalPlacesReservees == null) ? '<h1 class="m-5">évènement</h1>' : '<h1 class="m-5">Ma réservation</h1>'?>
    <!-- <h1 class="m-5">évènement</h1> -->
    
    <h2><?= ucfirst($ficheEvent['titre']); ?></h2>

    
    
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
     

    <!-- Ajouter cette partie pour afficher l'état de l'événement -->
    <?php if (!empty($_SESSION['id_user']) && isset($userReservation['user_id'])): ?>
    <?php if ($ficheEvent['date_event'] >= $currentDate): ?>
        <?php if ($ficheEvent['events_actif'] == 0): ?>
            <div class="alert alert-danger" role="alert">
                Événement annulé.
            </div>
        <?php elseif ($totalPlacesReservees >= $ficheEvent['nbr_place']): ?>
            <div class="alert alert-warning" role="alert">
                <?php if ($userReservation['user_id'] == $_SESSION['id_user']): ?>
                    Réservation confirmée. Événement complet.
                <?php else: ?>
                    Événement complet.
                <?php endif; ?>
            </div>
        <?php elseif ($userReservation['user_id'] == $_SESSION['id_user']): ?>
            <div class="alert alert-success" role="alert">
                Réservation confirmée.
            </div>
        <?php else: ?>
            <!-- Le formulaire de réservation -->
            <form action="./traitement/action.php" method="POST">
                <input type="hidden" name="id_event" value="<?= $ficheEvent['id_evenement']; ?>">
                <!-- Choix du nombre de places -->
                <label for="">Choisir le nombre de place :</label>
                <select name="place_reserve" id="">
                    <?php
                    // Limiter le choix à 4 places
                    $maxPlaces = min($placesDisponibles, 4);
                    for ($i = 1; $i <= $maxPlaces; $i++): ?>
                        <option value="<?= $i; ?>"><?= $i; ?></option>
                    <?php endfor; ?>   
                </select><br><br>
                <!-- Bouton de réservation -->
                <button type="submit" class="btn btn-outline-warning" name="add_book">Réserver</button>
            </form>
        <?php endif; ?>
    <?php else: ?>
        <!-- Si l'événement est passé -->
        <div class="alert alert-info" role="alert">
            Terminée.
        </div>
    <?php endif; ?>
<?php endif; ?>



        

       
    
            
</div>

<script>
    
</script>

<?php
include_once "./inc/footer.php";
?>

<!-- 
    * Notez que cette modification n'empêchera pas complètement l'utilisateur de choisir plus de places disponibles. Vous devez également gérer cela du côté du serveur dans le fichier de traitement du formulaire (action.php). Assurez-vous de vérifier le nombre de places sélectionnées par l'utilisateur avant d'effectuer l'insertion dans la base de données pour éviter toute manipulation malveillante.
 -->
