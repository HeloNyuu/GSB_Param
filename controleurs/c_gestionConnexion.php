<?php
$action = $_REQUEST['action'];
switch($action)
{
	case 'connexion':
	{
  		include("vues/v_connexion.php");
  		
	}break;
case 'Verification':
    {
        // Vérifier si l'utilisateur existe dans la base de données
        $co_password = VerifyUt($_POST['mail']);
        if ($co_password === null) {
            echo "L'utilisateur n'existe pas";
            include("vues/v_connexion.php");
            exit; // Arrêter l'exécution du script
        }

        // Vérifier le mot de passe
        $verify = password_verify($_POST['password'], $co_password);
        if ($verify) {
            // Mot de passe correct, rediriger vers la page d'accueil
            setcookie("connexion", $_POST["mail"], 0, "/");//cookie pour check la connexion
            $_COOKIE["connexion"] = $_POST["mail"];
            header('Location:index.php?uc=accueil&action=pageAccueil');
            exit; // Terminer l'exécution du script
        } else {
            // Mot de passe incorrect, afficher un message d'erreur
            echo "Mot de passe incorrect";
            include("vues/v_connexion.php");
            exit; // Arrêter l'exécution du script
        }
    }
    break;

	case 'inscription':{
		include("vues/v_inscription.php");
		
	}break;
	
	case 'confirmerInscription':
	{
		echo $_POST['password'];

		if($_POST['password']==$_POST['repeatpassword'])
		{
			if (emailExiste($_POST['email'])) {
				echo "L'email est déjà associé à un compte existant.";
				include("vues/v_inscription.php");
			} else {
		creationCompte($_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['password']);
		include("vues/v_connexion.php");
		}
	}
	else
	{
		echo "Les mots de passes ne sont pas pareil. Réessayez.";
		include("vues/v_inscription.php");
	}
}
	break;

	case 'connexionAdmin':
	{
		include("vues/v_connexionAdmin");

	}break;

		
} 
?>