
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="">
<div class="container">
		<a class="navbar-brand" href="gestion.php">LuxForAll</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="fas fa-bars">
			</span> Menu
		</button>
		<div class="collapse navbar-collapse" id="ftco-nav">
			<ul class="navbar-nav ml-auto">
			<li class="nav-item dropdown active"><a href="#" class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bonjour, <?php echo $_SESSION['admin_nom'] ?></a>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
						<a class="dropdown-item" href="gestion_commande.php">Gestion Commande </a>
						<a class="dropdown-item" href="../inc/deconnexion.php">Déconnexion</a>
					</div>
				</li>
				<li class="nav-item cta cta-colored"><a href="messages.php" class="nav-link"><span class="fas fa-envelope margin"></span>[<?php if(isset($_SESSION['admin_id'])) echo nombreMessages($db); else echo "0"; ?>]</a></li>
			</ul>
	</div>
</nav>
