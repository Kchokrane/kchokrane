<?php

require 'config.php';
//changerQuantite
function changerQuantite($idp, $idc,$quantite, $db)
{
   $sql = "UPDATE panier SET quantite = :quantite  WHERE idProduit = :idp AND idClient = :idc";
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':quantite', $quantite);
   $stmt->bindValue(':idp', $idp);
   $stmt->bindValue(':idc', $idc);

   if($stmt->execute())
      return true;
}
//Ajouter Produit dans Panier
function ajouterProduit($idp, $idc, $quantity, $taille, $db)
{
   if(produitExiste($idp, $idc, $db)) {
      $quantite = quantiteProduit($idp, $idc, $db);
      if(changerQuantite($idp, $idc, $quantite+$quantity, $db))
         return true;
   }
   else {
      $data = [
			'idProduit' => $idp,
         'idClient' => $idc,
         'taille'=>$taille,
			'quantite' =>$quantity,
		];
		$sql = "INSERT INTO panier (idProduit, idClient,taille, quantite) VALUES (:idProduit, :idClient,:taille, :quantite)";
		$stat= $db->prepare($sql);
		if($stat->execute($data)) {
         return true;
      }
   }
}
// Produit Existe dans panier 
function produitExiste($idp, $idc, $db)
{
   $sql = "SELECT COUNT(id) AS num FROM panier WHERE idProduit = :idp AND idClient = :idc";
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':idp', $idp);
   $stmt->bindValue(':idc', $idc);
   $stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
   if($row['num'] > 0)
      return true;
   else
      return false;
}


function quantiteProduit($idp, $idc, $db)
{
   $sql = "SELECT quantite FROM panier WHERE idProduit = :idp AND idClient = :idc";
   $stmt = $db->prepare($sql);    
   $stmt->bindValue(':idp', $idp);
   $stmt->bindValue(':idc', $idc);
   $stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
   return $row['quantite'];
}

function supprimerProduit($idp, $idc, $db)
{
   $sql = "DELETE FROM panier WHERE idProduit = :idp AND idClient = :idc";
   $stat= $db->prepare($sql);
   $stat->bindValue(':idp', $idp);
   $stat->bindValue(':idc', $idc);
   if($stat->execute()) {
      return true;
   }
}
// Nombre Produits dans Panier
function nombreProduits($idc, $db)
{
   $sql = "SELECT COUNT(id) AS num FROM panier WHERE idClient = :idc";
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':idc', $idc);
   $stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
   return $row['num'];
}
//
function totalPrixPanier($idc, $db)
{
   $total = 0;
    $rows=lesProduitsExistent($idc, $db);
   foreach ($rows as $row) {
      $row2 = infosProduit($row['idProduit'], $db);
      $total += ($row2['prix'] * $row['quantite']);
   }
   return $total;
}

function lesProduitsExistent($idc, $db)
{
   $sql = "SELECT * FROM panier WHERE idClient = :idc";
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':idc', $idc);
   $stmt->execute();
   $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $produits;
}

function infosProduit($idp, $db)
{
   $sql = "SELECT * FROM produits WHERE id = :idp";
   $stmt = $db->prepare($sql);    
   $stmt->bindValue(':idp', $idp);
   $stmt->execute();
   $produit = $stmt->fetch(PDO::FETCH_ASSOC);
   return $produit;
}

function supprimerPanier($idc, $db)
{
   $sql = "DELETE FROM panier WHERE idClient = :idc";
   $stat= $db->prepare($sql);
   $stat->bindValue(':idc', $idc);
   if($stat->execute())
      return true;
}

?>