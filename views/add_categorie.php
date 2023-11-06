<?php
include_once "./inc/header.php";
include_once "./inc/nav.php";
require_once "../models/categorieModel.php";

if (isset($_GET['id_categorie_update'])) {
    // identifiant de l'emprunt
    $id = $_GET['id_categorie_update'];
    // appel de la methode returnBook
    $categorie = Categorie::findCategorieById($id);
}

?>

<!-- Accès ADMIN - Ajouter une catégorie -->

<div class="container">
    <h1 class="m-5">Catégorie</h1>
    <h2 class="m-5"><?= !empty($categorie) ? "Modifier les informations de la catégorie" : "Ajouter une catégorie" ?></h2>
    <form action="./traitement/action.php" method="post">
        
        <div class="form-group  mb-3">
            <label class="m-2" id="categorie_name">nom de la catégorie</label>
            <input type="text" class="form-control"  name="categorie_name" value="<?= !empty($categorie) ? $categorie["categorie_name"] : "" ?>" >
        </div>

        <!-- Pour les id se référer à la bdd -->
        <input type="hidden" class="form-control text-uppercase" name="id_categorie" value="<?= !empty($categorie) ? $categorie["id_categorie"] : "" ?>">
 
        <button type="submit" class="btn btn-primary mt-5 mb-5" name="<?= !empty($categorie) ? "update_categorie" : "add_categorie" ?>" value="add_categorie"><?= !empty($categorie) ? "Modifier" : "Ajouter" ?> une Catégorie</button>
    </form>
</div>

<?php
include_once "./inc/footer.php";
?>