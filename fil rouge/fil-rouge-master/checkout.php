<?php
	require 'inc/functions_panier.php';
	if(!isset($_SESSION['client_id']))
		header('Location: connexion');
	if(isset($_POST['commander']) && !empty($_POST['commander']))
	{
		$adresse = htmlspecialchars($_POST['adresse']);
		$ville = htmlspecialchars($_POST['ville']);
		$codePostal =htmlspecialchars($_POST['codePostal']);
		$date = date("Y-m-d h:i:s");
		$prixTotal = totalPrixPanier($_SESSION['client_id'], $db)+20;

		$data = [
			'idClient' => $_SESSION['client_id'],
			'date' => $date,
			'prixTotal' => $prixTotal,
			'adresse' => $adresse,
			'ville' => $ville,
			'codePostal' => $codePostal,
		];

		$sql = "INSERT INTO commandes (idClient, date, prixTotal, adresse, ville, codePostal) VALUES (:idClient, :date, :prixTotal, :adresse, :ville, :codePostal)";
		$stat= $db->prepare($sql);
		if($stat->execute($data))
		{
			$idCommande = $db->lastInsertId();
			$produits = lesProduitsExistent($_SESSION['client_id'], $db);

			foreach ($produits as $produit) {
				$data2 = [
					'idCommande' => $idCommande,
					'idProduit' => $produit['idProduit'],
					'taille' => $produit['taille'],
					'quantite' => $produit['quantite'],
				];
				$sql2 = "INSERT INTO details_commandes (idCommande, idProduit,taille, quantite) VALUES (:idCommande, :idProduit,:taille,:quantite)";
				$stat2= $db->prepare($sql2);
				$stat2->execute($data2);
				//update quantite de produit
			$sql3= "UPDATE produits SET quantite=(quantite-".$produit['quantite'].") where id=".$produit['idProduit']."";
			$stat3=$db->prepare($sql3);
			$stat3->execute();
			}
			if(supprimerPanier($_SESSION['client_id'], $db))
				header('Location: profile.php');
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Check-out | LuxForAll</title>
	<?php require 'inc/head-tags.php'; ?>
</head>
<body class="goto-here">
	<?php require 'inc/header.php'; ?>
	<div class="hero-wrap hero-bread" style="background-image: url('images/image-header.jpg');">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
				<h1 class="mb-0 bread">Check-out</h1>
				</div>
			</div>
		</div>
	</div>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-8 ftco-animate">
					<form action="" method="POST" class="billing-form">
						<h3 class="mb-4 billing-heading">Détails de la facturation</h3>
						<div class="row align-items-end">
							<div class="w-100"></div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="streetaddress">Adresse de rue</label> <input class="form-control" name="adresse" placeholder="Numéro de maison et nom de rue" required type="text">
								</div>
							</div>
							<div class="w-100"></div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="towncity">Ville</label> <input class="form-control" name="ville" placeholder="" required type="text">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="postcodezip">Code postal *</label> <input class="form-control" name="codePostal" placeholder="" required type="text">
								</div>
							</div>
							<div class="w-100"></div>
						</div>

					<div class="row mt-5 pt-3 d-flex">
						<div class="col-md-6 d-flex">
							<div class="cart-detail cart-total bg-light p-3 p-md-4">
								<h3 class="billing-heading mb-4">Total du panier</h3>
								<p class="d-flex"><span>Total</span> <span><?php echo totalPrixPanier($_SESSION['client_id'], $db) ?>.00 DHs</span></p>
								<p class="d-flex"><span>Livraison</span> <span>20.00 DHs</span></p>
								<hr>
								<p class="d-flex total-price"><span>Total</span> <span><?php echo totalPrixPanier($_SESSION['client_id'], $db)+20 ?>.00 DHs</span></p>
							</div>
						</div>
						<div class="col-md-6">
							<div class="cart-detail bg-light p-3 p-md-4">
								<h3 class="billing-heading mb-4">Mode de paiement</h3>
								<div class="form-group">
									<div class="col-md-12">
										<div class="radio">
											<label><input class="mr-2" name="optradio" type="radio" checked>Paiement à la livraison</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<div class="checkbox">
											<label><input class="mr-2" type="checkbox" value="" required>J'ai lu et j'accepte les termes et conditions</label>
										</div>
									</div>
								</div>
								<p><input type="submit" class="btn btn-primary py-3 px-4" value="Commander" name="commander"></p>
							</div>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<?php require 'inc/footer.php'; ?>
	<?php require 'inc/foot-tags.php'; ?>
</body>
</html>