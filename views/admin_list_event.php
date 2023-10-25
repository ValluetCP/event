<?php
include_once "./inc/header.php";
include_once "./inc/nav.php";
require_once "../models/eventModel.php";
$listEvent = Event::findAllEvent();
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
                <th >Catégorie</th>
                <th colspan="3">Action</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach($listEvent as $event){ ?>
                <tr>
                    <td><?= $event['id_evenement']; ?></td>
                    <td><?= $event['titre']; ?></td>
                    <td><?= $event['categorie_name']; ?></td>

                    <td><a href="./add_event.php?id_event_update=<?= $event['id_evenement']; ?>">Modifier</a></td>
                    <td><a href="traitement/action.php?id_event_delete=<?= $event['id_evenement']; ?>">Supprimer</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="./add_event.php" class="btn btn-outline-warning">Ajouter un évènement</a>
</div>

<script>

</script>

<?php
include_once "./inc/footer.php";
?>
