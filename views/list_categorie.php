<?php
include_once "./inc/header.php";
include_once "./inc/nav.php";
require_once "../models/categorieModel.php";
$listCategorie = Categorie::findAllCategorie();
?>

<div class="container">
    <h1 class="m-5">Liste des Catégories</h1>
    <!-- pour  le comparer avec le nombre de place -->

    <table class="table">
        <thead>
            <tr>
                <!-- Table Categorie -->
                <th>Identifiant</th>
                <th>Nom de la Catégorie</th>
                <th>Modifier</th>
                <th>Supprimer</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach($listCategorie as $categorie){ ?>
                <tr>
                    <td><?= $categorie['id_categorie']; ?></td>
                    <td><?= $categorie['categorie_name']; ?></td>
                    <td><a href="./add_categorie.php?id_categorie_update=<?= $categorie['id_categorie']; ?>">Update</a></td>
                    <td><a href="traitement/action.php?id_categorie_delete=<?= $categorie['id_categorie']; ?>">Delete</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<?php
include_once "./inc/footer.php";
?>
