<?php
    require 'inc_admin/admin_function.php';
   if(!isset($_SESSION['admin_id']))
        header('Location: connexion_admin.php');
  //récupérer tous les categories des produits depuis la base de données
        $categories=categories($db);
   /* Ajouter produit */
        if(isset($_POST["ajouter"]) && !empty($_POST["ajouter"])){
        $libelle= htmlspecialchars($_POST["libelle"]);
        $prix= htmlspecialchars($_POST["prix"]);
        $quantite= htmlspecialchars($_POST["quantite"]);
        $image= $_POST["image"];
        $categorie=htmlspecialchars($_POST["categorie"]);
        $description= htmlspecialchars($_POST["description"]);
        //appel function AjouterProduit
        AjouterProduit($libelle,$prix,$quantite,$image,$categorie,$description, $db);
            header("location:gestion.php");
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ajouter Produit | LuxForAll</title>
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
                            <h3 class="text-center">Ajouter Produit</h3>
						</div>
						<div class="form-group">
                           <label>libelle</label> <input class="form-control" name="libelle" placeholder="libelle" type="text" required >
                        </div>
                        <div class="form-group">
						<label>prix</label>	<input class="form-control" name="prix" placeholder="prix" type="text" required>
						</div>
						<div class="form-group">
                        <label>quantite</label><input class="form-control" name="quantite" placeholder="quantite" type="text" required >
						</div>
						<div class="form-group">
                        <label>image </label><input type="file" class="form-control" name="image">
                        </div>
                        <div class="form-group">
                        <label>Categorie</label>
                        <input list="categorie" class="form-control" name="categorie" />

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
                        <label>description </label><textarea class="form-control" name="description" required>
                            </textarea>
						</div>
						<div class="form-group text-center">
							<input class="btn btn-primary py-3 px-5" name="ajouter" type="submit" value="Ajouter">
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