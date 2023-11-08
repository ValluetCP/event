<?php
include_once "./inc/header.php";
include_once "./inc/nav.php";
require_once "../models/userModel.php";
$userList = User::findAllUser();
?>

<div class="container">
    <h1 class="m-5">La liste des utilisateurs (admin)</h1>
    <!-- pour  le comparer avec le nombre de place -->

    <table class="table">
        <thead>
            <tr>
                <!-- Table user -->
                <th>Identifiant</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Pseudo</th>
                <th>Email</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($userList as $user){ ?>
                <tr>
                    <td><?= $user['id_utilisateur']; ?></td>
                    <td><?= $user['nom']; ?></td>
                    <td><?= $user['prenom']; ?></td>
                    <td><?= $user['pseudo']; ?></td>
                    <td><?= $user['email']; ?></td>
                    <td><a class="lien" href="./user.php?book=<?= $user['id_utilisateur']; ?>">Consulter son profil</a></td>
                    <td><a href="./add_user.php?id_user_update=<?= $user['id_utilisateur']; ?>">Modifier</a></td>
                    <td><a href="traitement/action.php?id_user_delete=<?= $user['id_utilisateur']; ?>">Supprimer</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<?php
include_once "./inc/footer.php";
?>
