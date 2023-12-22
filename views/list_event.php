<?php
include_once "./inc/header.php";
include_once "./inc/nav.php";
include_once "./inc/functions.php";
require_once "../models/eventModel.php";
require_once "../models/bookModel.php";
require_once "../models/userModel.php";
require_once "../models/categorieModel.php";

$listEvent = Event::findAllEvent();
$userReservation = User::userReservation($_SESSION['id_user']);

// $userReservationIds = array_column($reservations, 'event_id');
$userReservationIds = Book::userReservationIds($_SESSION['id_user']); // Utilisez la nouvelle méthode

$currentDate = date('Y-m-d H:i:s'); // Date actuelle au format SQL (YYYY-MM-DD HH:MM:SS)

foreach ($listEvent as $event) {
    // Récupération des valeurs de categorie_id et categorie_name
    $categories[$event["categorie_id"]] = $event["categorie_name"];
}

// Utilisation de array_unique pour obtenir les valeurs uniques
// $categoriesUniques = array_unique($categories);
?>

<div class="container">
    <h1 class="m-5">Liste des évènements</h1>
    <!-- Ajoutez le formulaire de filtre ici -->
    <form method="get" action="">
        <label for="categorie">Filtrer par catégorie :</label>
        <select name="categorie" id="categorie">
            <option value="">Toutes les catégories</option>
            <?php foreach($categories as $key => $categorie){ ?>
                <option value="<?= $key; ?>"><?= $categorie ?></option>
            <?php } ?>
        </select>
        <button type="submit">Filtrer</button>
    </form>

    <?php
        // Ajoutez ce bloc pour filtrer par catégorie
        $categorieFilter = isset($_GET['categorie']) ? $_GET['categorie'] : null;
        if ($categorieFilter) {
            // $listEvent = Event::findEventsByCategory($categorieFilter);
            $evenementsByCategory = array_filter($listEvent, function ($evenement) use ($categorieFilter) {
                return $evenement['categorie_id'] === (int)$categorieFilter;
            });
        } else{
            $evenementsByCategory = $listEvent;
        }
    ?>
    <!-- pour  le comparer avec le nombre de place -->
    <h2>Prochainement</h2>
    <table class="table">
        <thead>
            <tr>
                <!-- Table Event -->
                <th>Identifiant</th>
                <th>Titre de l'évènement</th>
                <!-- <th>Durée</th> -->
                <th>Tarif</th>
                <!-- <th>Résumé</th> -->
                <!-- <th>Nombre de place</th> -->
                <th>Catégorie</th>
                <th>Action</th>
                <?php if(!empty($_SESSION['id_user'])){ ?>
                <th>Etat</th>
                <?php } ?>
                
                
            </tr>
        </thead>
        <tbody>
            <?php foreach($evenementsByCategory as $event){
                // Comparer la date de l'événement avec la date actuelle, si la date est déjà passé ne l'afficher ici

                if ($event['date_event'] >= $currentDate) { 
                    // Obtenir le nombre total de places réservées pour cet évènement
                    $totalPlacesReservees = Book::calculReservation($event['id_evenement']);   
            ?>
            
                <tr>
                    <td><?= $event['id_evenement']; ?></td>
                    <td><?= $event['titre']; ?></td>
                    <!-- <td><?= $event['duree']; ?></td> -->
                    <td><?= $event['prix']; ?></td>
                    <!-- <td><?= $event['resume']; ?></td> -->
                    <!-- <td><?= $event['nbr_place']; ?></td> -->
                    <td><?= isset($event['categorie_name']) ? $event['categorie_name'] : 'N/A'; ?></td>
                    <td><a class="lien" href="./event.php?event=<?= $event['id_evenement']; ?>">Consulter</a></td>


                    <?php if(!empty($_SESSION['id_user'])){ ?>
                        <?php if(in_array($event['id_evenement'], $userReservationIds) && $event['events_actif'] == 1 && ($totalPlacesReservees >= $event['nbr_place'])){ ?>
                            <td>réservée & complet</td>
                        <?php } elseif(in_array($event['id_evenement'], $userReservationIds) && $event['events_actif'] == 1){ ?>
                            <td>réservée</td>
                        <?php } elseif($totalPlacesReservees >= $event['nbr_place']) { ?>
                            <td>complet</td>
                        <?php } elseif($event['events_actif'] == 0){?>
                            <td>annulation</td>
                        <?php }else{?>
                            <td></td>
                        <?php } ?>
                    <?php } ?>

                    <a href=""></a>

                    <!-- Afficher le nombre total de places réservées -->
                    <!-- <td><?= $totalPlacesReservees; ?></td> -->
                    <!-- <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == "admin"){ ?>
                        <td><a href="./add_event.php?id_event_update=<?= $event['id_evenement']; ?>">Modifier</a></td>
                        <td><a href="traitement/action.php?id_event_delete=<?= $event['id_evenement']; ?>">Supprimer</a></td>
                    <?php } ?>  -->

                    <!-- Ajouter le nombre de particpant par évènement -->
                    
                </tr>
            <?php }
            } ?>
        </tbody>
    </table>

    <h2>Historique</h2>
    <table class="table">
        <thead>
            <tr>
                <!-- Table Event -->
                <th>Identifiant</th>
                <th>Titre de l'évènement</th>
                <!-- <th>Durée</th> -->
                <th>Tarif</th>
                <!-- <th>Résumé</th> -->
                <!-- <th>Nombre de place</th> -->
                <th>Catégorie</th>
                <th>Action</th>  
            </tr>
        </thead>
        <tbody>
            <?php foreach($evenementsByCategory as $event){ 
                // Comparer la date de l'événement avec la date actuelle
                if ($event['date_event'] < $currentDate) { ?>
                    <tr class="event-passe">
                        <td><?= $event['id_evenement']; ?></td>
                        <td><?= $event['titre']; ?></td>
                        <!-- <td><?= $event['duree']; ?></td> -->
                        <td><?= $event['prix']; ?></td>
                        <!-- <td><?= $event['resume']; ?></td> -->
                        <!-- <td><?= $event['nbr_place']; ?></td> -->
                        <td><?= isset($event['categorie_name']) ? $event['categorie_name'] : 'N/A'; ?></td>
                        <!-- <td><?= $event['categorie_name']; ?></td> -->
                        <!-- Ajouter le nombre de particpant par évènement -->
                        <td><a class="lien" href="./event.php?event=<?= $event['id_evenement']; ?>">Consulter</a></td>
                    </tr>
                <?php }
            } ?>
        </tbody>
    </table>
