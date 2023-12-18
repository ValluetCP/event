<?php

public function ajouterEvent() {

	if (isset($_POST['submit'])) {
	extract($_POST);

    $quantite = $_POST["qte"] ?: 1;
    $products = findEventById($_POST[$id]) ;

	if( !array_key_exists('commandes', $_SESSION) ){
            $_SESSION['commandes'] = [];
        }
       
       	$panier = $_SESSION['commandes'];        

        $productsDejaDansPanier = false;
        foreach ($panier as $indice => $ligne) {
            if ($products->getId() == $ligne["products"]->getId()) {
                $panier[$indice]["quantite"] += $quantite;
                $productsDejaDansPanier = true;
                break;  // pour sortir de la boucle foreach
            }
        }

        if (!$productsDejaDansPanier) {
            $panier[] = ["quantite" => $quantite, "products" => $products];  // on ajoute une ligne au panier => $panier est un array d'array
        }

		$_SESSION['commandes'] = array_merge($_SESSION['commandes'] , $panier); // je remets $panier dans la session, à l'indice 'panier'
        $nb = 0;

        foreach ($panier as $ligne) {
            $nb += $ligne["quantite"];
        }

        // on verra la redirection plutard
        // return $nb;
    }

}



?>