
    <nav>
        <!-- <a href="http://localhost/event/index.php">Page d'accueil</a> -->

        <!-- Home  -->
        <a href="http://localhost/event/views/home">Accueil</a>


        <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == "admin"){ ?>


            <!-- --------- Pour les roles 'ADMIN' --------- -->

            
            <!-- Menu principale 'ADMIN' - profil (espace personnelle) -->
            <a href="http://localhost/event/views/home_admin">Espace ADMIN</a>
            <a href="http://localhost/event/views/info_user.php?id=<?= $_SESSION["id_user"]; ?>">Informations personnelles</a>

            <!-- La liste des évènements  -->
            <a href="http://localhost/event/views/admin_list_event">Liste des évènements</a>

            <!-- USER : La liste des évènements (test) -->
            <a href="http://localhost/event/views/list_event">Test_évènements</a>

            <!-- Ajouter un évènement sur la plateforme -->
            <!-- <a href="http://localhost/event/views/add_event.php">Ajouter un évènement</a> -->
            
            <!-- Modifier les informations d'un évènement -->
            <!-- <a href="http://localhost/event/views/modif_event.php">Modifier un évènement</a> -->
            
           <!-- Liste des catégories -->
           <a href="http://localhost/event/views/list_categorie">Liste de catégories</a>
            
            <!-- Ajouter une catégorie -->
            <a href="http://localhost/event/views/add_categorie">Ajouter une categorie</a>
             
            <!-- Modifier une catégorie -->
            <!-- <a href="http://localhost/event/views/modif_categorie.php">Modifier une catégorie</a> -->

           <!-- Liste des utilisateurs -->
           <a href="http://localhost/event/views/list_user">Liste des utilisateurs</a>

           <!-- Se déconnecter  -->
           <a href="http://localhost/event/views/logout">Déconnexion</a>




        <?php } elseif(isset($_SESSION['user_role']) && $_SESSION['user_role'] == "client"){ ?>

            <!-- --------- Pour les roles 'CLIENT' --------- -->


            <!-- Menu principale 'CLIENT' - profil (espace personnelle) -->
            <a href="http://localhost/event/views/home_client">Espace CLIENT</a>
            <a href="http://localhost/event/views/info_user">Informations personnelles</a>


            <!-- Sous-Menu 'CLIENT'  -->

            <!-- La liste des évènements auxquels il participe (consulter, modifier et annuler) -->
            <a href="http://localhost/event/views/list_book">Mes réservations</a>
            <!-- <a href="http://localhost/event/views/panier.php">Panier</a> -->
            <!-- <a href="http://localhost/event/views/panier_0.php">-P-</a> -->
            <a href="http://localhost/event/views/panier_0.php">Panier(<?= $_SESSION["nombre"] ?? ''; ?>)</a>
            <a href="http://localhost/event/views/ajax_list_event">Test AJAX</a>

            <a href="http://localhost/event/views/facture">Facture</a>
            
            <!-- Les favoris  -->
            <!-- <a href="http://localhost/event/views/list_favoris">Liste des favoris</a> -->
            
            <!-- Liste des historiques -->
            <!-- <a href="http://localhost/event/views/list_historique">Liste des historiques</a> -->
              

            <!-- ---------IDEM (valable pour client et admin)--------- -->

            <!-- La liste des évènements  -->
            <a href="http://localhost/event/views/list_event">Liste des évènements</a>

            <!-- Se déconnecter  -->
            <a href="http://localhost/event/views/logout">Déconnexion</a>

            
        <?php } else { ?>
            
            <!-- S'incrire  -->
            <a href="http://localhost/event/views/inscription">Inscription</a>

            <!-- Se connecter  -->
            <a href="http://localhost/event/views/connexion">Connexion</a>

            <!-- Réservations  -->
            <a href="http://localhost/event/views/connexion" data-bs-toggle="modal" data-bs-target="#exampleModal">Réservations</a>
        <?php } ?>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Une inscription?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>
                Pour participer à nos événements , vous devez être détenteur d’un compte. Veuillez vous connecter ou bien vous inscrire.
                </p>
              </div>
              <div class="modal-footer">
                <a class="btn btn-primary" href="../inscription.php" role="button">Je m'inscris</a>
                <a class="btn btn-primary" href="../connexion.php" role="button">Je me connecte</a>
              </div>
            </div>
          </div>
        </div>

        <!-- PANIER ICONE -->
        <ul>
          <li class="nav-item active">
              <a class="nav-link" href="http://localhost/event/views/panier_0">
                  <i class="fa fa-shopping-cart"></i>
                  <div id="nombre"><?= $_SESSION["nombre"] ?? ''; ?></div>
              </a>
          </li>
        </ul>
</nav>