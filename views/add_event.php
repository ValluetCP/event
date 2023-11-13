<?php
include_once "./inc/header.php";
include_once "./inc/nav.php";
require_once "../models/categorieModel.php";
require_once "../models/eventModel.php";
require_once "../models/bookModel.php";

$listCategorie = Categorie::findAllCategorie();

if (isset($_GET['id_event_update'])) {
    // identifiant de l'emprunt
    $id = $_GET['id_event_update'];
    // appel de la methode returnBook
    $event = Event::findEventById($id);

    // récupérer le nombre total de places réservées
    $totalPlacesReservees = Book::calculReservation($id);
    // calculer le nombre de places disponibles
    $placesDisponibles = $event['nbr_place'] - $totalPlacesReservees;
} else {
    // Si c'est un nouvel événement, initialiser les valeurs
    $totalPlacesReservees = 0;
    $placesDisponibles = 0;
}


?>

<!-- Accès ADMIN - Ajouter un évènement -->

<div class="container">
    <h1 class="m-5">Evénements</h1>
    <h2 class="m-5"><?= !empty($event) ? "Modifier les informations de l'événement" : "Ajouter un événement" ?></h2>
    <form action="./traitement/action.php" method="post" enctype="multipart/form-data">
        
        <div class="form-group  mb-3">
            <label class="m-2" id="titre">titre</label>
            <input type="text" class="form-control"  name="titre" value="<?= !empty($event) ? $event["titre"] : "" ?>">
        </div>
        
        <!-- <div class="form-group  mb-3">
            <label class="m-2" id="duree">Durée</label>
            <input type="text" class="form-control"  name="duree" value="<?= !empty($event) ? $event["duree"] : "" ?>" >
        </div> -->

        <div class="form-group  mb-3">
            <label class="m-2" id="prix">tarif</label>
            <input type="number" class="form-control"  name="prix" value="<?= !empty($event) ? $event["prix"] : "" ?>" >
        </div>
        
        <div class="form-group  mb-3">
            <label class="m-2" id="resume">résumé</label>
            <input type="text" class="form-control"  name="resume" value="<?= !empty($event) ? $event["resume"] : "" ?>" >
        </div>
        
        <div class="form-group  mb-3">
            <label class="m-2" id="date_event">date : </label>
            <input type="date" class="form-control"  name="date_event" value="<?= !empty($event) ? $event["date_event"] : "" ?>" >
        </div>
        
        <div class="form-group  mb-3">
            <label class="m-2" id="nbr_place">nombre de place</label>
            <input type="number" class="form-control"  name="nbr_place" value="<?= !empty($event) ? $event["nbr_place"] : "" ?>">
        </div>
        

        <!-- <div class="form-group  mb-3">
            <label class="m-2" id="image">image</label>
            <input type="file" class="form-control" name="image" class="file" value="<?= !empty($event) ? $event["image"] : "" ?>">
        </div> -->

        <div class="form-group mb-3">
            <label class="m-2" id="image">Image actuelle :</label>
            <?php if (!empty($event['image'])): ?>
                <img src="./asset/img_event/<?=$event['image'] ?>" alt="Image actuelle" class="current-image">
            <?php else: ?>
                <span>Aucune image</span>
            <?php endif; ?>
        </div>

        <div class="form-group mb-3">
            <label class="m-2" id="image">Télécharger une nouvelle image :</label>
            <input type="file" class="form-control" name="image" class="file">
        </div>
  
        <!-- <div class="form-group  mb-3">
            <label class="m-2" id="nbr_place">Nombre de place</label>
            <input type="number" class="form-control"  name="nbr_place" value="<?= !empty($event) ? $event["nbr_place"] : "" ?>" >
        </div> -->
        
        <!-- Table categories (clé étrangère) - récupérer les infos -->
        <div class="form-group mb-3">
            <label class="m-2">Categorie :</label>
            <select name="categorie" class="form-control">

                <?php if(!empty($event)){?>
                    <option value=""><?= $event["categorie_name"]; ?></option>
                <?php }else{?>

                    <option value="">Choisir une categorie</option>
                    <?php foreach($listCategorie as $categorie){ ?>

                        <option value="<?= $categorie['id_categorie']; ?>"><?= $categorie['categorie_name']; ?></option>

                    <?php } 
                    }?>
            </select>
        </div>
        
        <!-- Pour les id se référer à la bdd -->
        <input type="hidden" class="form-control"  name="id_evenement" value="<?= !empty($event) ? $event["id_evenement"] : "" ?>">
        
        <input type="hidden" class="form-control"  name="categorie_id" value="<?= !empty($event) ? $event["categorie_id"] : "" ?>">

        
 
        <button type="submit" class="btn btn-primary mt-5 mb-5" name="<?= !empty($event) ? "update_event" : "add_event" ?>" value="add_event"><?= !empty($event) ? "Sauvegarder" : "Valider" ?></button>
    </form>

    
        <!-- Afficher les informations sur les places -->

        <h2>Infos complémentaires</h2>
        <div class="form-group mb-3">
            <label class="m-2">Nombre total de places réservées :</label>
            <span><?= !empty($totalPlacesReservees) ? $totalPlacesReservees: "0" ?></span>
        </div>

        <div class="form-group mb-3">
            <label class="m-2">Nombre de places disponibles :</label>
            <span><?= $placesDisponibles; ?></span>
        </div>

        <div class="form-group mb-3">
            <label class="m-2">Nombre initial de places :</label>
            <span><?= !empty($event) ? $event['nbr_place'] : ""; ?></span>
        </div>
</div>

<?php
include_once "./inc/footer.php";
?>

