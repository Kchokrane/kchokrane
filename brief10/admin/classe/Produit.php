<?php
 require '../../codesource/Database/database.php';
class Produit{
    private   $Nom;
    private  $Qte_MAX;
    private  $IMAGE;
    private  $Nom_cat;
    private  $Prix;
    private  $status = false;
    private  $db;
    public function getNom(){
         return $this->Nom;
    }
    public function getQte_MAX(){
    return $this->Qte_MAX;
    }     
    public function getImage(){
    return $this->IMAGE;
    }        
    public function getNom_Cat(){
       return $this->Nom_cat;
    }           
    public function getPrix(){
          return $this->Prix;
    }
    //setters
    public function setNom($nom){
        $this->Nom = $nom;
   }

   public function setQte_MAX($qte){
    $this->Qte_MAX = $qte;
   }     
   public function setImage($image){
    $this->IMAGE = $image;
   }        
   public function setNom_Cat($Nom_cat){
    $this->Nom_cat = $Nom_cat;
   }           
   public function setPrix($Prix){
    $this->Prix = $Prix;
   }
   //constructor
    public function __construct(){
        $this->db = Database::connect();
    }
    public  function  __destruct(){
        Database::disconnect();
 }
    //Ajoute
    public function Ajoute($Nom,$Qte_MAX,$IMAGE,$Nom_cat,$Prix){
        $this->setNom($Nom);
        $this->setQte_MAX($Qte_MAX);
        $this->setImage($IMAGE);
        $this->setNom_Cat($Nom_cat);
        $this->setPrix($Prix);
        try{
            $statement = $this->db->prepare("Insert into produit (NOM,QTE_MAX,IMAGE,Nom_cat,PRIX) value(?,?,?,?,?)");
            $statement->execute(array($this->getNom(),$this->getQte_MAX(),$this->getImage(),$this->getNom_Cat(),$this->getPrix())); 
            
            $this->$status = true;
        }catch(Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
        return $this->$status;
    }    
    public function Update($nom_prd,$qte_max,$categorie,$prix,$id){
        try{
            
            $statement = $this->db->prepare("Update produit set NOM = ?,QTE_MAX = ?,Nom_cat = ?,PRIX = ? where  ID_PRD = ?");
            $statement->execute([$nom_prd,$qte_max,$categorie,$prix,$id]);     
            $this->$status = true;
        }catch(Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
        return $this->$status;
    }
    public function Delete($id){
        try{
            $statement = $this->db->prepare("delete from produit where ID_PRD = ?");
            $statement->execute(array($id));
            $this->$status = true;
        }catch(Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
        return $this->$status;
    }   
}
