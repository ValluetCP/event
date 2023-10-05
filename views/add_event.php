<?php
include_once "./inc/header.php";
include_once "./inc/nav.php";
require_once "../models/categorieModel.php";
$listCategorie = Categorie::findAllCategorie();
?>

<!-- Accès ADMIN - Ajouter un évènement -->

<div class="container">
    <h1 class="m-5">Ajouter un évènement</h1>
    <form action="./traitement/action.php" method="post" enctype="multipart/form-data">
        
        <div class="form-group  mb-3">
            <label class="m-2" id="titre">titre</label>
            <input type="text" class="form-control text-uppercase"  name="titre" >
        </div>
        
        <div class="form-group  mb-3">
            <label class="m-2" id="duree">Durée</label>
            <input type="text" class="form-control"  name="duree" >
        </div>

        <div class="form-group  mb-3">
            <label class="m-2" id="prix">Tarif</label>
            <input type="text" class="form-control"  name="prix" >
        </div>
        
        <div class="form-group  mb-3">
            <label class="m-2" id="resume">Résumé</label>
            <input type="text" class="form-control"  name="resume" >
        </div>
        
        <div class="form-group  mb-3">
            <label class="m-2" id="nbr_place">Nombre de place</label>
            <input type="number" class="form-control text-uppercase"  name="nbr_place" >
        </div>
        
        <!-- Table categories (clé étrangère) - récupérer les infos -->
        <div class="form-group  mb-3">
            <label class="m-2" id="categorie_id">categorie</label>
            <input type="text" class="form-control text-uppercase"  name="categorie_id" >
        </div>

        <div class="form-group mb-3">
            <label class="m-2">Categorie :</label>
            <select name="hotel" class="form-control">
                <option value="">Choisir une categorie</option>
                <?php foreach($listCategorie as $categorie){ ?>
                    <option value="<?= $categorie['id_categorie']; ?>"><?= $categorie['categorie_name']; ?></option>
                <?php } ?>
            </select>
        </div>
        

        
 
        <button type="submit" class="btn btn-primary mt-5 mb-5" name="add_event" value="add_event">Ajouter un évènement</button>
    </form>
</div>

<?php
include_once "./inc/footer.php";
?>