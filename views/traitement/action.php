
<?php
require_once "../../models/actorModel.php";
require_once "../../models/filmModel.php";

if(isset($_POST[''])){
    $variable = htmlspecialchars($_POST['variable']);

    // apeler la methode inscription de la classe User
    Film::addFilm($variable);
    // cette syntaxe uniquement pour appeler les méthodes static.
    // la méthode inscription étant static donc on utilise le nom de la classe suivi de "::" ensuite le nom de la méthode qui est inscriptions.

}


