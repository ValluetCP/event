<?php
session_start();

require_once $_SERVER["DOCUMENT_ROOT"]."/event/models/database.php";

class Event{
    // pour la méthode static, pas besoin de déclarer une variable à l'inverse des contructeurs

    // methode pour inscrire un évènement
    public static function addEvent($statut,$nom,$prenom,$pseudo,$email,$password,$role){

        // on appel la fonction dbConnect qui est dans la class Database
        $db = Database::dbConnect();

        // preparation de la requête
        $request =$db->prepare("INSERT INTO `users`(`nom`, `prenom`, `pseudo`, `email`, `mdp`, `role`, `statut`) VALUES (?,?,?,?,?,?,?)");

        // exécuter la requête
        try {
            $request->execute(array($nom,$prenom,$pseudo,$email,$password,$role,$statut));

            // rediriger vers la page list_user.php
            header("Location: http://localhost/event/views/list_user.php");
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}