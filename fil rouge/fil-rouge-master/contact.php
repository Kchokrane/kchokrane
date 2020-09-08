<?php
	require 'inc/functions_panier.php';
	
	//vérifier si le bouton envoyer a été cliqué par le visiteur
	if(isset($_POST['envoyer-msg']) && !empty($_POST['envoyer-msg'])) {

		//valider les données insérés
		$nom = trim(htmlspecialchars($_POST['nom']));
		$email = trim(htmlspecialchars($_POST['email']));
		$message = trim(htmlspecialchars($_POST['message']));
		$date = date("Y-m-d h:i:s");

		$data = [
			'nom' => $nom,
			'email' => $email,
			'message' => $message,
			'date' => $date,
		];

		//requet pour inserer les données dans la base de données
		$sql = "INSERT INTO messages (nom, email, message,date) VALUES (:nom, :email, :message,:date)";
		$stat= $db->prepare($sql);
		//vérifier si le message a été enregistré dans la base de données
		if($stat->execute($data)) {
			//afficher une alert pour informer le visiteur que son message a été envoyé avec succès
			echo '<script>alert("Votre message a été bien envoyé")</script>';
			header("Refresh:0");
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Contacter nous | LuxForAll</title>
  <?php require 'inc/head-tags.php'; ?>
</head>
<body class="goto-here">
	<?php require 'inc/header.php'; ?>
	<div class="hero-wrap hero-bread" style="background-image: url('images/image-header.jpg');">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<h1 class="mb-0 bread">Contacter nous</h1>
				</div>
			</div>
		</div>
	</div>
	<section class="ftco-section contact-section bg-light">
		<div class="container">
			<div class="row">
				<div class="col-md-6 order-md-last d-flex">
					<form action="" method="POST" class="bg-white p-5 contact-form">
                    <div class="form-group">
							<h3 class="text-center">Contacter Nous</h3>
						</div>
						<div class="form-group">
							<input class="form-control" name="nom" placeholder="Notre nom" type="text" required>
						</div>
						<div class="form-group">
							<input class="form-control" name="email" placeholder="Votre Email" type="text" required>
						</div>
						<div class="form-group">
							<textarea class="form-control" cols="30" id="" name="message" placeholder="Message" rows="7" required></textarea>
						</div>
						<div class="form-group">
							<input class="btn btn-primary py-3 px-5" name="envoyer-msg" type="submit" value="Envoyer">
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
