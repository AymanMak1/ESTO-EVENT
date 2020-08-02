
<script src="../js/sweetalert2.all.min.js"></script>
<?php
require_once '../includesPhp/conn.php';
  try{
      $db->beginTransaction();
      if(isset($_POST['SignUp'])) 
      {
/******************************************Post Variables***************************************** */    

            $NomProf = htmlspecialchars($_POST['SNomProf']);    
            $PrenomProf = htmlspecialchars($_POST['SPrenomProf']);
            $DisciplineProf = htmlspecialchars($_POST['SDisciplineProf']);
            $DepartementProf = htmlspecialchars($_POST['SDépatementProf']);
            $Password = htmlspecialchars(hash("sha512",$_POST['SPwdProf']));
            $ConfirmPassword = htmlspecialchars(hash("sha512",$_POST['CSPwdProf']));
            $vkey = md5(time()+rand());
            if(!empty($_POST['SNomProf']) OR !empty($_POST['SPrenomProf'])OR !empty($_POST['SDisciplineProf']) 
            OR !empty($_POST['SPwdProf']) OR !empty($_POST['SCPwdProf']) OR !empty($_POST['SDépatementProf']))
            {
           
                if(filter_var($NomProf, FILTER_SANITIZE_STRING) || filter_var($PrenomProf, FILTER_SANITIZE_STRING) ) 
                {
          
                            if(strlen($NomProf) >= 4 && strlen($PrenomProf) >= 4 ){

                                if($Password == $ConfirmPassword){

/************************************************Traitement sur la photo de profil*******************************************/

                                      if(isset($_FILES['Pdp']) AND !empty($_FILES['Pdp']['name'])){

                                          $images=$_FILES['Pdp']['name'];
                                          $tmp_dir=$_FILES['Pdp']['tmp_name'];
                                          $imageSize=$_FILES['Pdp']['size'];
                                          $upload_dir='uploads/';
                                          $imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
                                          $valid_extensions=array('jpeg', 'jpg', 'png', 'gif', 'pdf');
                                            if(in_array($imgExt,$valid_extensions)){
                                              $picProfile=$PrenomProf.$NomProf."Profil.".$imgExt;
                                              $result=move_uploaded_file($tmp_dir, $upload_dir.$picProfile);
                                            }else{
                                              echo '<script type="text/javascript">';
                                  
                                              echo 'setTimeout(function () { Swal.fire({
                                                  icon: "error",
                                                  title: "Oops...",
                                                  text: "Votre photo de profil doit etre jpg,jpeg,png,gif ou pdf!",
                                                }).then((value) => {
                                                  window.location=\'../LoginProf.html\'
                                                })';
                                            }
                                          }
                                          else{
                                            echo 'setTimeout(function () { Swal.fire({
                                              icon: "error",
                                              title: "Oops...",
                                              text: "Veuillez choisir une photo pour votre profil",
                                            }).then((value) => {
                                              window.location=\'../LoginProf.html\'
                                            })';                                           
                                          }
/***************************************************INSERTION ***************************************************************/  
                                            
                                              if($result){
                                          
                                                            $reqiddept=$db->prepare("SELECT id_departement FROM departement WHERE nomdept =:nomdept");
                                                            $reqiddept->bindParam(':nomdept',$DepartementProf);
                                                            $id_dept=$reqiddept->execute();

                                                            $stmt=$db->prepare("insert into professeur (id_departement,nomprof,prenomprof,discipline,motdepasse,photoprof,verifiedEmail,vkey) 
                                                            values (:id_departement, :nomprof, :prenomprof,:discipline, :motdepasse,:photoprof,:verifiedEmail,:vkey)");
                                                            $stmt->bindParam(':id_departement',$id_dept);
                                                            $stmt->bindParam(':nomprof', $NomProf);
                                                            $stmt->bindParam(':prenomprof',$PrenomProf);
                                                            $stmt->bindParam(':discipline',$DisciplineProf);
                                                            $stmt->bindParam(':motdepasse',$Password);
                                                            $stmt->bindParam(':photoprof',$picProfile);
                                                            $vEmail= 0;
                                                            $stmt->bindParam(':verifiedEmail',$vEmail);
                                                            // Email Verification through gmail
                                                            $stmt->bindParam(':vkey',$vkey);
                                                            $stmt->execute();
                                                            $db->commit();
                                                                                       
                                                            echo '<script type="text/javascript">';
                        
                                                            echo 'setTimeout(function () { swal.fire("Votre Compte a été bien créé","","success").then((value) => {
                                                                window.location=\'../LoginProf.php\'
                                                              })';
                            
                                                            echo '}, 1000);</script>';

/********************************************************Erreurs*********************************************************** */

                                                }else{
                                                  echo '<script type="text/javascript">';
                                  
                                                  echo 'setTimeout(function () { Swal.fire({
                                                      icon: "error",
                                                      title: "Oops...",
                                                      text: "Erreur durant l\'importation de votre photo de profil!",
                                                    }).then((value) => {
                                                      window.location=\'../LoginProf.php\'
                                                    })';
                                                }
                                            
                                        }else{
                                                                                                                                      
                                          echo '<script type="text/javascript">';
                                  
                                          echo 'setTimeout(function () { Swal.fire({
                                              icon: "error",
                                              title: "Oops...",
                                              text: "Vos mot de passe ne correspondent pas!",
                                            }).then((value) => {
                                              window.location=\'../LoginProf.php\'
                                            })';
                                        }
                                    }else{
                                                                                                                                           
                                      echo '<script type="text/javascript">';
              
                                      echo 'setTimeout(function () { Swal.fire({
                                           icon: "error",
                                           title: "Oops...",
                                           text: "Votre nom ou prenom sont trés court !",
                                         }).then((value) => {
                                          window.location=\'../LoginProf.php\'
                                        })';
      
                                      echo '}, 1000); </script>';
                                 }
                        }else{
                              echo '<script type="text/javascript">';
                  
                              echo 'setTimeout(function () { Swal.fire({
                                  icon: "error",
                                  title: "Oops...",
                                  text: "le nom ou prenom n\'est pas correct !",
                                }).then((value) => {
                                  window.location=\'../LoginProf.php\'
                                })';

                              echo '}, 1000); </script>';
                        }
            }else
            {
                echo '<script type="text/javascript">';
        
                echo 'setTimeout(function () { Swal.fire({
                     icon: "error",
                     title: "Oops...",
                     text: "Tous les champs doivent être complétés !",
                   }) .then((value) => {
                    window.location=\'../LoginProf.php\'
                  })';

                echo '}, 1000);</script>';
            }
     
          } 
}catch(PDOException $e){
    echo $e->getMessage();
    $db->rollBack();
}

/*
$stmt=$dbh->prepare("insert into etudiant (ID_ETUDIANT,EMAIL,NOMETUD,PRENOMETUD,MOTDEPASSE) values (ID_Etudiant_seq.nextval, :EMAIL, :NOMETUD, :PRENOMETUD, :MOTDEPASSE)");
$stmt->bindValue(':EMAIL',"ayman.makhoukhi@gmail.com");
$stmt->bindValue(':NOMETUD', "Makhoukhi");
$stmt->bindValue(':PRENOMETUD',"Ayman" );
$stmt->bindValue(':MOTDEPASSE',"AYMAN2020");
$stmt->execute();
*/
?>
