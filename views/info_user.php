<?php
include_once "./inc/header.php";
include_once "./inc/nav.php";
require_once "../models/userModel.php";
$userList = User::findAllUser();
// $_SESSION["user_role"] = $user["role"];
$user["role"] = $_SESSION["user_role"];


?>

<div class="container">
<h1 class="m-5">Mes informations personnelles</h1>
    <form action="./traitement/action.php" method="post">

        <div class="form-group  mb-3">
            <label class="m-2" id="nom">Nom</label>
            <input type="text" class="form-control text-uppercase"  name="nom" value="<?= $_SESSION["user_name"] ?>" disabled>
        </div>

        <div class="form-group  mb-3">
            <label class="m-2" id="prenom">Prénom</label>
            <input type="text" class="form-control"  name="prenom" value="<?= $_SESSION["user_firstName"] ?>" disabled>
        </div>

        <div class="form-group  mb-3">
            <label class="m-2" id="pseudo">Pseudo</label>
            <input type="text" class="form-control"  name="pseudo" value="<?= $_SESSION["user_pseudo"] ?>"  disabled>
        </div>

        <div class="form-group  mb-3">
            <label class="m-2" id="email">Email</label>
            <input type="email" class="form-control"  name="email" value="<?= $_SESSION["user_email"] ?>" disabled>
        </div>

        <!-- BOUTON modifier / valider -->
        <a class="lien btn" href="./info_user.php?id_user_update=<?= $event['id_utilisateur']; ?>">Modifier</a>
        <!-- <button type="submit" class="btn btn-primary mt-5 mb-5" name="update_user" value=""  onclick="window.location.href = 'https://fr.w3docs.com/';">Modifier mon profil</button> -->

    </form>
</div>

<?php
include_once "./inc/footer.php";
?>