<script src="../js/sweetalert2.all.min.js"></script>
<?php
require_once '../includesPhp/conn.php';
session_start();
try{
    if(isset($_POST['LogIn'])){
        $IEmail=htmlspecialchars($_POST['IEmail']);
        $IPassword = htmlspecialchars(hash("sha512",$_POST['IPwd']));
        if(!empty($IEmail) AND !empty($IPassword)){
            $requser = $db->prepare("SELECT * FROM 'etudiant' WHERE 'Email' =:Email  AND 'motDePasse' =:motDePasse");
            $requser->bindParam(':Email',$IEmail, PDO::PARAM_STR);
            $requser->bindParam(':motDePasse',$IPassword, PDO::PARAM_STR); ;
            $requser->execute();
            $userexist = $requser->RowCount();
            if($userexist == 1) {
                $userinfo = $requser->fetch();
                $_SESSION['ID_Etudiant'] = $userinfo['ID_Etudiant'];
                $_SESSION['Email'] = $userinfo['Email'];
                $_SESSION['nomEtud'] = $userinfo['nomEtud']; 
                $_SESSION['prenomEtud'] = $userinfo['prenomEtud'];
                $_SESSION['motDePasse'] = $userinfo['motDePasse'];

               header("Location:../../EspaceEtud/Etudiant.php");
            } else{
                echo '<script type="text/javascript">';
                
                echo 'setTimeout(function () { Swal.fire({
                     icon: "error",
                     title: "Oops...",
                     text: "Votre mot de passe ou votre email est incorrecte !",
                   }).then((value) => {
                     window.location=\'../LoginEtud.php\'
                   })';
                
                echo '}, 1000); </script> ';
                

            }
            
        }else
        {
            echo '<script type="text/javascript">';
                        
            echo 'setTimeout(function () { Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Tous les champs doivent etre remplir !",
              }).then((value) => {
                window.location=\'../LoginEtud.php\'
              })';
           
           echo '}, 1000); </script> ';
        }
    }
}catch(PDOException $e){
    echo $e->getMessage();
}
?>