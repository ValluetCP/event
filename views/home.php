<?php
include_once "./inc/header.php";
include_once "./inc/nav.php";
$user["role"] = $_SESSION["user_role"];
?>


<?php if($_SESSION['user_role'] == 'admin') { ?>                 
    <h1>Bonjour <?= ucfirst($_SESSION['user_name']); ?> </h1>
<?php } elseif($_SESSION['user_role'] == 'client') { ?>
    <h1>Bonjour <?= ucfirst($_SESSION['user_name']); ?> </h1>
<?php } else { ?>
    <h1>Bonjour</h1>
<?php } ?>



<?php
include_once "./inc/footer.php";
?>