<?php
    require 'inc_admin/admin_function.php';
    if(!isset($_SESSION['admin_id']))
    header('Location: connexion_admin.php');

 //récupérer tous les categorie des produits depuis la base de données
 $categories=categories($db);

    $idp= (isset($_GET['idp'])? $_GET['idp']:    header("location:gestion.php"));
    $libelle=$prix=$quantite=$image=$description=""; //les champs vide
    //afficher les information de produit
    $sql="SELECT * FROM produits WHERE id=:idp";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':idp', $idp);
    $stmt->execute();
    $produit = $stmt->fetch(PDO::FETCH_ASSOC);
if(sizeof($produit)>0){
    $libelle=$produit["libelle"];
    $prix=$produit["prix"];
    $quantite=$produit["quantite"];
    $image=$produit["image"];
    $categorie=$produit["categorie"];
    $description=$produit["description"];
}
   /* Modifier produit */
        if(isset($_POST["modifier"]) && !empty($_POST["modifier"])){
        $libelle= htmlspecialchars($_POST["libelle"]);
        $prix= htmlspecialchars($_POST["prix"]);
        $quantite= htmlspecialchars($_POST["quantite"]);
        $categorie= htmlspecialchars($_POST["categorie"]);
        $description= htmlspecialchars($_POST["description"]);
            ModifierProduit($idp,$libelle,$prix,$quantite,$categorie,$description, $db);
            header("location:gestion.php");
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Modifier Produit | LuxForAll</title>
    <?php require 'inc_admin/header_tags.php'; ?>
</head>
<body class="goto-here">
<?php require 'inc_admin/header_admin.php'; ?>
    <section class="ftco-section contact-section bg-light">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 order-md-last d-flex">
					<form action="" method="POST" class="bg-white p-5 contact-form">
                        <div class="form-group">
                            <h3 class="text-center">Modifier Produit</h3>
						</div>
						<div class="form-group">
                           <label>libelle</label> <input class="form-control" name="libelle" placeholder="libelle" type="text" value=" <?= $libelle;?>">
                        </div>
                        <div class="form-group">
						<label>prix</label>	<input class="form-control" name="prix" placeholder="prix" type="text"  value="<?= $prix;?>">
						</div>
						<div class="form-group">
                        <label>quantite</label><input class="form-control" name="quantite" placeholder="quantite" type="text"  value="<?= $quantite;?>">
						</div>
						<div class="form-group">
                        <label>image </label> 	<input type="text" class="form-control" name="image" value="<?= $image;?>" readonly>
                        </div>
                        <div class="form-group">
                        <label>Categorie</label>
                        <input list="categorie" class="form-control" name="categorie" value="<?=$categorie;?>" />

                    <datalist id="categorie">
                    <?php
					if (is_array($categories) || is_object($categories))
						{
							foreach ($categories as $categorie) {
						?>
			<option value="<?=$categorie[0];?>">
						<?php
							}
						}
						?>
                    </datalist>
						</div>
                        <div class="form-group">
                        <label>description </label> <textarea class="form-control"  name="description" ><?= $description;?></textarea>
						</div>
						<div class="form-group text-center">
							<input class="btn btn-primary py-3 px-5" name="modifier" type="submit" value="Modifier">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
    <?php require 'inc_admin/footer_admin.php'; ?>
                    <?php require 'inc_admin/footer-tags.php'; ?>
</body>
</html>