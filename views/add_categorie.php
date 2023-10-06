<?php
include_once "./inc/header.php";
include_once "./inc/nav.php";
?>

<!-- Accès ADMIN - Ajouter une catégorie -->

<div class="container">
    <h1 class="m-5">Ajouter une catégorie</h1>
    <form action="./traitement/action.php" method="post">
        
        <div class="form-group  mb-3">
            <label class="m-2" id="categorie_name">nom de la catégorie</label>
            <input type="text" class="form-control"  name="categorie_name" >
        </div>
 
        <button type="submit" class="btn btn-primary mt-5 mb-5" name="add_categorie" value="add_categorie">Ajouter une catégorie</button>
    </form>
</div>

<?php
include_once "./inc/footer.php";
?>