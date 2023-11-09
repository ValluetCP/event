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

        <div class="d-flex">
            <button type="submit" class="btn btn-primary mt-5 mb-5 me-2" name="update_user">Valider</button>   
    
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary  mt-5 mb-5 mx-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
              Annuler
            </button>
        </div>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Annulation</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>
            En cliquant sur le bouton "quitter cette page", ces informations ne seront pas enregistrées et vos modifications ne seront pas prises en compte.
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Revenir sur la page</button>
        <a class="btn btn-primary" href="./info_user.php" role="button">Quitter cette page</a>
        <!-- <button type="button" class="btn btn-primary">Quitter cette page</button> -->
      </div>
    </div>
  </div>
</div>
<?php
include_once "./inc/footer.php";
?>