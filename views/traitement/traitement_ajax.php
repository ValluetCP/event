<?php
    require_once "../../models/eventModel.php";
    $listEvent = Event::findAllEvent();
    $currentDate = date('Y-m-d H:i:s'); // Date actuelle au format SQL (YYYY-MM-DD HH:MM:SS)

    $tab = [];
    $tab['contenu'] = '';
    $tab['contenu'] .= '<table style="width: 100%; border-collapse: collapse; margin-top: 35px; border: 1px solid black;" border="1">';
    foreach ($listEvent as $event) {
        // Correction ici : comparer avec $nom au lieu de $tabs
        if ($event['date_event'] <= $currentDate) {
           
            $tab['contenu'] .= '<tr>';
            $tab['contenu'] .= '<td style="padding: 10px; border: 1px solid black;">' . $event['id_evenement'] . '</td>';
            $tab['contenu'] .= '<td style="padding: 10px; border: 1px solid black;">' . $event['titre'] . '</td>';
            $tab['contenu'] .= '<td style="padding: 10px; border: 1px solid black;">' . $event['prix'] . '</td>';
            $tab['contenu'] .= '</tr>';
        }
        
    }
    $tab['contenu'] .= '</table>';
    echo json_encode($tab);
?>