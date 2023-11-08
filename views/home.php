<?php
include_once "./inc/header.php";
include_once "./inc/nav.php";
if(!empty($_SESSION)) {
    $user["role"] = $_SESSION["user_role"];
}
?>


<?php if(!empty($_SESSION) && $_SESSION['user_role'] == 'admin') { ?>                 
    <h1>Bonjour <?= ucfirst($_SESSION['user_pseudo']); ?> </h1>
<?php } elseif(!empty($_SESSION) && $_SESSION['user_role'] == 'client') { ?>
    <h1>Bonjour <?= ucfirst($_SESSION['user_pseudo']); ?> </h1>
<?php } else { ?>
    <h1>Bonjour</h1>
<?php } ?>



<?php
include_once "./inc/footer.php";
?>