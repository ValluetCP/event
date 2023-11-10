<?php
include_once "./inc/header.php";
include_once "./inc/nav.php";
require_once "../models/bookModel.php";
// $listEvent = Event::findAllEvent();
$bookList = Book::findAllBook();
?>

<div class="container">
    <h1 class="m-5">Liste de mes réservations</h1>
    <!-- pour  le comparer avec le nombre de place -->

    <table class="table">
        <thead>
            <tr>
                <!-- Table Event -->
                <th>Titre de l'évènement</th>
                <!-- <th>Catégorie</th> -->
                <th>Résumé</th>
                <th>Prix</th>
                <!-- <th>Nombre de place</th> -->
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach($bookList as $book){ ?>
                <tr>
                    <td><?= $book['titre']; ?></td>
                    <td><?= $book['categorie_name']; ?></td>
                    <td><?= $book['resume']; ?></td>
                    <td><?= $book['prix']; ?></td>
                    <!-- <td><?= $book['nbr_place']; ?></td> -->
                    <!-- Ajouter le nombre de particpant par évènement -->
                    <?php if(!empty($_POST['add_book'])){ ?>
                            <td><?= $_POST['nb_place']; ?></td>
                    <?php }  ?>                      

                    
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