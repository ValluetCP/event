<?php
include_once "./inc/header.php";
include_once "./inc/nav.php";
require_once "../models/eventModel.php";
$listEvent = Event::findAllEvent();
$currentDate = date('Y-m-d H:i:s'); // Date actuelle au format SQL (YYYY-MM-DD HH:MM:SS)

?>

<div class="container">
    <h1 class="m-5">Liste des évènements (ADMIN)</h1>
    <!-- pour  le comparer avec le nombre de place -->
    <h2>Prochainement</h2>
    <table class="table">
        <thead>
            <tr>
                <!-- Table Event -->
                <th>Identifiant</th>
                <th>Titre de l'évènement</th>
                <th >Catégorie</th>
                <th colspan="4">Action</th>
                <th>Etat</th>
                
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($listEvent as $event){ 
                    // Comparer la date de l'événement avec la date actuelle
                    if ($event['date_event'] >= $currentDate) { ?>
                        <tr>
                            <td><?= $event['id_evenement']; ?></td>
                            <td><?= $event['titre']; ?></td>
                            <td><?= $event['categorie_name']; ?></td>
                            <?php if ($event['events_actif'] == 1){ ?>
                                <td><a class="lien" href="./event.php?event=<?= $event['id_evenement']; ?>">Consulter</a></td>
                                <td><a href="./add_event.php?id_event_update=<?= $event['id_evenement']; ?>">Modifier</a></td>
                                <td><a href="traitement/action.php?id_event_desactive=<?= $event['id_evenement']; ?>">Annuler</a></td>
                                <td><a href="traitement/action.php?id_event_delete=<?= $event['id_evenement']; ?>">Supprimer</a></td>
                                <td></td>
                            <?php }elseif($event['events_actif'] == 0){ ?>
                                <td colspan="4"><a href="traitement/action.php?id_event_active=<?= $event['id_evenement']; ?>">Activer l'évènement</a></td>
                                <td>annulation</td>
                            <?php } ?>
                        </tr>
                    <?php }
                }
                
                
             ?>
        </tbody>
    </table>
    <a href="./add_event.php" class="btn btn-outline-warning mt-2 mb-5">Ajouter un évènement</a>
    <h2>Historique</h2>
    <table class="table">
        <thead>
            <tr>
                <!-- Table Event -->
                <th>Identifiant</th>
                <th>Titre de l'évènement</th>
                <th >Catégorie</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($listEvent as $event){ 
                // Comparer la date de l'événement avec la date actuelle
                if ($event['date_event'] < $currentDate) { ?>
                    <tr>
                        <td><?= $event['id_evenement']; ?></td>
                        <td><?= $event['titre']; ?></td>
                        <td><?= $event['categorie_name']; ?></td>
                        <td><a class="lien" href="./event.php?event=<?= $event['id_evenement']; ?>">Consulter</a></td>
                        <td><a href="./add_event.php?id_event_update=<?= $event['id_evenement']; ?>">Modifier</a></td>
                        <td><a href="traitement/action.php?id_event_desactive=<?= $event['id_evenement']; ?>">Supprimer</a></td>
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
