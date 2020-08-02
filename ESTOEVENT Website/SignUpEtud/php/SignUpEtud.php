<script src="../js/sweetalert2.all.min.js"></script>
<?php
require_once '../includesPhp/conn.php';
try{
    $db->beginTransaction();
    if(isset($_POST['SignUp'])) 
    {
            $Email = htmlspecialchars($_POST['Email']);
            $NomEtud = htmlspecialchars($_POST['NomEtud']);    
            $PrenomEtud = htmlspecialchars($_POST['PrenomEtud']);
            $Password = htmlspecialchars(hash("sha512",$_POST['SPwd']));
            $ConfirmPassword = htmlspecialchars(hash("sha512",$_POST['CPwd']));
            $vkey = md5(time()+rand());
            if(!empty($_POST['Email']) OR !empty($_POST['NomEtud']) OR !empty($_POST['PrenomEtud']) OR !empty($_POST['SPwd']) OR !empty($_POST['CPwd']))
            {
                if(filter_var($NomEtud, FILTER_SANITIZE_STRING) || filter_var($PrenomEtud, FILTER_SANITIZE_STRING) ) 
                {
                if(filter_var($Email, FILTER_VALIDATE_EMAIL))
                {
                    $reqmail = $db->prepare("SELECT * FROM etudiant WHERE Email = ?");
                    $reqmail->execute([$Email]);
                    $mailexist = $reqmail->rowCount();

                        if($mailexist == 0) {
                            if(strlen($NomEtud) >= 4 && strlen($PrenomEtud) >= 4 ){
                                if($Password == $ConfirmPassword){
                                    $stmt=$db->prepare("insert into etudiant (Email,nomEtud,prenomEtud,motDePasse,verifiedEmail,vkey) values (:Email, :nomEtud, :prenomEtud, :motDePasse, :verifiedEmail, :vkey)");
                                    $stmt->bindParam(':Email',$Email);
                                    $stmt->bindParam(':nomEtud', $NomEtud);
                                    $stmt->bindParam(':prenomEtud',$PrenomEtud);
                                    $stmt->bindParam(':motDePasse',$Password);
                                    $vEmail= 0;
                                    $stmt->bindParam(':verifiedEmail',$vEmail);
                                    // Email Verification through gmail
                                    $stmt->bindParam(':vkey',$vkey);
                                    /*
                                    ini_set("smtp_port","25");
                                    ini_set("SMTP","nocontact@gmail.com");
                                    $to= $Email;
                                    $subject = "Email Verification";
                                    $message="<a href='verify.php?vkey=$vkey'>Register Account</a>";
                                    $headers = "From :nocontact@gmail.com";
                                    $headers .= "Mime-Version: 1.0" . "\r\n";
                                    $headers .="Content-type:text/html;charset=UTF-8" . "\r\n";
                                    mail($to, $subject, $message, $headers);
                                    */
                                    $stmt->execute();
                                    $db->commit();
                                                                        
                                    echo '<script type="text/javascript">';
 
                                    echo 'setTimeout(function () { swal.fire("Votre Compte a été bien créé, consulter votre email et faire la verification de votre email","","success").then((value) => {
                                        window.location=\'../LoginEtud.php\'
                                      })';
     
                                    echo '}, 1000);</script>';
                                }else{
                                                                                                           
                                   echo '<script type="text/javascript">';
        
                                   echo 'setTimeout(function () { Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: "Vos mots de passes ne correspondent pas !",
                                      }).then((value) => {
                                        window.location=\'../LoginEtud.php\'
                                      })';

                                   echo '}, 1000); </script> ';
                                }
                            }else{
                                                                                                                                           
                                echo '<script type="text/javascript">';
        
                                echo 'setTimeout(function () { Swal.fire({
                                     icon: "error",
                                     title: "Oops...",
                                     text: "Votre nom ou prenom sont trés court !",
                                   }).then((value) => {
                                    window.location=\'../LoginEtud.php\'
                                  })';

                                echo '}, 1000); </script>';

                            }
                        }
                    else
                    {
                        echo '<script type="text/javascript">';
        
                        echo 'setTimeout(function () { Swal.fire({
                             icon: "error",
                             title: "Oops...",
                             text: "Adresse mail déjà utilisée !",
                           }).then((value) => {
                            window.location=\'../LoginEtud.php\'
                          }) ';

                        echo '}, 1000);</script>';

                    }
                }else
                {
                    echo '<script type="text/javascript">';
        
                    echo 'setTimeout(function () { Swal.fire({
                         icon: "error",
                         title: "Oops...",
                         text: "Votre adresse mail n\'est pas valide !",
                       }) .then((value) => {
                        window.location=\'../LoginEtud.php\'
                      })';

                    echo '}, 1000);</script>';
                }
                }else{
                    echo '<script type="text/javascript">';
        
                    echo 'setTimeout(function () { Swal.fire({
                         icon: "error",
                         title: "Oops...",
                         text: "Type is not valid",
                       }).then((value) => {
                        window.location=\'../LoginEtud.php\'
                      })';
    
                    echo '}, 1000);</script>';

                }
            }else
            {
                echo '<script type="text/javascript">';
        
                echo 'setTimeout(function () { Swal.fire({
                     icon: "error",
                     title: "Oops...",
                     text: "Tous les champs doivent être complétés !",
                   }) .then((value) => {
                    window.location=\'../LoginEtud.php\'
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
