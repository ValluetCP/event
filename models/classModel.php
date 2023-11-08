<?php

// require_once $_SERVER["DOCUMENT_ROOT"]."/chemin_base_de_donnee.php";
// Autre syntaxe
require_once __DIR__."/chemin_base_de_donnee.php";

class NomDeLaClass{

    // pour la méthode static, pas besoin de déclarer une variable à l'inverse des contructeurs

    // methode pour s'inscrire
    public static function nomMethod(){

        // on appel la fonction dbConnect qui est dans la class Database
        $db = Database::dbConnect();

        // preparation de la requête
        $request =$db->prepare("");

        // exécuter la requête
        try {
            $request->execute(array());

            // rediriger vers la page login.php
            header("Location: http://localhost/film/views/list_actor.php");
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

// class User
// {

//     // pour la méthode static, pas besoin de déclarer une variable à l'inverse des contructeurs

//     // methode pour s'inscrire
//     public static function addUser($statut, $nom, $prenom, $pseudo, $email, $password, $role)
//     {

//         // on appel la fonction dbConnect qui est dans la class Database
//         $db = Database::dbConnect();
//         // preparation de la requête
//         $request = $db->prepare("INSERT INTO `users`(`nom`, `prenom`, `pseudo`, `email`, `mdp`, `role`, `statut`) VALUES (?,?,?,?,?,?,?)");

//         // exécuter la requête
//         try {
//             $request->execute(array($nom, $prenom, $pseudo, $email, $password, $role, $statut));

//             // rediriger vers la page list_user.php
//             header("Location: http://localhost/event/views/list_user.php");
//         } catch (PDOException $e) {
//             echo $e->getMessage();
//         }
//     }