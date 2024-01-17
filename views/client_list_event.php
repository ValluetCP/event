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
} ?>

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

        $contenuList = '';  // Réinitialisez la variable $contenuList
                
        // Intégrez le code pour les événements à venir
        $contenuList .= '<h2>Prochainement</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Identifiant</th>
                    <th>Titre de l\'évènement</th>
                    <th>Tarif</th>
                    <th>Catégorie</th>
                    <th>Action</th>';
                    
        if (!empty($_SESSION['id_user'])) {
            $contenuList .= '<th>Etat</th>';
        }
    
        $contenuList .= '</tr>
            </thead>
            <tbody>';
    
        foreach ($evenementsByCategory as $event) {
            if ($event['date_event'] >= $currentDate) {
                $totalPlacesReservees = Book::calculReservation($event['id_evenement']);
                $contenuList .= '<tr>
                    <td>' . $event['id_evenement'] . '</td>
                    <td>' . $event['titre'] . '</td>
                    <td>' . $event['prix'] . '</td>
                    <td>' . (isset($event['categorie_name']) ? $event['categorie_name'] : 'N/A') . '</td>
                    <td><a class="lien" href="./event.php?event=' . $event['id_evenement'] . '">Consulter</a></td>';
    
                if (!empty($_SESSION['id_user'])) {
                    if (in_array($event['id_evenement'], $userReservationIds) && $event['events_actif'] == 1 && ($totalPlacesReservees >= $event['nbr_place'])) {
                        $contenuList .= '<td>réservée & complet</td>';
                    } elseif (in_array($event['id_evenement'], $userReservationIds) && $event['events_actif'] == 1) {
                        $contenuList .= '<td>réservée</td>';
                    } elseif ($totalPlacesReservees >= $event['nbr_place']) {
                        $contenuList .= '<td>complet</td>';
                    } elseif ($event['events_actif'] == 0) {
                        $contenuList .= '<td>annulation</td>';
                    } else {
                        $contenuList .= '<td></td>';
                    }
                }
    
                $contenuList .= '</tr>';
            }
        }
    
        $contenuList .= '</tbody>
        </table>';
    


    if (isset($_GET['event_nav'])) {
        $eventNav = $_GET['event_nav'];
    
        switch ($eventNav) {
            case 2:
                $contenuList = '';  // Réinitialisez la variable $contenuList
    
                // Intégrez le code pour l'historique
                $contenuList .= '<h2>Historique</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Identifiant</th>
                            <th>Titre de l\'évènement</th>
                            <th>Tarif</th>
                            <th>Catégorie</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
    
                foreach ($evenementsByCategory as $event) {
                    if ($event['date_event'] < $currentDate) {
                        $contenuList .= '<tr class="event-passe">
                            <td>' . $event['id_evenement'] . '</td>
                            <td>' . $event['titre'] . '</td>
                            <td>' . $event['prix'] . '</td>
                            <td>' . (isset($event['categorie_name']) ? $event['categorie_name'] : 'N/A') . '</td>
                            <td><a class="lien" href="./event.php?event=' . $event['id_evenement'] . '">Consulter</a></td>
                        </tr>';
                    }
                }
    
                $contenuList .= '</tbody>
                </table>';
                break;
                
                
            default:
                # code...
                break;
        }
    }
    

    ?>

    <div class="list_event">
        <?= $contenuList ?>
    </div>
    <ul class="event_nav">
        <li><a href="?event_nav=1">Prochainement</a></li>
        <li><a href="?event_nav=2">Historique</a></li>
    </ul>
</div>

<script>

</script>



<?php
include_once "./inc/footer.php";
?>