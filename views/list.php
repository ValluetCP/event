<?php
include_once "./inc/header.php";
include_once "./inc/nav.php";
require_once "../models/classModel.php";
$filmList = NomDeLaClass::nomMethod();
?>

<div class="container">
    <h1 class="m-5">Liste de film</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Id Movie</th>
                <th>Title</th>
                <th>Number main actors</th>
                <th>number_total_actors</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($filmList as $film){ ?>
                <tr>
                    <td><?= $film['id_movie']; ?></td>
                    <td><?= $film['title']; ?></td>
                    <td><?= $film['number_main_actors']; ?></td>
                    <td><?= $film['number_total_actors']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<?php
include_once "./inc/footer.php";
?>