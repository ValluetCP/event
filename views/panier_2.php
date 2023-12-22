<?php
include_once "./inc/header.php";
include_once "./inc/nav.php";
include_once "./inc/functions.php";
// Inclure le fichier contenant la classe Book
require_once "../models/bookModel.php";
require_once "../models/eventModel.php"; // Ajoutez cette ligne pour inclure la classe Event


    

    // Afficher les éléments du panier?>
        <?php foreach ($panierItems as $itemId => $itemDetails) { ?>
            
                <div>
                    <p>Titre de l'événement :<?= $itemDetails['eventDetails']['titre']; ?></p>
                    
                    
                    <p>Quantité :<?= $itemDetails['quantity']; ?></p>
                </div>
                <input type="hidden" name="id_evenement" value="<?= $itemDetails['eventDetails']['id_evenement']; ?>">
                <input type="hidden" name="quantity" value="<?= $itemDetails['quantity']; ?>">
                <a href="./event.php?event=<?= $itemDetails['eventDetails']['id_evenement']; ?>">Voir détail</a>
        <?php } 
        

        // Afficher le montant total en bas de la page
        echo "Montant total : " . $totalMontant . "<br>";?>

        <button type="submit" class="btn btn-outline-warning mt-3 mb-5" name="valider_panier" >Valider</button>

<?php 

// ... Le reste de votre code panier.php ...
?>
</a>