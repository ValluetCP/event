<?php
include_once "./inc/header.php";
include_once "./inc/nav.php";
require_once "../models/userModel.php";
// // $_SESSION["user_role"] = $user["role"];
// $user["role"] = $_SESSION["user_role"];


?>

<div class="container">
<h1 class="m-5">Mes informations personnelles</h1>
    <form action="./traitement/action.php" method="post">

        <div class="form-group  mb-3">
            <label class="m-2" id="nom">Nom</label>
            <input type="text" class="form-control text-uppercase"  name="nom" value="<?= $_SESSION["user_name"] ?>">
            
        </div>

        <div class="form-group  mb-3">
            <label class="m-2" id="prenom">Prénom</label>
            <input type="text" class="form-control"  name="prenom" value="<?= $_SESSION["user_firstName"] ?>">
        </div>

        <div class="form-group  mb-3">
            <label class="m-2" id="pseudo">Pseudo</label>
            <input type="text" class="form-control"  name="pseudo" value="<?= $_SESSION["user_pseudo"] ?>">
        </div>

        <div class="form-group  mb-3">
            <label class="m-2" id="email">Email</label>
            <input type="email" class="form-control"  name="email" value="<?= $_SESSION["user_email"] ?>">
        </div>

        <!--         
        <div class="form-group  mb-3">
            <label class="m-2" id="mdp">Mot de passe</label>
            <input type="password" class="form-control"  name="mdp" >
        </div> -->
        <button type="submit" class="btn btn-primary mt-5 mb-5" name="update_user" value="register">Valider</button>    

    </form>
</div>

<?php
include_once "./inc/footer.php";
?>