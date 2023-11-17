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
 



        

        <!-- Si le rôle est ADMIN ... -->
        <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == "admin"){ ?>
                    
            <!-- ... Afficher les informations concernant les places : total, dispo, réservées,  -->
            <p>Place total : <?= !empty($ficheEvent) ? $ficheEvent["nbr_place"] : "0" ?></p>
            <p>Nombre de places réservées :  <?= !empty($totalPlacesReservees) ? $totalPlacesReservees: "0" ?></p>
            
            <!-- Si l'event est déjà passé -->
            <?php if ($ficheEvent['date_event'] < $currentDate) { ?>
                <!-- ...prévenir l'user -->
                <p>Places non utilisées : <?= $placesDisponibles; ?></p>
                <div class="alert alert-warning" role="alert"> Warning : Attention cette évènement est déjà passé !</div>
                <!-- ... sinon afficher  -->
            <?php }else{?>
                <p>Places disponibles : <?= $placesDisponibles; ?></p>
            <?php }?>
                        
            <!-- ...impossible de réserver, retourne à la liste des évènements -->
            <a class="btn btn-outline-warning" href="./list_event.php">Revenir à la liste des évènements</a>

        <!-- Si le rôle est CLIENT ... -->
        <?php } elseif(isset($_SESSION['user_role']) && $_SESSION['user_role'] == "client"){
            
            // var_dump ($totalPlacesReservees);?>
            
            <!-- Si cette event n'est pas déjà réservé et si l'utilisateur n'a pas encore réservé cet évènement... && empty($userReservation['user_id'])-->
            <?php if($placesDisponibles !== 0 ) {?>

                <!-- Création d'un formulaire -->
                <form action="./traitement/action.php" method="POST">
                    
                    <input type="hidden" name="id_event" value="<?= $ficheEvent['id_evenement']; ?>">
                    
                    <!-- Si l'évènement n'est pas encore passée...-->
                    <?php if ($ficheEvent['date_event'] >= $currentDate) { ?>

                        <!-- ...Choisir le nombre de places* -->
                        <label for="">Choisir le nombre de place :</label>
                        <select name="place_reserve" id="">
                            <?php for( $i = 1; $i <= $placesDisponibles; $i++){ ?>
                                <option value="<?= $i; ?>"><?= $i; ?></option>
                            <?php } ?>   
                        </select><br><br>

                        <!-- bouton "réservé" -->
                        <button type="submit" class="btn btn-outline-warning" name="add_book">Réserver</button>

                    <!-- Sinon, si cette event est déjà réservé ... -->
                    <?php } else {?>
                        <!-- ...rendre impossible la réservation -->
                        <button type="submit" class="btn btn-outline-secondary" name="add_book"disabled>Réserver</button>
                    <?php } ?> 
                </form>
                
                
            <?php }else{ ?> 

                <?php if ($ficheEvent['date_event'] < $currentDate) { ?>
                        <!-- Si l'évènement est passée...-->
                        <div class="alert alert-danger" role="alert"> 
                            <!-- le user pourra juste consulter les infos de l'event -->
                            OUPS ! Cette évènement est déjà passé, pensez à nous laisser un avis !
                        </div>
                    <?php }
                    // Si l'id session est égal à celui de la réservation...
                    if($_SESSION['id_user'] == $userReservation['user_id']){ ?>
                        <!-- l'évènement s'affiche comme déjà réservé...-->
                        <div class="alert alert-warning" role="alert"> 
                            <!-- le user pourra contacter le site pour modifier si besoin-->
                            Pour toutes modifications de votre réservation merci de nous <a href="">contacter</a>!
                        </div>

                <?php }   
            }  
        } ?>  
            
</div>

<script>
    
</script>

<?php
include_once "./inc/footer.php";
?>

<!-- 
    * Notez que cette modification n'empêchera pas complètement l'utilisateur de choisir plus de places disponibles. Vous devez également gérer cela du côté du serveur dans le fichier de traitement du formulaire (action.php). Assurez-vous de vérifier le nombre de places sélectionnées par l'utilisateur avant d'effectuer l'insertion dans la base de données pour éviter toute manipulation malveillante.
 -->
