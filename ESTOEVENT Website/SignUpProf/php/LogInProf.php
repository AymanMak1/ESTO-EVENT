<script src="../js/sweetalert2.all.min.js"></script>
<?php
require_once '../includesPhp/conn.php';
session_start();
try{
    if(isset($_POST['LogIn'])){
        $INom=htmlspecialchars($_POST['INom']);
        $IPrenom=htmlspecialchars($_POST['IPrenom']);
        $IPassword = htmlspecialchars(hash("sha512",$_POST['IPwd']));
        if(!empty($INom) AND !empty($IPrenom) AND !empty($IPassword)){
            $requser = $db->prepare("SELECT * FROM professeur WHERE nomProf =:nomProf AND prenomProf =:prenomProf AND motDePasse=:motDePasse");
            $requser->bindParam(':nomProf',$INom);
            $requser->bindParam(':prenomProf',$IPrenom);
            $requser->bindParam(':motDePasse',$IPassword);
            $requser->execute();
            $userexist = $requser->RowCount();
            if($userexist == 1) {
                $userinfo = $requser->fetch();
                $_SESSION['ID_Professeur'] = $userinfo['ID_Professeur'];
                $_SESSION['ID_Departement'] = $userinfo['ID_Departement'];
                $_SESSION['nomProf'] = $userinfo['nomProf'];
                $_SESSION['prenomProf'] = $userinfo['prenomProf']; 
                $_SESSION['Discipline'] = $userinfo['Discipline'];
                $_SESSION['motDePasse'] = $userinfo['motDePasse'];
                $_SESSION['photoProf'] = $userinfo['photoProf'];
               header("Location:../../EspaceProf/dashboard/index.php");
            } else{
                echo '<script type="text/javascript">';
                
                echo 'setTimeout(function () { Swal.fire({
                     icon: "error",
                     title: "Oops...",
                     text: "Votre mot de passe, nom ou prenom est incorrecte !",
                   }).then((value) => {
                     window.location=\'../LoginProf.php\'
                   })';
                
                echo '}, 1000); </script> ';
            }
            
        }else{
            echo '<script type="text/javascript">';
                
            echo 'setTimeout(function () { Swal.fire({
                 icon: "error",
                 title: "Oops...",
                 text: "Tous les champs doivent etre remplir !",
               }).then((value) => {
                 window.location=\'../LoginProf.php\'
               })';
            
            echo '}, 1000); </script> ';
        }
    }
}catch(PDOException $e){
    echo $e->getMessage();
}
?>