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

// $placeList = Book::calculReservation($eventId);
// var_dump($placeList);
// ["SUM(place_reserve)"]=> NULL

?>

<div class="container">
    <h1 class="m-5">évènements</h1>
    
        <h2><?= ucfirst($ficheEvent['titre']); ?></h2>
        <!-- <p>Identifiant : <?= $ficheEvent['id_evenement']; ?></p> -->

        <div><img src="./asset/img_event/<?= $ficheEvent['image']; ?>" alt=""></div>

        <p>Catégorie : <?= $ficheEvent['categorie_name']; ?></p>
        
        <p>Titre : <?= $ficheEvent['titre']; ?></p>

        <p>Date : <?= date('d-m-Y', strtotime($ficheEvent['date_event'])); ?></p>

        <p>Résumé : <?= $ficheEvent['resume']; ?></p>

        <p>Tarif : <?= $ficheEvent['prix']; ?></p>

        <p>Place total : <?= !empty($ficheEvent) ? $ficheEvent["nbr_place"] : "0" ?></p>
        
        <p>Nombre de places réservées :  <?= !empty($totalPlacesReservees) ? $totalPlacesReservees: "0" ?></p>
       
        <p>Places disponibles : <?= $placesDisponibles; ?></p>
        
        <input type="hidden" name="<?= $ficheEvent['nbr_place']; ?>" id="">

        <?php if(empty($ficheEvent['place_reserve'])) {?>
        <!-- pour  le comparer avec le nombre de place -->
        <form action="./traitement/action.php" method="POST">
            <label for="">Choisir le nombre de place :</label>
            <select name="place_reserve" id="">
                <?php for( $i = 1; $i < 5; $i++){ ?>
                    <option value="<?= $i; ?>"><?= $i; ?></option>
                <?php } ?>   
            </select><br><br>

            <!-- <p>Montant total : <?= $prix; ?></p> -->
            <input type="hidden" name="id_event" value="<?= $ficheEvent['id_evenement']; ?>">
            <button type="submit" class="btn btn-outline-warning" name="add_book">Réserver</button>

        </form>
        <?php } else {?>
            <p>Tarif : <?= $ficheEvent['place_reserve']; ?></p>
            <?php } ?>
</div>

<script>
    
</script>

<?php
include_once "./inc/footer.php";
?>
