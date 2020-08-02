<script src="../js/sweetalert2.all.min.js"></script>
<?php
require_once ('../includesPhp/conn.php');
session_start();
$userID = $_SESSION['ID_Etudiant'];

try{
       $db->beginTransaction();
            $NomEtud= htmlspecialchars($_POST['nom']);    
            $PrenomEtud = htmlspecialchars($_POST['prenom']);
            $Password = htmlspecialchars(hash("sha512",$_POST['password']));
            if(!empty($_POST['nom']) OR !empty($_POST['prenom']))
            {
                if(filter_var($NomEtud, FILTER_SANITIZE_STRING) || filter_var($PrenomEtud, FILTER_SANITIZE_STRING) ) 
                {
                     if(strlen($NomEtud) >= 4 && strlen($PrenomEtud) >= 4 ){ 

                        if(!empty($_POST['password']) ){
                            var_dump($_POST);
                            $stmt=$db->prepare("update etudiant SET nomEtud=?, prenomEtud=? , motDePasse=? where ID_Etudiant=? ");
                            $stmt->execute([$NomEtud,$PrenomEtud,$Password,$userID]);
                            $db->commit();
                            
                            $select = "SELECT nomEtud,prenomEtud FROM Etudiant WHERE ID_Etudiant= :ID_Etudiant ";
                            $result = $db->prepare($select);
                            $result->bindParam(':ID_Etudiant',$ID_Etudiant);
                            $result->execute();
                            $data=$result->fetchAll(PDO::FETCH_ASSOC);
                            json_encode($data, JSON_UNESCAPED_UNICODE); 
                            //echo "<script>alert('Votre Compte a été bien modifiée')</script>";
                            //header("Refresh:0; url=../index.php");
                            //header('Location: ../index.php');                            
                            //$success="Votre Compte a été bien modifiée";  

                        }else{
                            
                            $stmt=$db->prepare("update etudiant SET nomEtud=?, prenomEtud=? where ID_Etudiant=?");
                            $stmt->execute([$NomEtud,$PrenomEtud,$userID]);
                            $db->commit();
                            var_dump($_POST);

                            $select = "SELECT nomEtud,prenomEtud FROM Etudiant WHERE ID_Etudiant= :ID_Etudiant ";
                            $result = $db->prepare($select);
                            $result->bindParam(':ID_Etudiant',$ID_Etudiant);
                            $result->execute();
                            $data=$result->fetchAll(PDO::FETCH_ASSOC);
                            json_encode($data, JSON_UNESCAPED_UNICODE); 
                            //echo "<script>alert('Votre Compte a été bien modifiée')</script>";
                             //header('Location: ../index.php');     
                            //$success="Votre Compte a été bien modifiée";
                        }

                        }else{
                            $error="Votre nom ou prenom sont trés court";                          
                        }
                 }else{
                    $error="Votre nom ou prenom sont pas validés";             
                 }
        }else{
                $error="les champs nom,prenom doivent être remplir";                
        }

}catch(PDOException $e){
    echo $e->getMessage();
    $db->rollBack();
}
