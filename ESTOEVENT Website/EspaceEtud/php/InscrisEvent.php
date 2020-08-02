<?php
$inscris=1;
if(isset($_GET['inscrisEvent']) && !empty($_GET['inscrisEvent']) && isset($_GET['ID_Etudiant']) &&  !empty($_GET['ID_Etudiant']) ){
    
    $ID_EVENT = $_GET['inscrisEvent'];
    $ID_ETUDIANT = $_GET['ID_Etudiant'];
    
    $queryFetchInscription = "SELECT * FROM inscription WHERE  ID_Etudiant =:ID_Etudiant AND  ID_Evenement =:ID_Evenement ";
    $stmtFetchInscription= $db->prepare($queryFetchInscription);
    $stmtFetchInscription->bindParam(":ID_Etudiant",$_SESSION['ID_Etudiant'],PDO::PARAM_INT);
    $stmtFetchInscription->bindParam(":ID_Evenement",$event['ID_Evenement'],PDO::PARAM_INT);
    $stmtFetchInscription->execute();
    $count = $stmtFetchInscription->rowCount();
    $inscrisValue =$stmtFetchInscription->fetch();
    $inscrisEvent= $inscrisValue['inscris'];
    if($count == 0 ){
        $inscrisQuery = "INSERT INTO inscription(ID_Evenement,ID_Etudiant,inscris) values (:ID_Evenement, :ID_Etudiant, :inscris)";
        $resultinscrisQuery = $db->prepare($inscrisQuery);
        $resultinscrisQuery->bindParam(":ID_Evenement",$ID_EVENT,PDO::PARAM_INT);
        $resultinscrisQuery->bindParam(":ID_Etudiant",$ID_ETUDIANT,PDO::PARAM_INT);
        $resultinscrisQuery->bindParam(":inscris",$inscris,PDO::PARAM_INT);
        $resultinscrisQuery->execute(); 
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
        $url = "https://";   
        else  
              $url = "http://";   
        // Append the host(domain name, ip) to the URL.   
        $url.= $_SERVER['HTTP_HOST'];   
        
        // Append the requested resource location to the URL   
        $url.= $_SERVER['REQUEST_URI'];    
          
        $new_url = strtok($url, '?');
        header("refresh: 1, url=$new_url"."#listEvents");
        ob_end_flush(); 
        echo "<script>";
        echo '
        Swal.fire({
            icon: "success",
            title:  "Vous êtes inscrit à l\'évènement",
            showConfirmButton: false,
            timer: 1500
          })
        ';
      echo "</script>";    

    }elseif($count == 1 || $inscrisEvent == 0){
        $inscris=1;
        $reinscrisQuery = "UPDATE inscription SET inscris = ? WHERE ID_Etudiant = ? AND ID_Evenement = ?";
        $resultreinscrisQuery = $db->prepare($reinscrisQuery);
        $resultreinscrisQuery->execute([$inscris,$ID_ETUDIANT,$ID_EVENT]);
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
        $url = "https://";   
        else  
              $url = "http://";   
        // Append the host(domain name, ip) to the URL.   
        $url.= $_SERVER['HTTP_HOST'];   
        
        // Append the requested resource location to the URL   
        $url.= $_SERVER['REQUEST_URI'];    
          
        $new_url = strtok($url, '?');
        header("refresh: 1, url=$new_url"."#listEvents");
        echo "<script>";
        echo '
        Swal.fire({
            icon: "success",
            title:  "Vous êtes inscrit à l\'évènement",
            showConfirmButton: false,
            timer: 2500
          })
        ';
      echo "</script>";     
    }


}

?>