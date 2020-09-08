<?php
    require 'inc_admin/admin_function.php';
    if(!isset($_SESSION['admin_id']))
        header('Location: connexion_admin.php');

    //récupérer tous les produit
    $sql = "SELECT * FROM produits";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
//récupérer la valeur de idproduit 
    $idp= (isset($_GET['idp'])? $_GET['idp']: 0);
    //récupérer la valeur de action
    $action=(isset($_GET['action'])? $_GET['action'] : null);
    //Supprimer produit
        if($action=="supprimer" && $idp!=0){
            SupprimerProduit($idp, $db);
            header("location:gestion.php");
        }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Profil Admin | LuxForAll</title>
    <?php require 'inc_admin/header_tags.php'; ?>
</head>
<body class="goto-here">
<?php require 'inc_admin/header_admin.php'; ?>
	<div class="hero-wrap hero-bread" style="background-image: url('../images/image-header.jpg');">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<p class="breadcrumbs "><span class="mr-2">Profil</span></p>
					<h1 class="mb-0 bread">Mon compte Admin</h1>
				</div>
			</div>
		</div>
	</div>

	<div class="container emp-profile">
                <div class="row">
                    <div class="col-md-10">
                        <div class="profile-head">
							<h5>
								<?php echo $_SESSION['admin_nom'] ." ". $_SESSION['admin_prenom'] ?>
							</h5>
							<h6>
								<?php echo $_SESSION['admin_email'] ?>
							</h6>
							<p class="proile-rating">Téléphone : <span><?php echo $_SESSION['admin_telephone'] ?></span></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <table class="table">
							<thead class="thead-primary">
								<tr class="text-center">
									<th>Libelle</th>
									<th>Prix</th>
									<th>Quantite</th>
									<th>Image</th>
									<th>Description</th>
									<th>Traitement</th>
								</tr>
							</thead>
							<tbody>
                                <?php foreach ($produits as $produit) {
                                     $cls ='';
                                     ?>
                                            <tr>
                                          <td> <p><?php echo $produit['libelle'] ?></p></td> 
                                          <td>    <p><?php echo $produit['prix'] ?>.00 DHs</p></td>
                                        <?php if($produit['quantite'] <= 3){
                                             $cls = 'smallQuantite';
                                                 }?>
                                           <td><p class="<?=$cls?>"><?php echo $produit['quantite'] ?></p></td> 
                                            <td><p> <img src="../images/<?php echo $produit['image'] ?>"  style="width:50px;" alt="<?php echo $produit['image'] ?>" ></p></td>
                                           <td> <p> <?php echo $produit['description'] ?></p></td>
                                           <td>
                                               <p>
                                                   <a  name="supprimer" class="btn btn-2 btn-danger" href="gestion.php?action=supprimer&idp=<?php echo $produit['id'] ?>">SUPPRIMER</a>
                                                    <a   name="modifier" class="btn btn-2 btn-primary" href="modifier_produit.php?idp=<?php echo $produit['id'] ?>">MODIFIER</a>
                                                </p>
                                        </td>
                                                </tr>
                                <?php } ?>
                                                </tbody>
                                                </table>
                                                </div>
                                                </div>
                    <div style="margin-bottom:50px; text-align:center;">
                    <a  name="ajouter" class="btn btn-2 btn-success" href="ajouter_produit.php">AJOUTER</a>
                </div>
                                                </div>
                                                <?php require 'inc_admin/footer_admin.php'; ?>
                                                <?php require 'inc_admin/footer-tags.php'; ?>
</body>
</html>