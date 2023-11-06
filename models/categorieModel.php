<?php

// require_once $_SERVER["DOCUMENT_ROOT"]."/event/models/database.php";
require_once __DIR__."./database.php";

class Categorie{
    // pour la méthode static, pas besoin de déclarer une variable à l'inverse des contructeurs

    // methode pour s'inscrire
    public static function addCategorie($categorieName){

        // on appel la fonction dbConnect qui est dans la class Database
        $db = Database::dbConnect();

        // preparation de la requête
        $request =$db->prepare("INSERT INTO `categorie`(`categorie_name`) VALUES (?)");

        // exécuter la requête
        try {
            $request->execute(array($categorieName));

            // rediriger vers la page list_user.php
            header("Location: http://localhost/event/views/list_categorie.php");
            // header("Location: http://event.com/views/list_categorie.php");
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    // methode pour tout afficher les categories
    public static function findAllCategorie()
    {

        // on appel la fonction dbConnect qui est dans la class Database
        $db = Database::dbConnect();

        // preparation de la requête
        $request = $db->prepare("SELECT * FROM `categorie`");

        // exécuter la requête
        $categorieList = null;
        try {
            $request->execute();

            // récupère le résultat dans un tableau
            $categorieList = $request->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $categorieList;
    }

    // methode pour joindre User et Events
    public static function findUsedCategorie()
    {

        // on appel la fonction dbConnect qui est dans la class Database
        $db = Database::dbConnect();

        // preparation de la requête
        $request = $db->prepare("SELECT * FROM `categorie` c INNER JOIN events e ON e.categorie_id = c.id_categorie group by e.categorie_id");

        // exécuter la requête
        $categorieList = null;
        try {
            $request->execute();

            // récupère le résultat dans un tableau
            $categorieList = $request->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $categorieList;
    }

    // methode pour changer à partir de l'id 
    // ADMIN -  modifier une categorie
    public static function updateCategorieById($id,$categorieName){
        
        // on appel la fonction dbConnect qui est dans la class Database
        $db = Database::dbConnect();

        // preparation de la requête
        $request =$db->prepare("UPDATE categorie SET categorie_name = ? WHERE id_categorie = ? ");

        // exécuter la requête
        try {
            $request->execute(array($categorieName,$id));

            // rediriger vers la page list_event.php
            header("Location: http://localhost/event/views/list_categorie.php");
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }


    // methode pour supprimer une categorie
    public static function deleteCategorieById($id)
    {
        $db = Database::dbConnect();

        // preparer la requete
        $request = $db->prepare("DELETE FROM categorie WHERE id_categorie=?");
        //executer la requete

        try {
            $request->execute(array($id));
            // recuperer le resultat dans un tableau
            header("Location: http://localhost/event/views/list_categorie.php");
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    // methode pour rechercher une categorie par id
    public static function findCategorieById($id)
    {
        $db = Database::dbConnect();

        // preparer la requete
        $request = $db->prepare("SELECT * FROM categorie WHERE id_categorie=?");
        //executer la requete
        try {
            $request->execute(array($id));;
            // recuperer le resultat dans un tableau
            $categorie = $request->fetch();
            return $categorie;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}