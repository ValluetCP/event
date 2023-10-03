<?php
include_once "./inc/header.php";
include_once "./inc/nav.php";
?>

<div class="container">
    <h1 class="m-5">Inscription</h1>
    <form action="./traitement/action.php" method="post">
        
        <div class="form-group  mb-3">
            <label class="m-2" id="nom">Nom</label>
            <input type="text" class="form-control text-uppercase"  name="nom" >
        </div>
        
        <div class="form-group  mb-3">
            <label class="m-2" id="prenom">Prénom</label>
            <input type="text" class="form-control text-uppercase"  name="prenom" >
        </div>

        <div class="form-group  mb-3">
            <label class="m-2" id="pseudo">Pseudo</label>
            <input type="text" class="form-control text-uppercase"  name="pseudo" >
        </div>
        
        <div class="form-group  mb-3">
            <label class="m-2" id="email">Email</label>
            <input type="email" class="form-control text-uppercase"  name="email" >
        </div>
        
        <div class="form-group  mb-3">
            <label class="m-2" id="password">Mot de passe</label>
            <input type="password" class="form-control text-uppercase"  name="password" >
        </div>
 
        <button type="submit" class="btn btn-primary mt-5 mb-5" name="" value="register">S'inscrire</button>
    </form>
</div>

<?php
include_once "./inc/footer.php";
?>