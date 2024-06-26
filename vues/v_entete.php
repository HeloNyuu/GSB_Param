<!doctype html>
<html lang="fr">
<head>
<title>Gsb Param</title>
<meta charset="utf-8">
<link href="modele/cssGeneral.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<div id="bandeau">
	<nav class="navbar navbar-expand-lg navbar-light bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php?uc=accueil"><img src="images/images-removebg-preview.png" width="70px" height="65px"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active text-light" aria-current="page" href="index.php?uc=accueil">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-light" aria-current="page" href="index.php?uc=voirProduits&categorie=XX&action=voirProduits">Nos produits</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-light" aria-current="page" href="index.php?uc=gererPanier&action=voirPanier">Voir son panier</a>
        </li>
      </ul>

      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <?php if ( isset($_COOKIE["connexion"])==NULL)
      {
      ?>
        <li class="nav-item">
          <a class="nav-link active text-light" aria-current="page" href="index.php?uc=gererConnexion&action=connexion">Connexion</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-light" href="index.php?uc=gererConnexion&action=inscription">Inscription</a>
        </li>
        
        <?php }else { ?>
          <li class="nav-item">
          <a class="nav-link active text-light" href="index.php?uc=gererConnexion&action=deconnexion">Déconnexion</a>
          </li>
        <?php } ?>
      </ul>

    </div>
  </div>
</nav>

 </div>
</head>
<body >