<?php
$action = $_REQUEST['action'];
switch($action)
{
	case 'connexion':
	{
  		include("vues/v_connexion.php");
  		
	}break;

	case 'confirmerConnexion':
		{

			include '#';
		}
		break;

	case 'inscription':{
		include("vues/v_inscription.php");
		
	}break;
	
	case 'confirmerInscription':
	{
		creationCompte($POST_['nom'],$POST_['prenom'],$POST_['email'],$POST_['mdp']);
		include("vues/v_accueil.html");
	}
	break;

	case 'connexionAdmin':
	{
		include("vues/v_connexionAdmin");

	}break;
		
} 
?>