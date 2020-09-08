<?php
	require 'inc/functions_panier.php';

	$erreur = "";

	if(isset($_POST['connexion']) && !empty($_POST['connexion']))
	{
	$email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
    //Retrieve the user account information for the given username.
    $sql = "SELECT * FROM clients WHERE email = :email";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
	$client = $stmt->fetch(PDO::FETCH_ASSOC);
	    
    if($client === false){
        $erreur .= "Email insérée n'existe pas<br>";
    } else{
        $validPassword = password_verify($password, $client['password']);
        if($validPassword){

            $_SESSION['client_id'] = $client['id'];
			$_SESSION['client_nom'] = $client['nom'];
			$_SESSION['client_prenom'] = $client['prenom'];
			$_SESSION['client_email'] = $client['email'];
			$_SESSION['client_telephone'] = $client['telephone'];
            header('Location: produits.php');
        } else{
            $erreur .= "Mot de passe est incorrect<br>";
        }
    }
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>S'identifier | LuxForAll</title>
  <?php require 'inc/head-tags.php'; ?>
</head>
<body class="goto-here">
	<?php require 'inc/header.php'; ?>
	<div class="hero-wrap hero-bread" style="background-image: url('images/image-header.jpg');">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
				<h1 class="mb-0 bread">S'identifier</h1>
				</div>
			</div>
		</div>
	</div>
	<section class="ftco-section contact-section bg-light">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 order-md-last d-flex">
					<form action="" method="POST" class="bg-white p-5 contact-form">
						<div class="form-group">
							<h3 class="text-center">S'identifier</h3>
						</div>
						<?php if($erreur !== ""){ ?>
						<div class="alert alert-danger">							
								<?php echo $erreur ?>
						</div>
						<?php } ?>
						<div class="form-group">
							<input class="form-control" name="email" placeholder="Votre email" type="text" required>
						</div>
						<div class="form-group">
							<input class="form-control" name="password" placeholder="Mot de passe" type="password" required>
						</div>
						<div class="form-group text-center">
							<input class="btn btn-primary py-3 px-5" name="connexion" type="submit" value="Connexion">
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