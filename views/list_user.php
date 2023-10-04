<?php
include_once "./inc/header.php";
include_once "./inc/nav.php";
require_once "../models/userModel.php";
$userList = User::findAllUser();
?>

<div class="container">
    <h1 class="m-5">Liste des utilisateurs</h1>
    <!-- pour  le comparer avec le nombre de place -->

    <table class="table">
        <thead>
            <tr>
                <!-- Table user -->
                <th>Identifiant</th>
                <th>Nom</th>
                <th>Prénom</th>
                
                <!-- Table event -->
                <th>Categorie</th>
                <th>Titre</th>
                
                <!-- Table date et heure -->
                <th>Date</th>
                <th>Heure</th>

                <!-- Table modification et suppression -->
                <th>Update</th>
                <th>Delete</th>
                <!-- (par exemple : si l'event est annulé ou reporté) -->
                
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
                    <td><a href="./add_actor.php?id_Acteur=<?= $actor['id_actor']; ?>">Update</a></td>
                    <td><a href="traitement/action.php?id_Acteur_delete=<?= $actor['id_actor']; ?>">Delete</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<?php
include_once "./inc/footer.php";
?>
