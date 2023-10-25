<?php
include_once "./inc/header.php";
include_once "./inc/nav.php";
?>

<div class="container">
    <h1 class="m-5">Connexion</h1>
    <form action="./traitement/action.php" method="post">

        <div class="form-group  mb-3">
            <label class="m-2" id="email">Email</label>
            <input type="email" class="form-control"  name="email" >
        </div>
        
        <div class="form-group  mb-3">
            <label class="m-2" id="password">Mot de passe</label>
            <input type="password" class="form-control"  name="password" >
        </div>
 
        <button type="submit" class="btn btn-primary mt-5 mb-5" name="login" value="login">Se connecter</button>
    </form>
</div>

<?php
include_once "./inc/footer.php";
?>