<?php
// contrôleur qui gère l'affichage des produits
initPanier(); // se charge de réserver un emplacement mémoire pour le panier si pas encore fait
$action = $_REQUEST['action'];
switch($action)
{
	case 'voirCategories':
	{
  		$lesCategories = getLesCategories();
		include("vues/v_categories.php");

  		break;
	}
	case 'voirProduits' :
	{
		$lesCategories = getLesCategories();
		include("vues/v_categories.php");
  		$categorie = $_REQUEST['categorie'];
  		$cat=getLesInfosCategorie($categorie);
  		echo '<h2> Produits de la catégorie '.$cat[1].'</h2>';
		$lesProduits = getLesProduitsDeCategorie($categorie);
		include("vues/v_produitsDeCategorie.php");
		
		break;
	}

	case 'nosProduits':
	{
		$lesProduits=getToutLesProduits();
		include("vues/v_produits.php");


		break;
	}
		
		
	case 'ajouterAuPanier' :
	{
		$idProduit=$_REQUEST['produit'];
		
		$ok = ajouterAuPanier($idProduit);
		if(!$ok)
		{
			$message = "Cet article est déjà dans le panier !!";
			include("vues/v_message.php");
		}
		else{
		// on recharge la même page ( NosProduits si pas categorie passée dans l'url')
		if (isset($_REQUEST['categorie'])){
			$categorie = $_REQUEST['categorie'];
			header('Location:index.php?uc=voirProduits&action=voirProduits&categorie='.$categorie);
		}
		else 
			header('Location:index.php?uc=voirProduits&action=nosProduits');
		}
		break;
	}
}
?>

