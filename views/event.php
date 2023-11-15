<?php
// Page - Affiche un évènement (côté CLIENT)
// session_start();
include_once "./inc/header.php";
include_once "./inc/nav.php";
include_once "./inc/functions.php";
require_once "../models/eventModel.php";
require_once "../models/bookModel.php";


// $listEvent = Event::findAllEvent();
$eventId = $_GET['event'];
$ficheEvent = Event::findEventById($eventId);
$totalPlacesReservees = Book::calculReservation($eventId);
$placesDisponibles = $ficheEvent['nbr_place'] - $totalPlacesReservees;
$currentDate = date('Y-m-d H:i:s'); // Date actuelle au format SQL (YYYY-MM-DD HH:MM:SS)

// $placeList = Book::calculReservation($eventId);
// var_dump($placeList);
// ["SUM(place_reserve)"]=> NULL

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

        <p>Places réservées : <?= $totalPlacesReservees; ?></p>
 
        <input type="hidden" name="<?= $ficheEvent['nbr_place']; ?>" id="">


        <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == "admin"){ ?>
                    
            <!-- Afficher les informations concernant les places -->
            <p>Place total : <?= !empty($ficheEvent) ? $ficheEvent["nbr_place"] : "0" ?></p>
            <p>Nombre de places réservées :  <?= !empty($totalPlacesReservees) ? $totalPlacesReservees: "0" ?></p>
            

            <?php if ($ficheEvent['date_event'] < $currentDate) { ?>
                <p>Places non utilisées : <?= $placesDisponibles; ?></p>
                <div class="alert alert-warning" role="alert"> Warning : Attention cette évènement est déjà passé !</div>
            <?php }else{?>
                <p>Places disponibles : <?= $placesDisponibles; ?></p>
            <?php }?>
                        
            <!-- Si le rôle est ADMIN, impossible de réserver -->
            <a class="btn btn-outline-warning" href="./list_event.php">Revenir à la liste des évènements</a>

                    <!-- Si l'évènement est passée, impossible de réserver -->
        <?php } elseif(isset($_SESSION['user_role']) && $_SESSION['user_role'] == "client"){
            
            var_dump ($totalPlacesReservees);?>
            
            <?php if($totalPlacesReservees == null) {?>

                <form action="./traitement/action.php" method="POST">
                    
                    <input type="hidden" name="id_event" value="<?= $ficheEvent['id_evenement']; ?>">
                    <?php if ($ficheEvent['date_event'] >= $currentDate) { ?>
                        <label for="">Choisir le nombre de place :</label>
                        <select name="place_reserve" id="">
                            <?php for( $i = 1; $i < 5; $i++){ ?>
                                <option value="<?= $i; ?>"><?= $i; ?></option>
                            <?php } ?>   
                        </select><br><br>
                        <button type="submit" class="btn btn-outline-warning" name="add_book">Réserver</button>
                    <?php } else {?>
                        <button type="submit" class="btn btn-outline-secondary" name="add_book"disabled>Réserver</button>
                    <?php } ?> 

                </form>
                
                
            <?php }else{ ?> 

                <?php if ($ficheEvent['date_event'] < $currentDate) { ?>
                        <div class="alert alert-danger" role="alert"> 
                            OUPS ! Cette évènement est déjà passé, pensez à nous laisser un avis !
                        </div>
                    <?php }else{ ?> 
                        <div class="alert alert-warning" role="alert"> 
                            Pour toutes modifications de votre réservation merci de nous <a href="">contacter</a>!
                        </div>

            <?php } ?>  
            <?php } ?>  
        <?php } ?>  
            
</div>

<script>
    
</script>

<?php
include_once "./inc/footer.php";
?>
