<?php
// Page - Affiche un évènement (côté CLIENT)
// session_start();
include_once "./inc/header.php";
include_once "./inc/nav.php";
require_once "../models/eventModel.php";
// $listEvent = Event::findAllEvent();
$eventId = $_GET['event'];
$ficheEvent = Event::findEventById($eventId);
?>

<div class="container">
    <h1 class="m-5">évènements</h1>
    <!-- pour  le comparer avec le nombre de place -->
    
        <h2><?= $ficheEvent['titre']; ?></h2>
        <p>Identifiant : <?= $ficheEvent['id_evenement']; ?></p>
        <p>Catégorie : <?= $ficheEvent['categorie_name']; ?></p>
        <p>Titre : <?= $ficheEvent['titre']; ?></p>
        <!-- <p><?= $ficheEvent['duree']; ?></p> -->
        <p>Résumé : <?= $ficheEvent['resume']; ?></p>
        <p>Tarif : <?= $ficheEvent['prix']; ?></p>
        <!-- <p><?= $ficheEvent['nbr_place']; ?></p> -->

        <form action="./traitement/action.php" method="POST">
            <label for="">Choisir le nombre de place :</label>
            <select name="" id="">
                <?php for( $i = 1; $i < 10; $i++){ ?>
                    <option value="<?= $i; ?>"><?= $i; ?></option>
                <?php } ?>   
            </select><br><br>

            <!-- <p>Montant total : <?= $prix; ?></p> -->

            <input type="hidden" name="id_event" value="<?= $ficheEvent['id_evenement']; ?>">
            <button href="./list_book.php?book=<?= $ficheEvent['id_evenement']; ?>" class="btn btn-outline-warning" name="add_book">Réserver</button>

        </form>
</div>

<script>
    
</script>

<?php
include_once "./inc/footer.php";
?>
