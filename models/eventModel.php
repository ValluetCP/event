<?php
// session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . "/event/models/database.php";
// require_once __DIR__."/database.php";

class Event{
    // pour la méthode static, pas besoin de déclarer une variable à l'inverse des contructeurs

    // methode pour inscrire un évènement
    public static function addEvent($titre,$prix,$resume,$dateEvent,$nbrPlace,$categorie_id,$imgName){

        // on appel la fonction dbConnect qui est dans la class Database
        $db = Database::dbConnect();

        // preparation de la requête
        $request =$db->prepare("INSERT INTO `events`(`titre`, `prix`, `resume`, `categorie_id`, `image`, `date_event`, `nbr_place`) VALUES (?,?,?,?,?,?,?)");

        // exécuter la requête
        try {
            $request->execute(array($titre,$prix,$resume,$categorie_id,$imgName,$dateEvent,$nbrPlace,));

            // rediriger vers la page list_user.php
            // header("Location: http://localhost/event/views/list_event.php");
            if($_SESSION['user_role'] == 'admin')                    
                        header("Location: http://localhost/event/views/admin_list_event.php");
                    else 
                        header("Location: http://localhost/event/views/list_book.php");
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    // methode pour tout afficher les évènements
    public static function findAllEvent()
    {

        // on appel la fonction dbConnect qui est dans la class Database
        $db = Database::dbConnect();
        if(empty($_SESSION['id_user'])){
            // preparation de la requête
            $request = $db->prepare("SELECT * FROM `events` e LEFT JOIN categorie c ON e.categorie_id = c.id_categorie ORDER BY e.date_event ASC");

            // Pour les utilisateurs non connectés
            // $request = $db->prepare("SELECT e.*, c.categorie_name FROM `events` e LEFT JOIN categorie c ON e.categorie_id = c.id_categorie ORDER BY e.date_event ASC");

            // exécuter la requête
            $eventList = null;
            try {
                $request->execute();

                // récupère le résultat dans un tableau
                $eventList = $request->fetchAll(PDO::FETCH_ASSOC);
            }catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        else {
            // preparation de la requête
            $request = $db->prepare("SELECT *, SUM(place_reserve) FROM `events` e LEFT JOIN categorie c ON e.categorie_id = c.id_categorie LEFT JOIN reservation r ON e.id_evenement = r.event_id GROUP BY titre ORDER BY e.date_event ASC");

            // Pour les utilisateurs connectés
            // $request = $db->prepare("SELECT e.*, c.categorie_name, SUM(r.place_reserve) as total_places_reserved FROM `events` e LEFT JOIN categorie c ON e.categorie_id = c.id_categorie LEFT JOIN reservation r ON e.id_evenement = r.event_id GROUP BY e.id_evenement ORDER BY e.date_event ASC");

            // exécuter la requête
            $eventList = null;
            try {
                $request->execute();

                // récupère le résultat dans un tableau
                $eventList = $request->fetchAll(PDO::FETCH_ASSOC);
            }catch (PDOException $e) {
                echo $e->getMessage();
            }
        }        
        
        return $eventList;
    }

    
    // methode pour rechercher un évènement par id
    public static function findEventById($id)
    {
        $db = Database::dbConnect();

        // preparer la requete
        $request = $db->prepare("SELECT * FROM events e LEFT JOIN categorie c ON e.categorie_id = c.id_categorie WHERE id_evenement=?");
        //executer la requete
        try {
            $request->execute(array($id));
            // recuperer le resultat dans un tableau
            $event = $request->fetch(PDO::FETCH_ASSOC);
            return $event;

        } catch (PDOException $e) {
            $e->getMessage();
        }
    }


    // // methode pour changer à partir de l'id 
    // // ADMIN -  modifier un évènement
    // public static function updateEventById($id,$titre,$prix,$resume,$dateEvent,$nbrPlace,$categorie_id){
        
    //     // on appel la fonction dbConnect qui est dans la class Database
    //     $db = Database::dbConnect();

    //     // preparation de la requête
    //     $request =$db->prepare("UPDATE events SET titre = ?, prix = ?, resume = ?, categorie_id = ?, date_event = ?, nbr_place = ? WHERE id_evenement = ? ");

    //     // exécuter la requête
    //     try {
    //         $request->execute(array($titre,$prix,$resume,$categorie_id,$dateEvent,$nbrPlace,$id));


    //         // rediriger vers la page list_event.php
    //         header("Location: http://localhost/event/views/admin_list_event.php");

            
    //     } catch (PDOException $e) {
    //         echo $e->getMessage();
    //     }

    // }



    public static function updateEventById($id, $titre, $prix, $resume, $dateEvent, $nbrPlace, $categorie_id) {

        $db = Database::dbConnect();
    
        // Vérifiez si un fichier est téléchargé
        if (!empty($_FILES['image']['name'])) {
            $imgName = $_FILES['image']['name'];
            $tmpName = $_FILES['image']['tmp_name'];
            $destination = $_SERVER['DOCUMENT_ROOT'] . '/event/views/asset/img_event/' . $imgName;
            
            // Assurez-vous de gérer les erreurs lors du téléchargement du fichier
            if (move_uploaded_file($tmpName, $destination)) {
                // Mise à jour du chemin de l'image dans la base de données
                $request = $db->prepare("UPDATE events SET titre = ?, prix = ?, resume = ?, categorie_id = ?, date_event = ?, nbr_place = ?, image = ? WHERE id_evenement = ?");
                $request->execute([$titre, $prix, $resume, $categorie_id, $dateEvent, $nbrPlace, $imgName, $id]);
                // rediriger vers la page list_event.php
                header("Location: http://localhost/event/views/admin_list_event.php");
            } else {
                // Gestion de l'erreur de téléchargement
                echo "Erreur lors du téléchargement de l'image.";
            }
        } else {
            // Aucune nouvelle image, mise à jour sans modifier le champ image
            $request = $db->prepare("UPDATE events SET titre = ?, prix = ?, resume = ?, categorie_id = ?, date_event = ?, nbr_place = ? WHERE id_evenement = ?");
            $request->execute([$titre, $prix, $resume, $categorie_id, $dateEvent, $nbrPlace, $id]);
            // rediriger vers la page list_event.php
            header("Location: http://localhost/event/views/admin_list_event.php");
        }
    }


    
    // methode pour désactiver un évènement 
    public static function desactiveEventById($id)
    {
        $db = Database::dbConnect();

        // preparer la requete
        $request = $db->prepare("UPDATE events SET events_actif = ? WHERE id_evenement=?");
        //executer la requete

        try {
            $request->execute([0, $id]);
            // recuperer le resultat dans un tableau
            header("Location: http://localhost/event/views/admin_list_event.php");
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    
    // methode pour supprimer un évènement de la bdd
    public static function deleteEventById($id)
    {
        $db = Database::dbConnect();

        // preparer la requete
        $request = $db->prepare("DELETE FROM events WHERE id_evenement=?");
        
        //executer la requete
        try {
            $request->execute(array($id));
            // recuperer le resultat dans un tableau
            header("Location: http://localhost/event/views/admin_list_event.php");
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    
    // methode pour activer un évènement 
    public static function activeEventById($id)
    {
        $db = Database::dbConnect();

        // preparer la requete
        $request = $db->prepare("UPDATE events SET events_actif = ? WHERE id_evenement=?");
        //executer la requete

        try {
            $request->execute([1, $id]);
            // recuperer le resultat dans un tableau
            header("Location: http://localhost/event/views/admin_list_event.php");
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }


    public static function findEventsByCategory($categoryId) {
        $db = Database::dbConnect();
        $request = $db->prepare("SELECT * FROM events WHERE categorie_id =?");
        try {
            $request->execute([$categoryId]);
            return $request->fetchAll(PDO::FETCH_ASSOC);
            // recuperer le resultat dans un tableau
            header("Location: http://localhost/event/views/admin_list_event.php");
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    // public static function findEventsByCategory($categoryId) {
    //     $db = Database::dbConnect();
    //     $sql = "SELECT * FROM events WHERE categorie_id = :categorie";
    //     $stmt = $db->prepare($sql);
    //     $stmt->bindParam(':categorie', $categoryId, PDO::PARAM_INT);
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }


    public static function addPanier() {

        if (isset($_POST['add_panier'])) {
        extract($_POST);
        // Extraction des données du formulaire - Cela signifie que les valeurs des champs du formulaire deviennent des variables accessibles directement (par exemple, $qte, $id, etc.).

        //Récupération de la quantité et des détails de l'événement 
        $quantite = $_POST["qte"] ?: 1;
        $products = Event::findEventById($_POST[$id]);
    
        // Gestion du panier dans la session
        // Ces lignes vérifient si la clé 'commandes' existe dans la session. Si elle n'existe pas, un tableau vide est créé. Ensuite, le panier est récupéré à partir de la session
        if( !array_key_exists('commandes', $_SESSION) ){
                $_SESSION['commandes'] = [];
            }
           
            $panier = $_SESSION['commandes'];        
    
            // Ajout de l'événement au panier 
            $productsDejaDansPanier = false;
            foreach ($panier as $indice => $ligne) {
                if ($products->getId() == $ligne["products"]->getId()) {
                    $panier[$indice]["quantite"] += $quantite;
                    $productsDejaDansPanier = true;
                    break;  // pour sortir de la boucle foreach
                }
            }
    
            if (!$productsDejaDansPanier) {
                $panier[] = ["quantite" => $quantite, "products" => $products];  // on ajoute une ligne au panier => $panier est un array d'array
            }
    
            // Mise à jour du panier dans la session
            $_SESSION['commandes'] = array_merge($_SESSION['commandes'] , $panier); // je remets $panier dans la session, à l'indice 'panier'

            // Calcul du nombre total d'articles dans le panier :
            $nb = 0;
            foreach ($panier as $ligne) {
                $nb += $ligne["quantite"];
            }
    
            // on verra la redirection plutard
            // return $nb;
        }
    
    }


    // Dans votre classe Event (eventmodel.php)
    public static function findSelectedEvents($userId)
    {
        // Vérifiez si l'utilisateur est connecté
        if (empty($userId)) {
            return array();  // Si l'utilisateur n'est pas connecté, retournez un tableau vide
        }

        // Connexion à la base de données
        $db = Database::dbConnect();

        // Préparation de la requête pour récupérer les événements sélectionnés par l'utilisateur
        $request = $db->prepare("SELECT e.* FROM `events` e
                                JOIN reservation r ON e.id_evenement = r.event_id
                                WHERE r.user_id = :userId");

        // Liaison des paramètres
        $request->bindParam(':userId', $userId, PDO::PARAM_INT);

        // Exécution de la requête
        $selectedEvents = array();
        try {
            $request->execute();

            // Récupération des résultats dans un tableau associatif
            $selectedEvents = $request->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $selectedEvents;
    }


}

