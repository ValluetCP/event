
    <nav>
        <a href="http://localhost/event/index.php">Page d'accueil</a>

        <?php if(isset($_COOKIE['user_role']) && $_COOKIE['user_role'] == "admin"){ ?>

            <!-- --------- Pour les roles 'ADMIN' --------- -->


            <!-- Menu principale 'ADMIN' - profil -->
            <a href="http://localhost/event/views/admin.php">Administrateur</a>

            <!-- Ajouter un évènement sur la plateforme -->
            <a href="http://localhost/event/views/add_event.php">Ajouter un évènement</a>
            
            <!-- Modifier les informations de l'évènement -->
            <a href="http://localhost/event/views/modif_event.php">Modifier un évènement</a>
            
            <!-- Modifier les informations de l'évènement -->
            <a href="http://localhost/event/views/add_categorie.php">Ajouter une categorie</a>
             
            <!-- Modifier les informations de l'évènement -->
            <a href="http://localhost/event/views/modif_categorie.php">Modifier une catégorie</a>
             
            <!-- Modifier les informations de l'évènement -->
            <a href="http://localhost/event/views/list_categorie.php">Liste de catégorie</a>


            <!-- -------- IDEM (valable pour admin et client )-------- -->

            <!-- La liste des évènements  -->
            <a href="http://localhost/event/views/list_event.php">Liste des évènements</a>

            <a href="http://localhost/event/views/inscription.php">Inscription</a>

            <a href="http://localhost/event/views/connexion.php">Connexion</a>
            
            <!-- La liste des évènements  -->
            <a href="http://localhost/event/views/list_event.php">Liste des évènements</a>

        <?php }else { ?>




            <!-- --------- Pour les roles 'CLIENT' --------- -->


            <!-- Menu principale 'CLIENT' - profil  -->
            <a href="http://localhost/event/views/profil.php">Mon profil</a>


            <!-- Sous-Menu 'CLIENT'  -->

            <!-- La liste des évènements auxquels il participe (consulter, modifier et annuler) -->
            <a href="http://localhost/event/views/my_event.php">Mes évènements</a>
            
            <!-- Les favoris  -->
            <a href="http://localhost/event/views/list_favoris">Liste des favoris</a>
            
            <!-- Liste des historiques -->
            <a href="http://localhost/event/views/list_historique">Liste des historiques</a>
              

            <!-- ---------IDEM (valable pour client et admin)--------- -->

            <!-- La liste des évènements  -->
            <a href="http://localhost/event/views/list_event">Liste des évènements</a>

            <!-- S'incrire  -->
            <a href="http://localhost/event/views/inscription.php">Inscription</a>

            <!-- Se connecter  -->
            <a href="http://localhost/event/views/connexion.php">Connexion</a>
 

        <?php } ?>
    </nav>