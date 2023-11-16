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
                        header("Location: http://localhost/event/views/list_event.php");
            
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
            $request = $db->prepare("SELECT *, SUM(place_reserve) FROM `events` e LEFT JOIN categorie c ON e.categorie_id = c.id_categorie LEFT JOIN reservation r ON e.id_evenement = r.event_id GROUP BY titre ORDER BY e.date_event ASC;");

            // exécuter la requête
            $eventList = null;
            try {
                $request->execute([]);

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
            $request->execute(array($id));;
            // recuperer le resultat dans un tableau
            $event = $request->fetch();
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


    
    // methode pour supprimer une categorie
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

}

