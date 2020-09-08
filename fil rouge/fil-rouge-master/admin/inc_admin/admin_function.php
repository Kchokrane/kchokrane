<?php
require '../inc/config.php';
  //récupérer tous les categorie des produits depuis la base de données
  function categories($db){
  $query1 = $db->prepare("SELECT DISTINCT categorie FROM produits where quantite>0");
  $query1->execute();
  $categories = $query1->fetchAll();
  return $categories;
  }
//Ajouter Produit
function AjouterProduit($libelle,$prix,$quantite,$image,$categorie,$description, $db)
{
   $sql = "INSERT INTO `produits`(`libelle`, `prix`, `quantite`, `image`,`categorie`, `description`) VALUES (:libelle,:prix,:quantite,:image,:categorie,:description)";
   $stat= $db->prepare($sql);
   $data=[
        'libelle' => $libelle,
        'prix' => $prix,
        'quantite' => $quantite,
        'image'=>$image,
        'categorie'=>$categorie,
        'description' => $description
   ];
   if($stat->execute($data)) {
      return true;
   }
}


//Modifier Produit
function ModifierProduit($idp,$libelle,$prix,$quantite,$categorie,$description, $db)
{
   $sql = "UPDATE `produits` SET `libelle`=:libelle,`prix`=:prix,`quantite`=:quantite,`categorie`=:categorie,`description`=:description WHERE id=:idp";
   $stat= $db->prepare($sql);
   $data=[
        'libelle' => $libelle,
        'prix' => $prix,
        'quantite' => $quantite,
        'categorie'=>$categorie,
        'description' => $description,
        'idp'=>$idp
   ];
   if($stat->execute($data)) {
      return true;
   }
}


// supprimer produit
function SupprimerProduit($idp, $db)
{
   $sql = "DELETE FROM produits WHERE id = :idp";
   $stat= $db->prepare($sql);
   $stat->bindValue(':idp', $idp);
   if($stat->execute()) {
      $sql2 = "DELETE FROM panier WHERE idProduit = :idp";
      $stat2= $db->prepare($sql2);
      $stat2->bindValue(':idp', $idp);
      if($stat2->execute()) {
      return true;
      }
   }
}
	//récupérer le nombre de message 
	function nombreMessages($db){
   $sql = "SELECT COUNT(id) AS num FROM messages";
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
   return $row['num'];
   }
?>