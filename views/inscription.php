<?php
include_once "./inc/header.php";
include_once "./inc/nav.php";
?>

<div class="container">
    <h1 class="m-5">Inscription</h1>
    <form action="./traitement/action.php" method="post">

        <!-- <div class="form-group mt-5 mb-5 d-flex justify-content-around">
            <label class="me-xl-5">Statut :</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="statut" id="particulier" value="particulier">
                <label class="form-check-label">particulier</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="statut" id="entreprise" value="entreprise">
                <label class="form-check-label">entreprise</label>
            </div>
        </div> -->
        
        <div class="form-group  mb-3">
            <label class="m-2" id="nom">Nom</label>
            <input type="text" class="form-control text-uppercase"  name="nom" >
        </div>
        
        <div class="form-group  mb-3">
            <label class="m-2" id="prenom">Prénom</label>
            <input type="text" class="form-control"  name="prenom" >
        </div>

        <div class="form-group  mb-3">
            <label class="m-2" id="pseudo">Pseudo</label>
            <input type="text" class="form-control"  name="pseudo" >
        </div>
        
        <div class="form-group  mb-3">
            <label class="m-2" id="email">Email</label>
            <input type="email" class="form-control"  name="email" >
        </div>
        
        <div class="form-group  mb-3">
            <label class="m-2" id="mdp">Mot de passe</label>
            <input type="password" class="form-control"  name="mdp" >
        </div>
        
        <!-- <div class="form-group  mb-3">
            <label class="m-2" id="actif">Actif</label>
            <input type="text" class="form-control"  name="actif" >
        </div> -->

        <!-- <div class="form-group mt-5 mb-5 d-flex justify-content-around">
            <label class="me-xl-5">Role :</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="role" id="admin" value="admin">
                <label class="form-check-label">admin</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="role" id="client" value="client">
                <label class="form-check-label">client</label>
            </div>
        </div>
  -->
        <button type="submit" class="btn btn-primary mt-5 mb-5" name="register" value="register">S'inscrire</button>
    </form>
</div>

<?php
include_once "./inc/footer.php";
?>