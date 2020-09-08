
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	<div class="container">
		<a class="navbar-brand" href="index.php">LuxForAll</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="fas fa-bars">
			</span> Menu
		</button>
		<div class="collapse navbar-collapse" id="ftco-nav">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active"><a href="index.php" class="nav-link">Accueil</a></li>
				<li class="nav-item active">
					<a class="nav-link" href="produits.php">Produits</a>
				</li>
				<li class="nav-item active">
					<a href="contact.php" class="nav-link">Contact</a>
				</li>
				<?php if(isset($_SESSION['client_id'])){ ?>
				
				<li class="nav-item dropdown active"><a href="profile.php" class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bonjour, <?php echo $_SESSION['client_nom'] ?></a>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
						<a class="dropdown-item" href="profile.php">Profil</a>
						<a class="dropdown-item" href="inc/deconnexion.php">Déconnexion</a>
					</div>
				</li>
					
				<?php } else {?>
				<li class="nav-item active"><a href="inscrire.php" class="nav-link">S'inscrire</a></li>
				<li class="nav-item active"><a href="connexion.php" class="nav-link">Connexion</a></li>
				<?php }?>
				<li class="nav-item cta cta-colored"><a href="panier.php" class="nav-link"><span class="fa fa-shopping-cart margin"></span>[<?php if(isset($_SESSION['client_id'])) echo nombreProduits($_SESSION['client_id'], $db); else echo "0"; ?>]</a></li>
			</ul>
		</div>
	</div>
</nav>
