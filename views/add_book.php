<?php
include_once "./inc/header.php";
include_once "./inc/nav.php";
require_once "../models/categorieModel.php";
require_once "../models/eventModel.php";
$listEvent = Event::findAllEvent();
$listCategorie = Categorie::findUsedCategorie();
?>

<!-- Accès ADMIN - Ajouter une réservation -->

<div class="container">
    <h1 class="m-5">Ajouter une réservation</h1>
    <form action="./traitement/action.php" method="post">
        
        <div class="form-group mb-3">
            <label class="m-2">Categorie :</label>
            <select name="hotel" class="form-control">
                <option value="">Choisir une categorie</option>
                <?php foreach($listCategorie as $categorie){ ?>
                    <option value="<?= $categorie['id_categorie']; ?>"><?= $categorie['categorie_name']; ?></option>
                <?php } ?>
            </select>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <!-- Table Event -->
                    <th>Titre de l'évènement</th>
                    <th>categorie</th>
                    <th>Durée</th>
                    <th>Tarif</th>
                    <th>Consulter</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listEvent as $event){ ?>
                    <tr>
                        <td><?= $event['titre']; ?></td>
                        <td><?= $event['categorie_name']; ?></td>
                        <td><?= $event['duree']; ?></td>
                        <td><?= $event['prix']; ?></td>

                        <td><a href="./add_event.php?id_event_update=<?= $event['id_evenement']; ?>">Consulter</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="form-group  mb-3">
            <label class="m-2" id="nbr_de_personnes">Nombre de personnes</label>
            <input type="number" class="form-control"  name="nbr_de_personnes" >
        </div>
 
        <button type="submit" class="btn btn-primary mt-5 mb-5" name="add_book" value="add_book">Réserver</button>
    </form>
</div>

<?php
include_once "./inc/footer.php";
?>