<?php
include_once "./inc/header.php";
include_once "./inc/nav.php";
require_once "../models/eventModel.php";
$listEvent = Event::findAllEvent();
$currentDate = date('Y-m-d H:i:s'); // Date actuelle au format SQL (YYYY-MM-DD HH:MM:SS)

?>

<div class="container">
    <h1 class="m-5">Liste des évènements</h1>
    <!-- pour  le comparer avec le nombre de place -->

    <table class="table">
        <thead>
            <tr>
                <!-- Table Event -->
                <th>Identifiant</th>
                <th>Titre de l'évènement</th>
                <!-- <th>Durée</th> -->
                <th>Tarif</th>
                <!-- <th>Résumé</th> -->
                <!-- <th>Nombre de place</th> -->
                <th>Catégorie</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach($listEvent as $event){ ?>
                <tr>
                    <td><?= $event['id_evenement']; ?></td>
                    <td><?= $event['titre']; ?></td>
                    <!-- <td><?= $event['duree']; ?></td> -->
                    <td><?= $event['prix']; ?></td>
                    <!-- <td><?= $event['resume']; ?></td> -->
                    <!-- <td><?= $event['nbr_place']; ?></td> -->
                    <td><?= $event['categorie_name']; ?></td>
                    <!-- Ajouter le nombre de particpant par évènement -->
                    <td><a class="lien" href="./event.php?event=<?= $event['id_evenement']; ?>">Consulter</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <h2>Liste des évènements passés</h2>
    <table class="table">
        <thead>
            <tr>
                <!-- Table Event -->
                <th>Identifiant</th>
                <th>Titre de l'évènement</th>
                <!-- <th>Durée</th> -->
                <th>Tarif</th>
                <!-- <th>Résumé</th> -->
                <!-- <th>Nombre de place</th> -->
                <th>Catégorie</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach($listEvent as $event){ 
                // Comparer la date de l'événement avec la date actuelle
                if ($event['date_event'] < $currentDate) { ?>
                    <tr class="event-passe">
                        <td><?= $event['id_evenement']; ?></td>
                        <td><?= $event['titre']; ?></td>
                        <!-- <td><?= $event['duree']; ?></td> -->
                        <td><?= $event['prix']; ?></td>
                        <!-- <td><?= $event['resume']; ?></td> -->
                        <!-- <td><?= $event['nbr_place']; ?></td> -->
                        <td><?= $event['categorie_name']; ?></td>
                        <!-- Ajouter le nombre de particpant par évènement -->
                        <td><a class="lien" href="./event.php?event=<?= $event['id_evenement']; ?>">Consulter</a></td>
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
