<?php
	require 'inc/functions_panier.php';
	//récupérer tous les categorie des produits depuis la base de données
	$query1 = $db->prepare("SELECT DISTINCT categorie FROM produits where quantite>0");
	$query1->execute();
	$categories = $query1->fetchAll();
	//récupérer tous les produits depuis la base de données
	$query2 = $db->prepare("SELECT * FROM produits where quantite>0");
	$query2->execute();
	$produits = $query2->fetchAll();
	//récupérer tous les produits depuis la base de données pour chaque categorie
	if(isset($_POST["Recherche"])){
		$categorie=  htmlspecialchars($_POST["categorie"]);
		if($categorie=="all")
			header("Location:produits.php");
		else
		$query3 = $db->prepare("SELECT * FROM produits where quantite>0 AND categorie='$categorie'");
		$query3->execute();
		$produits = $query3->fetchAll();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Produits | LuxForAll</title>
	<?php require 'inc/head-tags.php'; ?>
</head>
<body class="goto-here">
	<?php require 'inc/header.php'; ?>
	<div class="hero-wrap hero-bread" style="background-image: url('images/image-header.jpg');">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
				<h1 class="mb-0 bread h_p">Produits </h1>
				</div>
			</div>
		</div>
	</div>
	<section class="ftco-section bg-light">
		<div class="container">
		<div class="text text-2 py-md-5">
			<h2 class="mb-4">Produits</h2>
			<pre></pre>
			<form action="" method="POST" class="p-5 bg-light">
			<div class="input-group" id="categorie">
<select class="custom-select" id="inputGroupSelect04" aria-label="Example select with button addon" name="categorie">
	<optgroup label="Categorie"></optgroup>
	<option value="all"> toute les produits </option>
	<?php
					if (is_array($categories) || is_object($categories))
						{
							foreach ($categories as $categorie) {
						?>
					<option value="<?=$categorie[0];?>"><?=$categorie[0];?></option>
						<?php
							}
						}
						?>
				</select>
				<div class="input-group-append">
					<button class="btn btn-outline-primary" type="submit" name="Recherche">Recherche</button>
				</div>
</div>
					</form>
			<div class="row">
				<div class="col-md-8 col-lg-12 order-md-last">
					<div class="row">
						<?php
						if (is_array($produits) || is_object($produits))
						{
							foreach ($produits as $produit) {
						?>
						<div class="col-sm-6 col-md-6 col-lg-4 ftco-animate">
							<div class="product">
								<a class="img-prod" href="produit-detail.php?idp=<?php echo $produit['id'] ?>"><img alt="Colorlib Template" class="img-fluid" src="images/<?php echo $produit['image'] ?>">
								<div class="overlay"></div></a>
								<div class="text py-3 px-3">
									<h3><a href="produit-detail"><?php echo $produit['libelle'] ?></a></h3>
									<div class="d-flex">
										<div class="pricing">
											<p class="price"><span class="price-sale"><?php echo $produit['prix'] ?>.00 DHs</span></p>
										</div>
										<div class="rating">
											<p class="text-right"><a href="#"><span class="far fa-star"></span></a> <a href="#"><span class="far fa-star"></span></a> <a href="#"><span class="far fa-star"></span></a> <a href="#"><span class="far fa-star"></span></a> <a href="#"><span class="far fa-star"></span></a></p>
										</div>
									</div>
									<p class="bottom-area d-flex px-3"><a class="add-to-cart text-center py-2 mr-1" href="panier.php?action=ajouter&idp=<?php echo $produit['id'] ?>&q=1" ><span>Ajouter au panier <i class="fas fa-plus ml-1"></i></span></a> <a class="buy-now text-center py-2" href="produit-detail.php?idp=<?php echo $produit['id'] ?>">Acheter<span><i class="fas fa-shopping-cart ml-1"></i></span></a></p>
								</div>
							</div>
						</div>
						<?php }} ?>
					</div>
					<div class="row mt-5">
						<div class="col text-center">
							<div class="block-27">
								<ul>
									<li>
										<a href="#">&lt;</a>
									</li>
									<li class="active"><span>1</span></li>
									<li>
										<a href="#">2</a>
									</li>
									<li>
										<a href="#">3</a>
									</li>
									<li>
										<a href="#">4</a>
									</li>
									<li>
										<a href="#">5</a>
									</li>
									<li>
										<a href="#">&gt;</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php require 'inc/footer.php'; ?>
	<?php require 'inc/foot-tags.php'; ?>
</body>
</html>