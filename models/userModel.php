<?php
// session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . "/event/models/database.php";
// require_once __DIR__."/database.php";

class User
{

    // pour la méthode static, pas besoin de déclarer une variable à l'inverse des contructeurs

    // methode pour s'inscrire
    public static function addUser($imgProfil,$imgDescription,$nom,$prenom,$pseudo,$email,$password)
    {

        // on appel la fonction dbConnect qui est dans la class Database
        $db = Database::dbConnect();
        // preparation de la requête
        $request = $db->prepare("INSERT INTO `users`(`img_profil`, `img_description`, `nom`, `prenom`, `pseudo`, `email`, `mdp`) VALUES (?,?,?,?,?,?,?)");

        // exécuter la requête
        try {
            $request->execute(array($imgProfil,$imgDescription,$nom,$prenom,$pseudo,$email, $password));

            // rediriger vers la page list_user.php
            header("Location: http://localhost/event/views/connexion.php");
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
    public static function connexion($pseudo, $password)
    {

        // on appel la fonction dbConnect qui est dans la class Database
        $db = Database::dbConnect();

        // préparer la requête
        $request = $db->prepare("SELECT * FROM users WHERE pseudo = ?");


        // exécuter la requête
        try {
            $request->execute(array($pseudo));

            // récupérer le résultat de la requête dans un tableau
            $user = $request->fetch(PDO::FETCH_ASSOC);
            // var_dump($password);
            // var_dump($user['mdp']);
            // $password2 = password_hash($password, PASSWORD_DEFAULT);
            // var_dump(password_verify($password, $user['mdp']));die;
            // vérifier si l'email existe dans la base de donnée
            
            if (!$user) {
                $_SESSION['error_message'] = "Cet email n'existe pas";
                // rediriger vers la page précédente
                header("location:" . $_SERVER['HTTP_REFERER']);
                // vérifier si le mot de passe est correct
                
            } else if(password_verify($password, $user['mdp'])) { 
                    // il a taper le bon mail et le bon mot de passe
                    // version avec $_COOKIE
                    //setcookie("id_user", $user['id_user'],time() + 86400,"/","localhost", false, true);

                    // $_SESSION["user"] = $user;
                    //<?= $_SESSION["user"]["id_user"] syntaxe dans les fichiers où je l'appel


                    // version avec $_SESSION
                    $_SESSION["id_user"] = $user["id_utilisateur"];

                    // version avec $_COOKIE
                    // setcookie("user_role", $user['role'],time() + 86400,"/","localhost", false, true);

                    // version avec $_SESSION
                    $_SESSION["user_role"] = $user["role"];

                    // version avec $_COOKIE
                    // setcookie("user_name", $user['name'],time() + 86400,"/","localhost", false, true);

                    $_SESSION["user_name"] = $user["nom"];
                    $_SESSION["user_firstName"] = $user["prenom"];
                    $_SESSION["user_pseudo"] = $user["pseudo"];
                    $_SESSION["user_email"] = $user["email"];
                    

                    // rediriger vers la page home.php
                    header("Location: http://localhost/event/views/home.php");

                    // if($user['role'] == 'admin')                    
                    //     header("Location: http://localhost/event/views/add_categorie.php");
                    // else 
                    //     header("Location: http://localhost/event/views/info_user.php");
                } else {
                    $_SESSION['error_message'] = "Mot de passe incorrect";
                    // rediriger vers la page précédente
                    header("location:" . $_SERVER['HTTP_REFERER']);
                }
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }



    // methode pour changer à partir de l'id 
    // CLIENT -  modifier ses infos personnels depuis son profil
    public static function updateUserById($nom,$prenom,$pseudo,$email)
    {

        // on appel la fonction dbConnect qui est dans la class Database
        $db = Database::dbConnect();

        // preparation de la requête
        $request = $db->prepare("UPDATE users SET nom = ?, prenom = ?, pseudo = ?, email = ? WHERE id_utilisateur = ? ");
        // exécuter la requête
        try {
            $request->execute(array($nom, $prenom, $pseudo, $email, $_SESSION["id_user"]));
            
            $_SESSION["user_name"] = $nom;
            $_SESSION["user_firstName"] = $prenom;
            $_SESSION["user_pseudo"] = $pseudo;
            $_SESSION["user_email"] = $email;

            // rediriger vers la page list_user.php
            header("Location: http://localhost/event/views/info_user.php");

            //  if($_SESSION["user_role"] == 'admin')                    
            //             header("Location: http://localhost/event/views/add_categorie.php");
            //         else 
            //             header("Location: http://localhost/event/views/info_user.php");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // methode pour supprimer un utilisateur de la base de donnée
    public static function deleteUserById($id)
    {
        $db = Database::dbConnect();

        // preparer la requete
        $request = $db->prepare("DELETE FROM users WHERE id_utilisateur=?");
        //executer la requete

        try {
            $request->execute(array($id));
            // recuperer le resultat dans un tableau
            header("Location: http://localhost/event/views/admin_list_user.php");
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }


    // methode pour désactiver le compte d'un utilisateur
    public static function desactiveUserById($id)
    {
        $db = Database::dbConnect();

        // preparer la requete
        $request = $db->prepare("UPDATE users SET users_actif = ? WHERE id_utilisateur = ? ");
        //executer la requete

        try {
            $request->execute([0, $id]);
            // recuperer le resultat dans un tableau
            header("Location: http://localhost/event/views/home.php");
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }


    // methode pour désactiver le compte d'un utilisateur
    public static function activeUserById($id)
    {
        $db = Database::dbConnect();

        // preparer la requete
        $request = $db->prepare("UPDATE users SET users_actif = ? WHERE id_utilisateur = ? ");
        //executer la requete

        try {
            $request->execute([1, $id]);
            // recuperer le resultat dans un tableau
            header("Location: http://localhost/event/views/admin_list_user.php");
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }


    // methode pour rechercher un user par id
    public static function findUserById($id)
    {
        $db = Database::dbConnect();

        // preparer la requete
        $request = $db->prepare("SELECT * FROM users u LEFT JOIN events e ON u.categorie_id = c.id_categorie WHERE id_utilisateur=?");
        // $request = $db->prepare("SELECT * FROM users u LEFT JOIN events e ON u.categorie_id = c.id_categorie WHERE id_utilisateur=? AND users_actif=1");
        //executer la requete
        try {
            $request->execute(array($id));
            // recuperer le resultat dans un tableau
            $user = $request->fetch();
            return $user;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    // methode pour rechercher un user par id
    public static function userReservation($idUser)
    {
        $db = Database::dbConnect();

        // preparer la requete
        $request = $db->prepare("SELECT * FROM `reservation` WHERE user_id=?");
        //executer la requete
        try {
            $request->execute(array($idUser));;
            // recuperer le resultat dans un tableau
            $user = $request->fetch();
            return $user;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }


    
}
