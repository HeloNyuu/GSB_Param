<?php
session_start();
include("vues/v_entete.php") ;
require_once("modele/fonctions.inc.php");
require_once("modele/bd.produits.inc.php");
if(!isset($_REQUEST['uc']))
     $uc = 'accueil'; // si $_GET['uc'] n'existe pas , $uc reçoit une valeur par défaut
else
	$uc = $_REQUEST['uc'];

 
switch($uc)
{
	case 'accueil':
		{include("vues/v_accueil.html");break;}
	case 'voirProduits' :
		{include("controleurs/c_voirProduits.php");break;}
	case 'gererPanier' :
		{ include("controleurs/c_gestionPanier.php");break; }
	case 'administrer' :
	  { include("controleurs/c_gestionProduits.php");break;  }
	 case 'gererConnexion':
	 {include("controleurs/c_gestionConnexion.php");break;}
	 
	 	
}
include("vues/v_pied.html") ;
?>

