<script src="js/sweetalert2.all.min.js"></script>
<?php
require_once ('../../includesPhp/conn.php');
session_start();
$userID = $_SESSION['ID_Professeur'];

try{
       $db->beginTransaction();
            $NomProf = htmlspecialchars($_POST['nom']);    
            $PrenomProf = htmlspecialchars($_POST['prenom']);
            $DisciplineProf = htmlspecialchars($_POST['discipline']);
            $Password = htmlspecialchars(hash("sha512",$_POST['password']));
            var_dump($_FILES);
            if(isset($_FILES['photoProfil']) AND !empty($_FILES['photoProfil']['name'])){
                $images=$_FILES['photoProfil']['name'];
                $tmp_dir=$_FILES['photoProfil']['tmp_name'];
                $imageSize=$_FILES['photoProfil']['size'];
                $upload_dir='../../../SignUpProf/php/uploads/';
                $imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
                $valid_extensions=array('jpeg', 'jpg', 'png', 'gif');
                  if(in_array($imgExt,$valid_extensions)){
                    $photoProfil=$NomProf.$PrenomProf."Profil.".$imgExt;
                    $result=move_uploaded_file($tmp_dir, $upload_dir.$photoProfil);

                  }else{
                      
                        echo "<script>alert(\"Votre photo de profil doit etre jpg,jpeg,png ou gif!\")</script>";
                  }
            }else{
                echo "rien de rien";
            }
            
            if(!empty($_POST['nom']) OR !empty($_POST['prenom'])OR !empty($_POST['discipline']) )
            {
                if(filter_var($NomProf, FILTER_SANITIZE_STRING) || filter_var($PrenomProf, FILTER_SANITIZE_STRING) ) 
                {
                     if(strlen($NomProf) >= 4 && strlen($PrenomProf) >= 4 ){ 

                        if(!empty($_POST['password']) ){    

                            if(!empty($_FILES['photoProfil']['name'])){

                                $stmt=$db->prepare("update professeur SET nomProf=?, prenomProf=? , Discipline=?, motDePasse=?, photoProf=? where ID_Professeur=? ");
                                $stmt->execute([$NomProf,$PrenomProf,$DisciplineProf,$Password,$photoProfil,$userID]);
                                $db->commit();
                                
                                $select = "SELECT nomProf,prenomProf, Discipline FROM professeur WHERE ID_Professeur= :ID_Professeur ";
                                $result = $db->prepare($select);
                                $result->bindParam(':ID_Professeur',$ID_Professeur);
                                $result->execute();
                                $data=$result->fetchAll(PDO::FETCH_ASSOC);
                                json_encode($data, JSON_UNESCAPED_UNICODE); 

                            }else{

                                var_dump($_POST);
                                $stmt=$db->prepare("update professeur SET nomProf=?, prenomProf=? , Discipline=?, motDePasse=? where ID_Professeur=? ");
                                $stmt->execute([$NomProf,$PrenomProf,$DisciplineProf,$Password,$userID]);
                                $db->commit();
                                
                                $select = "SELECT nomProf,prenomProf, Discipline FROM professeur WHERE ID_Professeur= :ID_Professeur ";
                                $result = $db->prepare($select);
                                $result->bindParam(':ID_Professeur',$ID_Professeur);
                                $result->execute();
                                $data=$result->fetchAll(PDO::FETCH_ASSOC);
                                json_encode($data, JSON_UNESCAPED_UNICODE); 
                            }


                            //echo "<script>alert('Votre Compte a été bien modifiée')</script>";
                            //header("Refresh:0; url=../index.php");
                            //header('Location: ../index.php');                            
                            //$success="Votre Compte a été bien modifiée";                
                        }else{
                             if(empty($_FILES['photoProfil']['name'])){
                            $stmt=$db->prepare("update professeur SET nomProf=?, prenomProf=? , Discipline=? where ID_Professeur=? ");
                            $stmt->execute([$NomProf,$PrenomProf,$DisciplineProf,$userID]);
                            $db->commit();
                            var_dump($_POST);
                            
                            $select = "SELECT nomProf,prenomProf, Discipline FROM professeur WHERE ID_Professeur= :ID_Professeur ";
                            $result = $db->prepare($select);
                            $result->bindParam(':ID_Professeur',$ID_Professeur);
                            $result->execute();
                            $data=$result->fetchAll(PDO::FETCH_ASSOC);
                            json_encode($data, JSON_UNESCAPED_UNICODE); 

                            }else{
                                $stmt=$db->prepare("update professeur SET nomProf=?, prenomProf=? , Discipline=? , photoProf=? where ID_Professeur=? ");
                                $stmt->execute([$NomProf,$PrenomProf,$DisciplineProf,$photoProfil,$userID]);
                                $db->commit();
                                var_dump($_POST);
                                
                                $select = "SELECT nomProf,prenomProf, Discipline FROM professeur WHERE ID_Professeur= :ID_Professeur ";
                                $result = $db->prepare($select);
                                $result->bindParam(':ID_Professeur',$ID_Professeur);
                                $result->execute();
                                $data=$result->fetchAll(PDO::FETCH_ASSOC);
                                json_encode($data, JSON_UNESCAPED_UNICODE); 
                            }
                            //echo "<script>alert('Votre Compte a été bien modifiée')</script>";
                             //header('Location: ../index.php');     
                            //$success="Votre Compte a été bien modifiée";
                        }

                        }else{
                            $error="Votre nom ou prenom sont trés court";                          
                        }
                 }else{
                    $error="Votre nom ou prenom sont pas valides";             
                 }
        }else{
                $error="les champs nom,prenom et discipline doivent etre remplir";                
        }

}catch(PDOException $e){
    echo $e->getMessage();
    $db->rollBack();
}
