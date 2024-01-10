<?php
include_once "./inc/header.php";
include_once "./inc/nav.php";
include_once "./inc/functions.php";
require_once "../models/eventModel.php";
$listEvent = Event::findAllEvent();
$currentDate = date('Y-m-d H:i:s'); // Date actuelle au format SQL 
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Event avec AJAX(Json)</title>
</head>

<body>
    <div>
       <div class="menu_event">
           <a href="" id="reinitialiser_resultat">Prochainement</a>
           <a href="" id="prochain_event">Historique</a>
            <div class="prochain">
                <!-- Div vide pour afficher le contenu -->
                <div id="resultat">
                    <table style="width: 100%; border-collapse: collapse; margin-top: 35px; border: 1px solid black;">
                    <?php foreach ($listEvent as $event) { 
                            if ($event['date_event'] >= $currentDate) { ?>
                                <tr>
                                    <td style="padding: 10px; border: 1px solid black;"><?= $event['id_evenement']; ?></td>
                                    <td style="padding: 10px; border: 1px solid black;"><?= $event['titre']; ?></td>
                                    <td style="padding: 10px; border: 1px solid black;"><?= $event['prix']; ?></td>
                                </tr>
                            <?php }
                        } ?>
                    </table>
                </div>
            </div>
            
       </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    
    <script>

        // Stocker le contenu initial de la div resultat
        var contenuInitial = $('#resultat').html();

        // Dès que la page sera complètement chargée, que le DOM (Document Objet Modèle) sera entièrement généré
        $(document).ready(function() {

            // a) utiliser la fonction on('change') de jquery afin de sélectionner un nom dans la liste déroulante : $('#personne').on('change', function()
            $('#prochain_event').on('click', function(event) {
                event.preventDefault()

                // c) Sérialiser le contenu des champs du formulaire (dans cet exemple il y a un seul champ), à l'aide de la fonction serialize() de jQuery
                

                // d) utiliser la méthode ajax de jquery pour l'affichage de la réponse
                $.ajax({
                    url: "traitement/traitement_ajax.php", // le fichier cible, celui qui fera le traitement (projet : mettre le chemin que l'on aurait mis dans la balise <a>)
                    type: "GET", // la méthode utilisée (projet : ne rien mettre, par défaut on sera sur la method GET)
                    // les paramètres à fournir ex : ...id=4&nom=anonyme...(projet : on ne met rien) 
                    dataType: 'json', // le format des données attendues en tableau JSON pour être interprété et éxécuté par AJAX (projet : 'json') 
                    success: function(response) {
                        // la fonction qui doit s'exécuter lors de la réussite de la communication ajax 
                        console.log(response);
                        $('#resultat').html(response.contenu);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });
            });

            // Réinitialiser la div resultat à son contenu initial
    $('#reinitialiser_resultat').on('click', function(event) {
        event.preventDefault();
        $('#resultat').html(contenuInitial);
    });


        });
    </script>

</body>

</html>