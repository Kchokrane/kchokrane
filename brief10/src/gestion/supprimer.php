<!DOCTYPE html>
<head>
      <title>Supprimer</title>
      <link rel="stylesheet" href="../css/rek.css" type="text/css">
</head>
<body style="background-image:url('https://www.lokad.com/Themes/Lokad2/freshfood-images/fresh.png')" >
<div class="ent">
  <a href="produit.php"><img id="home" src="http://images.gofreedownload.net/rounded-blue-home-button-26731.jpg"></a>
</div>
    <?php
    include_once("connectDB.php");
  $crud = new Crud();
  $id = $crud->escape_string($_GET['id']);
  $result = $crud->delete($id, 'produit');
  $result = $crud->delete($id, 'stock');
  ?>
  <h1 align="center">Votre ligne a ete supprimée</h1>
<footer>
  <div class="row" align="center">
    <p id="test">Copyright &copy; SCRach 2018.All Rights Reserved</p>
  </div>
</footer>
<?php header("location:./produit.php"); ?>
</body>