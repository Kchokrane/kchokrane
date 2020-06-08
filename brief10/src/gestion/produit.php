<?php
include_once("./connectDB.php");
               $bdd = new PDO('mysql:host=localhost;dbname=pfa;charset=utf8', 'root', '');
                print_r($_SESSION);

?>
<!DOCTYPE html>
<html>

<head>
  <title>Sc-Supermarche</title>
  <!-- Bootstrap core CSS-->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="../css/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="../acc.css" type="text/css">
<style type="text/css">
  .redlabel{background-color:red;}
  @media (min-width:700px){
  .table td, .table th {padding:0.35rem;}
  }
</style>

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="acc.php"><img src="../img/logo.png" alt=""></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Produit">
          <a class="nav-link" href="produit.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Produit</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="sc1" align="center" action="ajt.php">
        <div class="card-header">
          <h2>Table Produit</h2></div>
        <div class="card-body">
            <table>
            <div class="card mb-3">
              <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <tr>
                  <th><strong>Produit</strong></th>
                  <th><strong>Numero Produit</strong></th>
                  <th><strong>Quantite</strong> </th>  
                  <th><strong>Prix_Unit</strong> </th>
                  <th><strong>Action modifier</strong> </th>
                  <th><strong>Action supprimer</strong> </th>
                </tr>
                <style>
                 td #input{
                  border:none;
                 }
                </style>
                <?php
                $reponse = $bdd->query('SELECT * FROM produit');
                while ($donnees = $reponse->fetch())
                {
                  $cls = "";
                ?>
                  <tr align="center"><form method="post" action="modifier.php?id=<?= $donnees['id']; ?>">
                    <td><input id="input" type="text" name="Produit" value="<?= $donnees['Produit']; ?>" ></td>
                    <td><input id="input" type="text" name="Numero_Produit" value="<?= $donnees['Numero_Produit']; ?>" ></td>
                    <?php if($donnees['Quantite'] <= 10){
                      $cls = 'redlabel';
                       }?>
                    <td id="tdo" class='<?=$cls?>'><input class='<?=$cls?>' id="input" type="text" name="Quantite" value="<?= $donnees['Quantite']; ?>" ></td>
                    <td><input id="input" type="text" name="Prix_Unit" value="<?= $donnees['Prix_Unit']; ?>" ></td>
                    <td id="buttonmod"><input type="submit" value="Modifier" onclick="alert('Donnée Modifier')"></td></form>
                    <td id="sup"><button><?php echo "<a href=\"supprimer.php?id=$donnees[id]\" onclick=\"alert('Données Supprimées !');\" style=\"text-decoration:none\">";?><span><strong>Supprimer</strong></span></a></button></td>
                 </tr>
                <?php
                }
                $reponse->closeCursor(); 
                ?>
            </table>
            <button><?php echo "<a href=\"ajout.php?\" style=\"text-decoration:none\">";?><span><strong>Ajouter</strong></span></a></button></td>
          </div>
        </div>
  </div>
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © YouCode</small>
        </div>
      </div>
    </footer>
    <!-- Bootstrap core JavaScript-->
  </div>
</body>
</html>