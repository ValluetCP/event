<?php
include_once "./inc/header.php";
include_once "./inc/nav.php";
require_once "../models/categorieModel.php";
require_once "../models/eventModel.php";
$listCategorie = Categorie::findAllCategorie();


if (isset($_GET['id_event_update'])) {
    // identifiant de l'emprunt
    $id = $_GET['id_event_update'];
    // appel de la methode returnBook
    $event = Event::findEventById($id);
}

?>

<!-- Accès ADMIN - Ajouter un évènement -->

<div class="container">
    <h1 class="m-5">Evénements</h1>
    <h2 class="m-5"><?= !empty($event) ? "Modifier les informations de l'événement'" : "Ajouter un événement" ?></h2>
    <form action="./traitement/action.php" method="post" enctype="multipart/form-data">
        
        <div class="form-group  mb-3">
            <label class="m-2" id="titre">titre</label>
            <input type="text" class="form-control"  name="titre" value="<?= !empty($event) ? $event["titre"] : "" ?>">
        </div>
        
        <div class="form-group  mb-3">
            <label class="m-2" id="duree">Durée</label>
            <input type="text" class="form-control"  name="duree" value="<?= !empty($event) ? $event["duree"] : "" ?>" >
        </div>

        <div class="form-group  mb-3">
            <label class="m-2" id="prix">Tarif</label>
            <input type="number" class="form-control"  name="prix" value="<?= !empty($event) ? $event["prix"] : "" ?>" >
        </div>
        
        <div class="form-group  mb-3">
            <label class="m-2" id="resume">Résumé</label>
            <input type="text" class="form-control"  name="resume" value="<?= !empty($event) ? $event["resume"] : "" ?>" >
        </div>
        
        <div class="form-group  mb-3">
            <label class="m-2" id="nbr_place">Nombre de place</label>
            <input type="number" class="form-control"  name="nbr_place" value="<?= !empty($event) ? $event["nbr_place"] : "" ?>" >
        </div>
        
        <!-- Table categories (clé étrangère) - récupérer les infos -->
        <div class="form-group mb-3">
            <label class="m-2">Categorie :</label>
            <select name="categorie" class="form-control">
                <option value="">Choisir une categorie</option>
                <?php foreach($listCategorie as $categorie){ ?>
                    <option value="<?= $categorie['id_categorie']; ?>"><?= $categorie['categorie_name']; ?></option>
                <?php } ?>
            </select>
        </div>
        
        <!-- Pour les id se référer à la bdd -->
        <input type="hidden" class="form-control"  name="id_evenement" value="<?= !empty($event) ? $event["id_evenement"] : "" ?>">
        
        <input type="hidden" class="form-control"  name="categorie_id" value="<?= !empty($event) ? $event["categorie_id"] : "" ?>">

        
 
        <button type="submit" class="btn btn-primary mt-5 mb-5" name="<?= !empty($categorie) ? "update_event" : "add_event" ?>" value="add_event"><?= !empty($categorie) ? "Modifier" : "Ajouter" ?> un évènement</button>
    </form>
</div>

<?php
include_once "./inc/footer.php";
?>