<?php
// session_start();
require_once $_SERVER["DOCUMENT_ROOT"]."/event/models/database.php";
// require_once "./models/database.php";

class Book{

    // methode pour rechercher un user par id
        public static function findBookById($id)
        {
            $db = Database::dbConnect();
    
            // preparer la requete
            $request = $db->prepare("SELECT * FROM `users` u LEFT JOIN reservation r ON u.id_utilisateur= r.user_id LEFT JOIN events e ON r.event_id = e.id_evenement WHERE u.id_utilisateur = ?");
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


        // methode pour inscrire une réservation
    public static function addBook($idUser,$eventId,$placeReserve){

        // on appel la fonction dbConnect qui est dans la class Database
        $db = Database::dbConnect();

        // preparation de la requête
        $request =$db->prepare("INSERT INTO `reservation`(`user_id`, `event_id`, `place_reserve`) VALUES (?,?,?)");

        // exécuter la requête
        try {
            $request->execute(array($idUser,$eventId,$placeReserve));

            // rediriger vers la page list_user.php
            header("Location: http://localhost/event/views/list_book.php");
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    // methode pour tout afficher les évènements
    public static function findAllBookByIdUser()
    {

        // on appel la fonction dbConnect qui est dans la class Database
        $db = Database::dbConnect();

        // preparation de la requête
        $request = $db->prepare("SELECT * FROM `users` u JOIN reservation r ON u.id_utilisateur= r.user_id JOIN events e ON r.event_id = e.id_evenement JOIN categorie c ON e.categorie_id= c.id_categorie WHERE u.id_utilisateur = ? ORDER BY e.date_event ASC");

        // exécuter la requête
        $bookList = null;
        try {
            $request->execute([$_SESSION["id_user"]]);

            // récupère le résultat dans un tableau
            $bookList = $request->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $bookList;
    }


    // methode pour le nombre de réservation
    public static function calculReservation($idEvent)
    {

        // on appel la fonction dbConnect qui est dans la class Database
        $db = Database::dbConnect();

        // preparation de la requête
        $request = $db->prepare("SELECT SUM(place_reserve) AS total_places FROM reservation WHERE event_id = ?");

        // exécuter la requête
        // $placeList = null;
        try {
            $request->execute([$idEvent]);

            // récupère le résultat dans un tableau
            // $placeList = $request->fetch(PDO::FETCH_ASSOC);
            // return $placeList;
            $result = $request->fetch(PDO::FETCH_ASSOC);
            return $result['total_places'];

        } catch (PDOException $e) {
            echo $e->getMessage();
            return 0;
        }
        
    }
    
}