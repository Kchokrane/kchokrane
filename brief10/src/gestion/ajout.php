<?php 
try
      {
        $bdd = new PDO('mysql:host=localhost;dbname=pfa;charset=utf8', 'root', '');
      }
      catch(Exception $e)
      {
        die('Erreur : '.$e->getMessage());
      }
      if(isset($_POST["valider"])){
        $Produit= $_POST["Produit"] ;
        $Numero_Produit= $_POST["Numero_Produit"] ;
        $Quantite= $_POST["Quantite"] ;
        $Prix_Unit= $_POST["Prix_Unit"] ;
        $result = $bdd->prepare("INSERT INTO `produit`(`produit`, `quantite`, `prix_unit`) VALUES (:Produit,:Quantite,:Prix_Unit)");
        $result->execute(array(
          'Produit'=>$Produit,
          'Quantite'=>$Quantite,
          'Prix_Unit'=>$Prix_Unit
          ));
          if($result){
            header("Location:produit.php");
          }
        }

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
  <link href="../css/sb-admin.css" rel="stylesheet">
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="acc.php">SC-Supermarche</a>
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
    <form class="insertion" action='' method="POST">
      <table border="0" align="center" cellspacing="2" cellpadding="2">
          <tr align="center">
             <td>Produit</td>
             <td><input type="text" name="Produit" ></td>
          </tr>
          <tr align="center">
             <td>Numero Produit</td>
             <td><input type="integer" name="Numero_Produit" ></td>
          </tr>
          <tr align="center">
             <td>Quantite</td>
             <td><input type="integer" name="Quantite" ></td>
          </tr>
          <tr align="center">
             <td>Prix_Unit</td>
             <td><input type="integer" name="Prix_Unit" ></td>
          </tr>
          <tr align="center">
             <td colspan="2"><input type="submit" value="Ajouter" name="valider"></td>
          </tr>
      </table>
  </form>
</div>
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © SC-Rachid</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Bootstrap core JavaScript-->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
  </div>
</body>

</html>