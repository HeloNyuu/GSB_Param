<div class="category-container">
<div class="category-wrapper">
<ul id="cat" >
<?php
foreach( $lesCategories as $uneCategorie) 
{
	$idCategorie = $uneCategorie['id'];
	$libCategorie = $uneCategorie['libelle'];
	?>
	<li>
		
		<a href="index.php?uc=voirProduits&categorie=<?php echo $idCategorie ?>&action=voirProduits">
		<?php echo $libCategorie ?></a>
	</li>
<?php
}
?>

</ul>
</div>
<?php if ($_REQUEST['categorie']!='XX') {
?>
<a class="back-button" href="index.php?uc=voirProduits&categorie=XX&action=voirProduits">Voir Tout<i class="fas fa-arrow-left"></i></a>

<?php
}
?>
</div>

