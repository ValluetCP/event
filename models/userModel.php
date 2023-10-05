<?php
session_start();

require_once $_SERVER["DOCUMENT_ROOT"]."/event/models/database.php";

class User{

    // pour la méthode static, pas besoin de déclarer une variable à l'inverse des contructeurs

    // methode pour s'inscrire
    public static function addUser($statut,$nom,$prenom,$pseudo,$email,$password,$role){

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

    // methode pour tout afficher les utilisateurs
    public static function findAllUser()
    {

        // on appel la fonction dbConnect qui est dans la class Database
        $db = Database::dbConnect();

        // preparation de la requête
        $request = $db->prepare("SELECT * FROM `users`");

        // exécuter la requête
        $userList = null;
        try {
            $request->execute();

            // récupère le résultat dans un tableau
            $userList = $request->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $userList;
    }


    // methode pour se connecter
    public static function connexion($pseudo,$password){

        // on appel la fonction dbConnect qui est dans la class Database
        $db = Database::dbConnect();

        // préparer la requête
        $request = $db->prepare("SELECT * FROM users WHERE pseudo = ?");
        

        // exécuter la requête
        try {
            $request->execute(array($pseudo));

            // récupérer le résultat de la requête dans un tableau
            $user = $request->fetch(PDO::FETCH_ASSOC);
            // var_dump($user['name']);
            // die;

            // vérifier si l'email existe dans la base de donnée
            if(empty($user)){
                $_SESSION['error_message'] = "Cet email n'existe pas";
                // rediriger vers la page précédente
                header("location:". $_SERVER['HTTP_REFERER']);
    
            // vérifier si le mot de passe est correct
            }else if(password_verify($password, $user['password'])){

                // il a taper le bon mail et le bon mot de passe
                // version avec $_COOKIE
                setcookie("id_user", $user['id_user'],time() + 86400,"/","localhost", false, true);

                // version avec $_SESSION
                // $_SESSION["id_user"] = $user["id_user"];

                // version avec $_COOKIE
                setcookie("user_role", $user['role'],time() + 86400,"/","localhost", false, true);

                // version avec $_SESSION
                // $_SESSION["user_role"] = $user["user_role"];

                // version avec $_COOKIE
                setcookie("user_name", $user['name'],time() + 86400,"/","localhost", false, true);

                // rediriger vers la page list_book.php
                header("Location: http://localhost/event/views/list_user.php");

            }else{
                $_SESSION['error_message'] = "Mot de passe incorrect";
                 // rediriger vers la page précédente
                 header("location:". $_SERVER['HTTP_REFERER']);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    

    // methode pour changer à partir de l'id 
    // CLIENT -  modifier ses infos personnels depuis son profil
    public static function updateUserById($id,$statut,$nom,$prenom,$pseudo,$email,$password,$role){
        
        // on appel la fonction dbConnect qui est dans la class Database
        $db = Database::dbConnect();

        // preparation de la requête
        $request =$db->prepare("UPDATE users SET nom = ?, prenom = ?, pseudo = ?, email = ?, mdp = ?, role = ?, statut = ? WHERE id_utilisateur = ? ");

        // exécuter la requête
        try {
            $request->execute(array($nom,$prenom,$pseudo,$email,$password,$role, $statut,$id));

            // rediriger vers la page list_user.php
            header("Location: http://localhost/event/views/list_user.php");
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    // methode pour supprimer un utilisateur
    public static function deleteUserById($id)
    {
        $db = Database::dbConnect();

        // preparer la requete
        $request = $db->prepare("DELETE FROM users WHERE id_utilisateur=?");
        //executer la requete

        try {
            $request->execute(array($id));
            // recuperer le resultat dans un tableau
            header("Location: http://localhost/event/views/list_user.php");
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    
}