<?php
    require 'inc_admin/admin_function.php';
    if(!isset($_SESSION['admin_id']))
    header('Location: connexion_admin.php');
    //récupérer les messages depuis la base de données
    $query = $db->prepare("SELECT * FROM messages");
	$query->execute();
    $messages = $query->fetchAll(PDO::FETCH_ASSOC);
    //supprimer les messages depuis la base de données
        $idMessage=(isset($_GET["idMessage"]) ? $_GET["idMessage"]: 0);
        if($idMessage!==0){
            echo "2" .$idMessage;
        $sql="DELETE FROM messages where id=:idMessage";
        $stm=$db->prepare($sql);
        $stm->bindParam(":idMessage",$idMessage);
        if($stm->execute()){
        header("Location:messages.php");
        }
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
					<h1 class="mb-0 bread">MESSAGES</h1>
				</div>
			</div>
		</div>
    </div>
    <section class="ftco-section bg-light">
<div class="container">
			<div class="pt-5 mt-5">
				<h3 class="mb-5"><?php echo nombreMessages($db); ?> Messages</h3>
				<ul class="comment-list">
					<?php foreach ($messages as $message) { ?>
					<li class="comment">
						<div class="vcard bio"><img alt="Image placeholder" src="../images/client.png"></div>
						<div class="comment-body">
							<h3><?php echo $message['nom'];?></h3>
                            <p><?php echo $message['message'] ?></p>
							<div class="meta"><?php echo $message['date'] ?></div>
                             <a href="messages.php?idMessage=<?php echo $message['id'] ?>" class="btn btn-success"><span class="fas fa-check"></span></a>
                        </div>
                    </li>
					<?php } ?>
                </ul>
                <div class="comment-form-wrap pt-5"></div>
                    </div>
                    </div>
                    </section>
                    <?php require 'inc_admin/footer_admin.php'; ?>
                    <?php require 'inc_admin/footer-tags.php'; ?>
</body>
</html>