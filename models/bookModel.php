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


    // methode pour désactiver une réservation 
    public static function desactiveBookById($id)
    {
        $db = Database::dbConnect();

        // preparer la requete
        $request = $db->prepare("UPDATE reservation SET reservation_actif = ? WHERE id_reservation =?");
        //executer la requete

        try {
            $request->execute([0, $id]);
            // recuperer le resultat dans un tableau
            header("Location: http://localhost/event/views/list_book.php");
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    


    // methode pour activer une réservation 
    public static function activeBookById($id)
    {
        $db = Database::dbConnect();

        // preparer la requete
        $request = $db->prepare("UPDATE reservation SET reservation_actif = ? WHERE id_reservation =?");
        //executer la requete

        try {
            $request->execute([1, $id]);
            // recuperer le resultat dans un tableau
            header("Location: http://localhost/event/views/list_book.php");
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    


    // methode pour activer une réservation 
    public static function deleteBookById($id)
    {
        $db = Database::dbConnect();

        // preparer la requete
        $request = $db->prepare("DELETE FROM reservation WHERE id_reservation =?");

        //executer la requete
        try {
            $request->execute([1, $id]);
            // recuperer le resultat dans un tableau
            header("Location: http://localhost/event/views/list_book.php");
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    // Requête pour récupérer l'historique des réservations de l'utilisateur pour cet événement
    public static function getUserPreviousReservations($userId, $eventId)
    {
        $db = Database::dbConnect();

        // Préparation de la requête
        $request = $db->prepare("SELECT * FROM reservation WHERE user_id = ? AND event_id = ? ORDER BY date_reservation DESC");

        // Exécuter la requête
        try {
            $request->execute([$userId, $eventId]);

            // Récupérer le résultat dans un tableau
            $previousReservations = $request->fetchAll(PDO::FETCH_ASSOC);

            return $previousReservations;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return [];
        }
    }


    // Met à jour la quantité de places réservées en ajoutant la nouvelle quantité à l'ancienne. 
    public static function addAnotherBook($idUser, $eventId, $placeReserve)
    {
        $db = Database::dbConnect();

        // Vérifier s'il existe déjà une réservation pour cet utilisateur et cet événement
        $existingReservation = self::getUserPreviousReservations($idUser, $eventId);

        // Si une réservation existe, mettez à jour la quantité de places réservées
        if (!empty($existingReservation)) {
            $existingReservationId = $existingReservation[0]['id_reservation'];
            $newTotalPlaces = $existingReservation[0]['place_reserve'] + $placeReserve;

            // Préparation de la requête de mise à jour
            $updateRequest = $db->prepare("UPDATE reservation SET place_reserve = ? WHERE id_reservation = ?");

            try {
                $updateRequest->execute([$newTotalPlaces, $existingReservationId]);

                // Rediriger vers la page de réservation ou toute autre page appropriée
                header("Location: http://localhost/event/views/list_book.php");
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        } else {
            // Si aucune réservation n'existe, ajoutez une nouvelle réservation
            self::addBook($idUser, $eventId, $placeReserve);
        }
    }

    
}