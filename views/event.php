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
 

        <!-- Si le rôle est ADMIN ... -->
        <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == "admin"){ ?>
                        
            <!-- ...impossible de réserver, retourne à la liste des évènements -->
            <a class="btn btn-outline-warning" href="./list_event.php">Revenir à la liste des évènements</a>

        <!-- Si le rôle est CLIENT ... -->
        <?php } elseif(isset($_SESSION['user_role']) && $_SESSION['user_role'] == "client"){
            
            // var_dump ($totalPlacesReservees);?>
            <!-- Si cette event n'est pas déjà réservé et si l'utilisateur n'a pas encore réservé cet évènement... && empty($userReservation['user_id'])-->
           
            <!-- S'il reste des places de disponible, c'est que $placesDisponibles n'est pas égale à 0 -->
            <!-- if($placesDisponibles !== 0  $totalPlacesReservees == null) { -->
                <?php if ($placesDisponibles !== 0) { ?>
                    <form action="./traitement/action.php" method="POST">
                        <input type="hidden" name="id_event" value="<?= $ficheEvent['id_evenement']; ?>">

                        <?php if ($ficheEvent['date_event'] >= $currentDate) { ?>
                            <?php if ($ficheEvent['events_actif'] == 1) { ?>
                                <!-- Vérifier si l'événement n'est pas annulé -->

                                <label for="">Choisir le nombre de place :</label>
                                <select name="place_reserve" id="">
                                    <?php
                                    $maxPlaces = min($placesDisponibles, 4);
                                    for ($i = 1; $i <= $maxPlaces; $i++) { ?>
                                        <option value="<?= $i; ?>"><?= $i; ?></option>
                                    <?php } ?>
                                </select><br><br>

                                <?php if (empty($userReservation['user_id']) || $_SESSION['id_user'] != $userReservation['user_id']) { ?>
                                    <!-- Si l'événement n'est pas déjà réservé par l'utilisateur de la session -->
                                    <button type="submit" class="btn btn-outline-warning" name="add_book">Réserver</button>
                                <?php } elseif ($_SESSION['id_user'] == $userReservation['user_id']) { ?>

                                    <!-- Si l'utilisateur de la session a déjà réservé l'événement -->
                                    <!-- <button type="submit" class="btn btn-outline-warning" name="add_another_book">Ajouter une autre réservation</button> -->
                                    
                                    <!-- Bouton pour afficher également la modale -->
                                    <!-- <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#exampleModal"> -->
                                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#exampleModalAddReservation">
                        Ajouter une autre réservation
                    </button>
                                <?php } ?>
                            <?php } else { ?>
                                <!-- Si l'événement est annulé -->
                                <div class="alert alert-secondary" role="alert">
                                    Événement annulé. Aucune réservation possible.
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <button type="submit" class="btn btn-outline-secondary" name="add_book" disabled>Réserver</button>
                        <?php } ?>
                        <!-- MODAL -->
                        <div class="modal fade" id="exampleModalAddReservation" tabindex="-1" aria-labelledby="exampleModalLabelAddReservation" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabelAddReservation">Ajouter une autre réservation</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Pour cette évènement, vous avez déjà une réservation</p>
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
                                        <!-- Contenu de la modale, par exemple, un message d'avertissement -->
                                        Votre message d'avertissement ici...
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    
                                        <button type="submit" class="btn btn-primary" name="add_another_book">Ajouter une autre réservation</button>
                    
                                        <!-- <button type="submit" class="btn btn-primary" name="add_another_book" onclick="addAnotherBook()">Ajouter une autre réservation</button> -->
                    
                                    </div>
                                </div>
                            </div>
                        </div>   
                    </form>
                
               <!-- }elseif($totalPlacesReservees == null){ -->
            <?php }
            }  
         ?> 
    
</div>

<script>
     function addAnotherBook() {
        // Ajoutez ici tout code JavaScript supplémentaire si nécessaire

        // Redirige vers le fichier de traitement du formulaire
        window.location.href = "./traitement/action.php";
    }
</script>

<?php
include_once "./inc/footer.php";
?>

<!-- 
    * Notez que cette modification n'empêchera pas complètement l'utilisateur de choisir plus de places disponibles. Vous devez également gérer cela du côté du serveur dans le fichier de traitement du formulaire (action.php). Assurez-vous de vérifier le nombre de places sélectionnées par l'utilisateur avant d'effectuer l'insertion dans la base de données pour éviter toute manipulation malveillante.
 -->
