<?php
	require 'inc_admin/admin_function.php';

	$erreur = "";

	if(isset($_POST['connexion_admin']) && !empty($_POST['connexion_admin']))
	{
	$email = !empty($_POST['email']) ? trim(htmlspecialchars($_POST['email'])) : null;
    $password = !empty($_POST['password']) ? trim(htmlspecialchars($_POST['password'])) : null;
    //Retrieve the user account information for the given username.
    $sql = "SELECT * FROM admin WHERE email = :email";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
	$admin = $stmt->fetch(PDO::FETCH_ASSOC);
	    
    if($admin === false){
        $erreur .= "Email insérée n'existe pas<br>";
    } else{
        $validPassword = password_verify($password, $admin['password']);
        
        if($validPassword){
			$_SESSION["admin"]=$admin;
            $_SESSION['admin_id'] = $admin['id'];
			$_SESSION['admin_nom'] = $admin['nom'];
			$_SESSION['admin_prenom'] = $admin['prenom'];
			$_SESSION['admin_email'] = $admin['email'];
			$_SESSION['admin_telephone'] = $admin['telephone'];
            
            header('Location: gestion.php');
        } else{
            $erreur .= "Mot de passe est incorrect<br>";
        }
    }
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>S'identifier Admin | LuxForAll </title>
	<?php require 'inc_admin/header_tags.php'; ?>
</head>
<body class="goto-here">
	<section class="ftco-section contact-section bg-light">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 order-md-last d-flex">
					<form action="" method="POST" class="bg-white p-5 contact-form">
						<div class="form-group">
							<h3 class="text-center">S'identifier Admin</h3>
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
							<input class="btn btn-primary py-3 px-5" name="connexion_admin" type="submit" value="Connexion">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

</body>
</html>