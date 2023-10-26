<?php
// Page - Affiche un utilisateur (côté ADMIN)

include_once "./inc/header.php";
include_once "./inc/nav.php";
require_once "../models/bookModel.php";
// $listBook = Book::findAllbook();
$bookId = $_GET['book'];
$ficheBook = Book::findBookById($bookId);
?>

<div class="container">
    <h1 class="m-5">Fiche de l'utilisateur (admin)</h1>
    <!-- pour  le comparer avec le nombre de place -->
    <h3>Infos utilisateur</h3>
    <p>identifiant : <?= $ficheBook['id_utilisateur']; ?></p>
    <p>nom : <?= $ficheBook['nom']; ?></p>
    <p>prenom : <?= $ficheBook['prenom']; ?></p>
    <p>pseudo : <?= $ficheBook['pseudo']; ?></p>
    <p>email : <?= $ficheBook['email']; ?></p><br><br>

    <h3>Réservations</h3>
    <table class="table">
        <tr>
            <th>Identifiant</th>
            <th>Titre</th>
        </tr>
        <tr>
            <td><?= $ficheBook['id_evenement']; ?></td>
            <td><?= $ficheBook['titre']; ?></td>
        </tr>
    </table><br><br>

    <h3>Historique</h3>
    <table class="table">
        <tr>
            <th>Identifiant</th>
            <th>Titre</th>
        </tr>
        <tr>
            <td><?= $ficheBook['id_evenement']; ?></td>
            <td><?= $ficheBook['titre']; ?></td>
        </tr>
    </table><br><br>

</div>

<script>

</script>

<?php
include_once "./inc/footer.php";
?>