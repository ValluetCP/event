<?php
session_start();

require_once $_SERVER["DOCUMENT_ROOT"]."/event/models/database.php";

class Event{
    // pour la méthode static, pas besoin de déclarer une variable à l'inverse des contructeurs

    // methode pour inscrire un évènement
    public static function addEvent($titre,$duree,$prix,$resume,$nbr_place,$categorie_id){

        // on appel la fonction dbConnect qui est dans la class Database
        $db = Database::dbConnect();

        // preparation de la requête
        $request =$db->prepare("INSERT INTO `events`(`titre`, `duree`, `prix`, `resume`, `nbr_place`, `categorie_id`) VALUES (?,?,?,?,?,?)");

        // exécuter la requête
        try {
            $request->execute(array($titre,$duree,$prix,$resume,$nbr_place,$categorie_id));

            // rediriger vers la page list_user.php
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

        // preparation de la requête
        $request = $db->prepare("SELECT * FROM `events`");

        // exécuter la requête
        $eventList = null;
        try {
            $request->execute();

            // récupère le résultat dans un tableau
            $eventList = $request->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $eventList;
    }

    // methode pour changer à partir de l'id 
    // ADMIN -  modifier un évènement
    public static function updateEventById($id,$titre,$duree,$prix,$resume,$nbr_place,$categorie_id){
        
        // on appel la fonction dbConnect qui est dans la class Database
        $db = Database::dbConnect();

        // preparation de la requête
        $request =$db->prepare("UPDATE events SET titre = ?, duree = ?, prix = ?, resume = ?, nbr_place = ?, categorie_id = ? WHERE id_evenement = ? ");

        // exécuter la requête
        try {
            $request->execute(array($titre,$duree,$prix,$resume,$nbr_place,$categorie_id,$id));

            // rediriger vers la page list_event.php
            header("Location: http://localhost/event/views/list_event.php");
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

}