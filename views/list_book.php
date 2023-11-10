<?php
include_once "./inc/header.php";
include_once "./inc/nav.php";
require_once "../models/bookModel.php";
// $listEvent = Event::findAllEvent();
$bookList = Book::findAllBookByIdUser();
?>

<div class="container">
    <h1 class="m-5">Liste de mes réservations</h1>
    <!-- pour  le comparer avec le nombre de place -->

    <table class="table">
        <thead>
            <tr>
                <!-- Table Event -->
                <th>Date</th>
                <th>Titre</th>
                <th>Catégorie</th>
                <th>Résumé</th>
                <th>Prix</th>
                <th>Nombre de place</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach($bookList as $book){ ?>
                <tr>
                    <td><?= date('d-m-Y', strtotime($book['date_event']));  ?></td>
                    <td><?= $book['titre']; ?></td>
                    <td><?= $book['categorie_name']; ?></td>
                    <td><?= $book['resume']; ?></td>
                    <td><?= $book['prix']; ?></td>
                    <td><?= $book['place_reserve']; ?></td>
                    <!-- Ajouter le nombre de particpant par évènement -->
                   <td><a class="lien" href="./event.php?event=<?= $book['id_evenement']; ?>">Consulter</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>

</script>

<?php
include_once "./inc/footer.php";
?>