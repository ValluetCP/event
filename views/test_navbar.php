<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JS - Test Navbar</title>
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="nav2_container">
        <div class="nav2_menu">
            <ul>
                <li><a href="#" onclick="showList('listeProfil')">Profil</a></li>
                <li><a href="#" onclick="showList('listeAdmin')">Espace Admin</a></li>
                <li><a href="#" onclick="showList('listeClient')">Espace Client</a></li>
            </ul>
        </div>
        <div class="listeProfil hidden">
            <a href="">Informations personnelles</a>
        </div>
        <div class="listeAdmin hidden">
            <a href="">Accueil</a>
            <a href="">liste des catégories</a>
            <a href="">liste des événements</a>
            <a href="">liste des utilisateurs</a>
        </div>
        <div class="listeClient hidden">
            <a href="">Retrouvez nos événements</a>
            <a href="">Vos réservations</a>
        </div>

        <script>
            function showList(listClassName) {
                // Cacher toutes les listes sauf nav2_menu
                var allLists = document.querySelectorAll('.nav2_container div:not(.nav2_menu)');
                allLists.forEach(function(list) {
                    list.classList.add('hidden');
                });

                // Afficher la liste correspondante
                var selectedList = document.querySelector('.' + listClassName);
                selectedList.classList.remove('hidden');
            }
        </script>
    </div>
</body>
</html>