</div>


<?php
$contenuList = "<p>Accedebant enim eius asperitati, ubi inminuta vel laesa amplitudo imperii dicebatur, et iracundae suspicionum quantitati proximorum cruentae blanditiae exaggerantium incidentia et dolere inpendio simulantium, si principis periclitetur vita, a cuius salute velut filo pendere statum orbis terrarum fictis vocibus exclamabant.</p>";
if (isset($_GET['event_nav'])) {
    $eventNav = $_GET['event_nav'];


    switch ($eventNav) {
        case 1:
            $contenuList = '
    <div class="flex">
        <ul class="nav flex" id="filtre">
            <li class="active"><a href="#">Tout</a></li>
            <li><a href="#">Poisson</a></li>
            <li><a href="#">Poulet</a></li>
            <li><a href="#">Legume</a></li>
            <li><a href="#">Crevette</a></li>
            <li><a href="#">Viande</a></li>
        </ul>
    </div>
    <div class="flex bokit" id="portfolio">
        <figure class="poulet">
            <div class="fond_noir">
                <img src="./image/poulet_b_b.jpg" alt="">
            </div>
            <h4><span>poulet</span><br>boucané banane plantain</h4>
            <p>Sauce chien, sauce cocktail, salade, tomate, oignon rouge, cheddar.</p>
            <hr>
        </figure>
        <figure class="poisson">
            <div class="fond_noir">
                <img src="./image/poisson_saumon.jpg" alt="">
            </div>
            <h4><span>SAUMON</span><br>fumée</h4>
            <p>Sauce blanche, salade, tomate, oignon rouge, avocat, parmesan.</p>
            <hr>
        </figure>
        <figure class="poulet">
            <div class="fond_noir">
                <img src="./image/poulet_yassa.jpg" alt="">
            </div>
            <h4><span>poulet</span><br>yassa</h4>
            <p>Salade, tomate, olive, oignon rouge, carotte,moutarde, citron.</p>
            <hr>
        </figure>
        <figure class="poisson">
            <div class="fond_noir">
                <img src="./image/poisson_morue.jpg" alt="">
            </div>
            <h4><span>MORUE</span><br>CHIQUETAILLE</h4>
            <p>Sauce chien, sauce blanche, salade, tomate, oignon rouge, avocat.</p>
            <hr>
        </figure>
        <figure class="poulet">
            <div class="fond_noir">
                <img src="./image/poulet_b_b.jpg" alt="">
            </div>
            <h4><span>poulet</span><br>boucané banane plantain</h4>
            <p>Sauce chien, sauce cocktail, salade, tomate, oignon rouge, cheddar.</p>
            <hr>
        </figure>
        <figure class="poisson">
            <div class="fond_noir">
                <img src="./image/poisson_saumon.jpg" alt="">
            </div>
            <h4><span>SAUMON</span><br>fumée</h4>
            <p>Sauce blanche, salade, tomate, oignon rouge, avocat, parmesan.</p>
            <hr>
        </figure>
        <figure class="poulet">
            <div class="fond_noir">
                <img src="./image/poulet_yassa.jpg" alt="">
            </div>
            <h4><span>poulet</span><br>yassa</h4>
            <p>Salade, tomate, olive, oignon rouge, carotte,moutarde, citron.</p>
            <hr>
        </figure>
        
    </div>';
            break;


        default:
            # code...
            break;
    }
}

?>
<div class="list_event">
    <?= $contenuListList ?>
</div>
<ul class="event_nav">
    <li><a href="?event_nav=1">Prochainement</a></li>
    <li><a href="?event_nav=2">Historique</a></li>
</ul>

<script>

</script>



<?php
include_once "./inc/footer.php";
?>
