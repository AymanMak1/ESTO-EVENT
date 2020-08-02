<script src="../js/sweetalert2.all.min.js"></script>
<?php
require_once ('../../includesPhp/conn.php');

session_start();
//var_dump($_POST);
//var_dump($_FILES);

$ID_Evenement = (isset($_REQUEST['ID_Evenement'])) ? $_REQUEST['ID_Evenement'] : '';
$option = (isset($_REQUEST['option'])) ? $_REQUEST['option'] : '';
$ID_Professeur = $_SESSION['ID_Professeur'];
$ID_Departement=$_REQUEST['ID_Departement'];
$sujetEvent = $_REQUEST['sujetEvent'];
$descriptionEvent =$_REQUEST['descriptionEvent'];
//$photoEvent = $_REQUEST['photoEvent'];
$dateDebut =date("d-m-Y h:i", strtotime($_REQUEST['dateDebut']));
$dateFin = date("d-m-Y h:i", strtotime($_REQUEST['dateFin']));
$data= "1";

if(isset($_FILES['photoEvent']) AND !empty($_FILES['photoEvent']['name'])){
    $images=$_FILES['photoEvent']['name'];
    $tmp_dir=$_FILES['photoEvent']['tmp_name'];
    $imageSize=$_FILES['photoEvent']['size'];
    $upload_dir='../../../uploadsEvents/';
    $imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
    $valid_extensions=array('jpeg', 'jpg', 'png', 'gif');
      if(in_array($imgExt,$valid_extensions)){
        $photoEventSpace=$sujetEvent.".".$imgExt;
        $photoEvent=str_replace(' ', '_',$photoEventSpace);
        $result=move_uploaded_file($tmp_dir, $upload_dir.$photoEvent);
      }else{
          
            echo "<script>alert(\"Votre photo de profil doit etre jpg,jpeg,png ou gif!\")</script>";
      }
}else{
    echo "<script>alert(\"Vous avez rien importer !!\")</script>";
}

switch($option){
    case 1: //insertion
        $insert = "INSERT INTO evenement (ID_Professeur,ID_Departement,sujetEvent,descriptionEvent,photoEvent,dateDebut,dateFin)
         VALUES(:ID_Professeur,:ID_Departement,:sujetEvent,:descriptionEvent,:photoEvent,:dateDebut,:dateFin) ";			
        $result = $db->prepare($insert);
        $result->bindParam(':ID_Professeur',$ID_Professeur);
        $result->bindParam(':ID_Departement',$ID_Departement);
        $result->bindParam(':sujetEvent',$sujetEvent);
        $result->bindParam(':descriptionEvent',$descriptionEvent);
        $result->bindParam(':photoEvent',$photoEvent);
        $result->bindParam(':dateDebut',$dateDebut);
        $result->bindParam(':dateFin',$dateFin);
        $result->execute(); 

        $select = "SELECT * FROM evenement e, departement d WHERE ID_Professeur= :ID_Professeur AND d.ID_Departement = e.ID_Departement ORDER BY ID_Evenement DESC LIMIT 1 ";
        $result = $db->prepare($select);
        $result->bindParam(':ID_Professeur',$ID_Professeur);
        $result->execute();
        $data=$result->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data, JSON_UNESCAPED_UNICODE); //envoyer le tableau final au format json à JS
        

        break;
    case 2: //modification

        $ID_Professeur = $_SESSION['ID_Professeur'];
        $ID_Departement=$_GET['ID_Departement'];
        $sujetEvent = $_GET['sujetEvent'];
        $descriptionEvent =$_GET['descriptionEvent'];
        $photoEvent = $_GET['photoEvent'];
        $dateDebut =date("Y-m-d h:i", strtotime($_GET['dateDebut']));
        $dateFin = date("Y-m-d h:i", strtotime($_GET['dateFin']));

        $update = "UPDATE evenement SET  ID_Departement=?,  sujetEvent=?, descriptionEvent=?, photoEvent=?, dateDebut= ?, dateFin =?
        WHERE  ID_Professeur=? AND ID_Evenement =? " ; 

        $result = $db->prepare($update);
        $result->execute([$ID_Departement,$sujetEvent, $descriptionEvent, $photoEvent, $dateDebut, $dateFin,$ID_Professeur, $ID_Evenement]);

        var_dump( $result->execute([$ID_Departement,$sujetEvent, $descriptionEvent, $photoEvent, $dateDebut, $dateFin,$ID_Professeur, $ID_Evenement]));
        $count = $result->rowCount();
        echo $count;
        
        $select = "SELECT * FROM evenement e, departement d WHERE ID_Professeur= :ID_Professeur AND d.ID_Departement = e.ID_Departement ORDER BY ID_Evenement DESC LIMIT 1 ";
        $result = $db->prepare($select);
        $result->bindParam(':ID_Professeur',$ID_Professeur);
        $result->execute();
        $data=$result->fetchAll(PDO::FETCH_ASSOC);
        json_encode($data, JSON_UNESCAPED_UNICODE); //envoyer le tableau final au format json à JS

        break;        
    case 3://suppression
        $delete = "DELETE FROM evenement WHERE ID_Evenement=:ID_Evenement";
        $result = $db->prepare($delete);
        $result->bindParam('ID_Evenement',$ID_Evenement);
        $result->execute();
        
        $select = "SELECT * FROM evenement e, departement d WHERE ID_Professeur= :ID_Professeur AND d.ID_Departement = e.ID_Departement ORDER BY ID_Evenement DESC LIMIT 1 ";
        $result = $db->prepare($select);
        $result->bindParam(':ID_Professeur',$ID_Professeur);
        $result->execute();
        $data=$result->fetchAll(PDO::FETCH_ASSOC);
        break;       
}
json_encode($data, JSON_UNESCAPED_UNICODE);
//$conexion = NULL;

