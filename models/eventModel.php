<?php

require_once __DIR__."/database.php";

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
        $request = $db->prepare("SELECT * FROM `events` e LEFT JOIN categorie c ON e.categorie_id = c.id_categorie;");

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

