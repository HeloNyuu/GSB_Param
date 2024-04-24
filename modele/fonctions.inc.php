<?php

/**
 * Initialise le panier
 *
 * Crée un tableau associatif $_SESSION['produits']en session dans le cas
 * où il n'existe pas déjà
*/
function initPanier()
{
	if(!isset($_SESSION['produits']))
	{
		$_SESSION['produits']= array();
	}
}
/**
 * Supprime le panier
 *
 * Supprime le tableau associatif $_SESSION['produits']
 */
function supprimerPanier()
{
	unset($_SESSION['produits']);
}
/**
 * Ajoute un produit au panier
 *
 * Teste si l'identifiant du produit est déjà dans la variable session 
 * ajoute l'identifiant à la variable de type session dans le cas où
 * où l'identifiant du produit n'a pas été trouvé
 
 * @param string $idProduit identifiant de produit
 * @return boolean $ok vrai si le produit n'était pas dans la variable, faux sinon 
*/
function ajouterAuPanier($idProduit)
{
	
	$ok = true;
	if(in_array($idProduit,$_SESSION['produits']))
	{
		$ok = false;
	}
	else
	{
		$_SESSION['produits'][]= $idProduit; // l'indice n'est pas précisé : il sera automatiquement celui qui suit le dernier occupé
	}
	return $ok;
}
/**
 * Retourne les produits du panier
 *
 * Retourne le tableau des identifiants de produit
 
 * @return array $_SESSION['produits'] le tableau des id produits du panier 
*/
function getLesIdProduitsDuPanier()
{
	return $_SESSION['produits'];

}
/**
 * Retourne le nombre de produits du panier
 *
 * Teste si la variable de session existe
 * et retourne le nombre d'éléments de la variable session
 
 * @return int $n
*/
function nbProduitsDuPanier()
{
	$n = 0;
	if(isset($_SESSION['produits']))
	{
	$n = count($_SESSION['produits']);
	}
	return $n;
}
/**
 * Retire un de produits du panier
 *
 * Recherche l'index de l'idProduit dans la variable session
 * et détruit la valeur à ce rang
 
 * @param string $idProduit identifiant de produit
 
*/
function retirerDuPanier($idProduit)
{
		$index =array_search($idProduit,$_SESSION['produits']);
		unset($_SESSION['produits'][$index]);
}
/**
 * teste si une chaîne a un format de code postal
 *
 * Teste le nombre de caractères de la chaîne et le type entier (composé de chiffres)
 
 * @param string $codePostal  la chaîne testée
 * @return boolean $ok vrai ou faux
*/
function estUnCp($codePostal)
{
   
   return strlen($codePostal)== 5 && estEntier($codePostal);
}
/**
 * teste si une chaîne est un entier
 *
 * Teste si la chaîne ne contient que des chiffres
 
 * @param string $valeur la chaîne testée
 * @return boolean $ok vrai ou faux
*/

function estEntier($valeur) 
{
	return preg_match("/[^0-9]/", $valeur) == 0;
}
/**
 * Teste si une chaîne a le format d'un mail
 *
 * Utilise les expressions régulières
 
 * @param string $mail la chaîne testée
 * @return boolean $ok vrai ou faux
*/
function estUnMail($mail)
{
return  preg_match ('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#', $mail);
}
/**
 * Retourne un tableau d'erreurs de saisie pour une commande
 *
 * @param string $nom  chaîne testée
 * @param  string $rue chaîne
 * @param string $ville chaîne
 * @param string $cp chaîne
 * @param string $mail  chaîne 
 * @return array $lesErreurs un tableau de chaînes d'erreurs
*/
function getErreursSaisieCommande($nom,$rue,$ville,$cp,$mail)
{
	$lesErreurs = array();
	if($nom=="")
	{
		$lesErreurs[]="Il faut saisir le champ nom";
	}
	if($rue=="")
	{
	$lesErreurs[]="Il faut saisir le champ rue";
	}
	if($ville=="")
	{
		$lesErreurs[]="Il faut saisir le champ ville";
	}
	if($cp=="")
	{
		$lesErreurs[]="Il faut saisir le champ Code postal";
	}
	else
	{
		if(!estUnCp($cp))
		{
			$lesErreurs[]= "erreur de code postal";
		}
	}
	if($mail=="")
	{
		$lesErreurs[]="Il faut saisir le champ mail";
	}
	else
	{
		if(!estUnMail($mail))
		{
			$lesErreurs[]= "erreur de mail";
		}
	}
	return $lesErreurs;
}


