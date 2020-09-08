<?php
	require 'inc/functions_panier.php';
    $idc = (isset($_SESSION['client_id'])) ? $_SESSION['client_id'] : header("Location:connexion.php");
    $nom = (isset($_SESSION['client_nom'])) ? $_SESSION['client_nom'] : "" ;
    $prenom = (isset($_SESSION['client_prenom'])) ? $_SESSION['client_prenom'] : "" ;
    $email = (isset($_SESSION['client_email'])) ? $_SESSION['client_email'] : "" ;
    $telephone = (isset($_SESSION['client_telephone'])) ? $_SESSION['client_telephone'] : "" ;
    $erreur="";
    $modifier="";
	if(isset($_POST['Modifier']) && !empty($_POST['Modifier']))
	{
		$nom =htmlspecialchars($_POST['nom']);
		$prenom = htmlspecialchars($_POST['prenom']);
		$email = htmlspecialchars($_POST['email']);
		$telephone =htmlspecialchars($_POST['telephone']);
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$erreur .= "Email n'est pas valide<br>";
        }else{
            $sql="UPDATE `clients` SET `nom`=:nom,`prenom`=:prenom,`email`=:email,`telephone`=:telephone WHERE id=:idc";
            $data = [
                'idc'=>$idc,
				'nom' => $nom,
				'prenom' => $prenom,
				'email' => $email,
				'telephone' => $telephone,
            ];
            $stat=$db->prepare($sql);
			if($stat->execute($data)){
            $_SESSION['client_nom']= $nom;
            $_SESSION['client_prenom']=$prenom;
            $_SESSION['client_email']=$email;
            $_SESSION['client_telephone']=$telephone;
        //Message
        $modifier= "<div class='alert alert-success'> Modifier Avec Success</div>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Modifier | LuxForAll</title>
  <?php require 'inc/head-tags.php'; ?>
</head>
<body class="goto-here">
	<?php require 'inc/header.php'; ?>
	<section class="ftco-section contact-section bg-light">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 order-md-last d-flex">
					<form action="" method="POST" class="bg-white p-5 contact-form">
                        <div class="form-group">
                            <h3 class="text-center">Modifier un compte</h3>
                        </div>
                        <?php echo $modifier;?>
                        <?php if($erreur !== ""){ ?>
						<div class="alert alert-danger">
								<?php echo $erreur ?>
						</div>
                        <?php } ?>
						<div class="form-group">
							<input class="form-control" name="nom" placeholder="Votre nom" type="text" required value="<?= $nom;?>">
                        </div>
                        <div class="form-group">
							<input class="form-control" name="prenom" placeholder="Votre prénom" type="text" required value="<?=$prenom;?>">
						</div>
						<div class="form-group">
							<input class="form-control" name="email" placeholder="Votre Email" type="email" required value="<?=$email;?>">
						</div>
						<div class="form-group">
							<input class="form-control" name="telephone" placeholder="Téléphone" type="text" value="<?=$telephone;?>">
						</div>
						<div class="form-group text-center">
							<input class="btn btn-primary py-3 px-5" name="Modifier" type="submit" value="Modifier">
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