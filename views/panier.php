<?php
// Assurez-vous que la session est démarrée

include_once "./inc/header.php";
include_once "./inc/nav.php";

// Inclure le fichier eventmodel.php
require_once "../models/bookModel.php";
require_once "../models/eventModel.php"; // Ajoutez cette ligne pour inclure la classe Event


// Récupérer la liste des événements sélectionnés par l'utilisateur
if (!empty($_SESSION['id_user'])) {
    // Utilisateur connecté
    $selectedEvents = Event::findSelectedEvents($_SESSION['id_user']);
} else {
    // Utilisateur non connecté
    $selectedEvents = array();  // Si l'utilisateur n'est pas connecté, la liste est vide par défaut
}

// Afficher la liste des événements sélectionnés
foreach ($selectedEvents as $event) {
    echo "Titre : " . $event['titre'] . "<br>";
    // ... autres détails de l'événement
    echo "<br>";
}

// Vous pouvez également utiliser $selectedEvents comme bon vous semble dans le reste de votre script
?>


<?php
include_once "./inc/footer.php";
?>
