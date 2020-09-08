<?php
    require 'inc/functions_panier.php';
    if(!isset($_SESSION['client_id']))
        header('Location: connexion.php');
    //récupérer tous les commandes du client
    $sql = "SELECT * FROM commandes WHERE idClient = :idc";
    $stmt = $db->prepare($sql);    
    $stmt->bindValue(':idc', $_SESSION['client_id']);
    $stmt->execute();
    $commandes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    //fonction pour récupérer nombre des produits dans la commande
    function nombreProduitsCommande($idComm, $db){
        $sql = "SELECT COUNT(id) AS num FROM details_commandes WHERE idCommande = :idcom";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':idcom', $idComm);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['num'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Profil | LuxForAll</title>
    <?php require 'inc/head-tags.php'; ?>
</head>
<body class="goto-here">
	<?php require 'inc/header.php'; ?>
	<div class="hero-wrap hero-bread" style="background-image: url('images/image-header.jpg');">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<p class="breadcrumbs"><span class="mr-2">Profil</span></p>
					<h1 class="mb-0 bread">Mon compte</h1>
				</div>
			</div>
		</div>
	</div>

	<div class="container emp-profile">
                <div class="row">
                    <div class="col-md-10">
                        <div class="profile-head">
							<h5>
								<?php echo $_SESSION['client_nom'] ." ". $_SESSION['client_prenom'] ?>
							</h5>
							<h6>
								<?php echo $_SESSION['client_email'] ?>
							</h6>
                            <p class="proile-rating">Téléphone : <span><?php echo $_SESSION['client_telephone'] ?></span></p>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Commandes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Adresse</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-primary py-3 px-4" href="modifier_client.php" >Modifier</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Référence</label>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Date</label>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Prix total</label>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Nombre des produits</label>
                                    </div>
                                </div>
                                <?php foreach ($commandes as $commande) { ?>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <p>COMM#<?php echo $commande['id'] ?></p>
                                        </div>
                                        <div class="col-md-3">
                                            <p><?php echo $commande['date'] ?></p>
                                        </div>
                                        <div class="col-md-3">
                                            <p><?php echo $commande['prixTotal'] ?>.00 DHs</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p><?php echo nombreProduitsCommande($commande['id'], $db) ?></p>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Référence</label>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Adresse</label>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Ville</label>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Code postal</label>
                                    </div>
                                </div>
                                <?php foreach ($commandes as $commande) { ?>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <p>COMM#<?php echo $commande['id'] ?></p>
                                        </div>
                                        <div class="col-md-3">
                                            <p><?php echo $commande['adresse'] ?></p>
                                        </div>
                                        <div class="col-md-3">
                                            <p><?php echo $commande['ville'] ?></p>
                                        </div>
                                        <div class="col-md-3">
                                            <p><?php echo $commande['codePostal'] ?></p>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
  <?php require 'inc/footer.php'; ?>
  <?php require 'inc/foot-tags.php'; ?>
</body>
</html>