/**
 * Test si le mail existe déjà dans la bdd
 * @param string $email chaîne testée
 * @return boolean 
 * 
 */
function emailExiste($email)
{
    try 
    {
        // Connexion à la base de données
        $monPdo = connexionPDO();

        // Requête pour vérifier si l'email existe déjà dans la table 'compte'
        $reqVerifEmail = 'SELECT COUNT(*) AS nb FROM compte WHERE mail = ?';
        $stmtVerifEmail = $monPdo->prepare($reqVerifEmail);
        $stmtVerifEmail->execute([$email]);
        $result = $stmtVerifEmail->fetch(PDO::FETCH_ASSOC);

        return ($result['nb'] > 0); // Retourne vrai si l'email existe déjà, sinon faux
    } catch (PDOException $e) {
        // En cas d'erreur, affichage du message d'erreur
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

/**
 * Insert un compte dans la table compte dans la bdd et crée un client dans al table client.
 * @param string $nom 
 * @param string $prenom
 * @param string $email
 * @param string $mot_de_passe
 * 
 */

function creationCompte($nom, $prenom, $email, $mot_de_passe)
{
    try 
    {
        // Connexion à la base de données
        $monPdo = connexionPDO();

        // Insertion dans la table client
        $reqClient = 'INSERT INTO client (nom, prenom) VALUES (?, ?)';
        $stmtClient = $monPdo->prepare($reqClient);
        $stmtClient->execute([$nom, $prenom]);

        // Récupération de l'ID du client nouvellement inséré
        $clientId = $monPdo->lastInsertId();

        // Insertion dans la table compte
        $mdp = password_hash($mot_de_passe, PASSWORD_DEFAULT);
        $reqCompte = 'INSERT INTO compte (idCompte, mail, co_password) VALUES (?, ?, ?)';
        $stmtCompte = $monPdo->prepare($reqCompte);
        $stmtCompte->execute([$clientId, $email, $mdp]);

        // Vérification si l'insertion a réussi dans la table compte
        if ($stmtCompte->rowCount() > 0) {
            echo "Inscription réussie.";
        } else {
            echo "Erreur lors de l'inscription.";
        }
    } catch (PDOException $e) {
        // En cas d'erreur, affichage du message d'erreur
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
/**
	function connexionAdmin($usename,$password){
		try
		{
			$monPdo = connexionPDO();
			$pass=password_hash($password, PASSWORD_DEFAULT)
			$req = "SELECT nom FROM administrateur where nom=.$username. and mdp=.$pass";
			$res = $monPdo->query($req);

		}

	}
	**/

//Récupère le mdp d'un utilisateur

function VerifyUt($email)
{
    try 
        {
        $monPdo = connexionPDO();
        $stm = $monPdo -> prepare("SELECT co_password, mail FROM compte WHERE mail = ? " );
        $stm -> bindValue (1,$email);
        $stm -> execute();
        $t=$stm->fetchAll();
        if (count($t)>0){
            return $t[0]['co_password'];
        }
		return null;
        }  
        catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();
        die();
        }
}


function getInfoCompte($email){
	try 
	{
	$monPdo = connexionPDO();
	$stm = $monPdo -> prepare("SELECT mail,co_password FROM compte WHERE mail = ? " );
	$stm -> bindValue (1,$email);
	$stm -> execute();
	$LG=$stm->fetchAll();
	return $LG;
	}  
	catch (PDOException $e) 
	{
	print "Erreur !: " . $e->getMessage();
	die();
	}
}


//Calcul le total d'une commande

function calculerTotal($produits)
{
    $total = 0; // Initialiser le total à zéro

    // Parcourir chaque produit
    foreach ($produits as $produit) {
        // Ajouter le prix du produit au total
        $total += $produit['prix'];
    }

    // Retourner le total
    return $total;
}
?>


