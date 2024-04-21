<body>
    <div class="panier">
        <div class="titre-panier">
            <h2>Votre Panier :</h2>
        </div>
        <div id="produits">
            <?php foreach ($lesProduitsDuPanier as $unProduit) : ?>
                <div class="card">
                    <div class="photoCard">
                        <img src="<?php echo $unProduit['image'] ?>" alt="image descriptive" />
                    </div>
                    <div class="descrCard"><?php echo $unProduit['description']; ?></div>
                    <div class="prixCard"><?php echo $unProduit['prix']."€" ?></div>
                    <div class="imgCard">
                        <a href="index.php?uc=gererPanier&produit=<?php echo $unProduit['id'] ?>&action=supprimerUnProduit" onclick="return confirm('Voulez-vous vraiment retirer cet article ?');">
                            <img src="images/retirerpanier.png" TITLE="Retirer du panier" alt="retirer du panier">
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="recap-commande">
            <h3>Récapitulatif de commande :</h3>
            <?php foreach ($lesProduitsDuPanier as $unProduit) : ?>
                <div class="recap-produit">
                    <span><?php echo $unProduit['description']; ?></span>
                    <span><?php echo $unProduit['prix']."€" ?></span>
                </div>
            <?php endforeach; ?>
            <div class="total">
                <span>Total :</span>
                <span><?php echo calculerTotal($lesProduitsDuPanier); ?>€</span>
            </div>
			<div class="actions">
            <div class="vider">
                <a class="btn-vider" href="index.php?uc=gererPanier&action=vider">Vider le panier</a>
            </div>
            <div class="commande">
                <a class="btn-commander" href="index.php?uc=gererPanier&action=passerCommande">Commander</a>
            </div>
        </div>
        </div>


    </div>
</body>