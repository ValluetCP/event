
    <nav>
        <!-- <a href="http://localhost/event/index.php">Page d'accueil</a> -->

        <!-- Home  -->
        <a href="http://localhost/event/views/home.php">Accueil</a>


        <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == "admin"){ ?>


            <!-- --------- Pour les roles 'ADMIN' --------- -->

            
            <!-- Menu principale 'ADMIN' - profil (espace personnelle) -->
            <a href="http://localhost/event/views/home_admin.php">Espace ADMIN</a>
            <a href="http://localhost/event/views/info_user.php?id=<?= $_SESSION["id_user"]; ?>">Informations personnelles</a>

            <!-- La liste des évènements  -->
            <a href="http://localhost/event/views/admin_list_event.php">Liste des évènements</a>

            <!-- Ajouter un évènement sur la plateforme -->
            <!-- <a href="http://localhost/event/views/add_event.php">Ajouter un évènement</a> -->
            
            <!-- Modifier les informations d'un évènement -->
            <!-- <a href="http://localhost/event/views/modif_event.php">Modifier un évènement</a> -->
            
           <!-- Liste des catégories -->
           <a href="http://localhost/event/views/list_categorie.php">Liste de catégories</a>
            
            <!-- Ajouter une catégorie -->
            <a href="http://localhost/event/views/add_categorie.php">Ajouter une categorie</a>
             
            <!-- Modifier une catégorie -->
            <!-- <a href="http://localhost/event/views/modif_categorie.php">Modifier une catégorie</a> -->

           <!-- Liste des utilisateurs -->
           <a href="http://localhost/event/views/list_user.php">Liste des utilisateurs</a>

           <!-- Se déconnecter  -->
           <a href="http://localhost/event/views/logout.php">Déconnexion</a>




        <?php } elseif(isset($_SESSION['user_role']) && $_SESSION['user_role'] == "client"){ ?>

            <!-- --------- Pour les roles 'CLIENT' --------- -->


            <!-- Menu principale 'CLIENT' - profil (espace personnelle) -->
            <a href="http://localhost/event/views/home_client.php">Espace CLIENT</a>
            <a href="http://localhost/event/views/info_user.php">Informations personnelles</a>


            <!-- Sous-Menu 'CLIENT'  -->

            <!-- La liste des évènements auxquels il participe (consulter, modifier et annuler) -->
            <a href="http://localhost/event/views/my_event.php">Mes réservations</a>
            
            <!-- Les favoris  -->
            <!-- <a href="http://localhost/event/views/list_favoris">Liste des favoris</a> -->
            
            <!-- Liste des historiques -->
            <!-- <a href="http://localhost/event/views/list_historique">Liste des historiques</a> -->
              

            <!-- ---------IDEM (valable pour client et admin)--------- -->

            <!-- La liste des évènements  -->
            <a href="http://localhost/event/views/list_event">Liste des évènements</a>

            <!-- Se déconnecter  -->
            <a href="http://localhost/event/views/logout.php">Déconnexion</a>

            
            <?php } else { ?>
                
                <!-- S'incrire  -->
                <a href="http://localhost/event/views/inscription.php">Inscription</a>
    
                <!-- Se connecter  -->
                <a href="http://localhost/event/views/connexion.php">Connexion</a>
    
                <!-- Réservations  -->
                <a href="http://localhost/event/views/connexion.php">Réservations</a>
        <?php } ?>
    </nav>