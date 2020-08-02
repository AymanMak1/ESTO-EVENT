<?php
$desinscris=0;

if(isset($_GET['desinscrisEvent']) && !empty($_GET['desinscrisEvent']) && isset($_GET['ID_Etudiant']) &&  !empty($_GET['ID_Etudiant']) ){
    $ID_EVENT = $_GET['desinscrisEvent'];
    $ID_ETUDIANT = $_GET['ID_Etudiant'];
    $desinscrisQuery = "UPDATE inscription SET inscris = ? WHERE ID_Etudiant = ? AND ID_Evenement = ?";
    $resultdesinscrisQuery = $db->prepare($desinscrisQuery);
    $resultdesinscrisQuery->execute([$desinscris,$ID_ETUDIANT,$ID_EVENT]);
  if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
  $url = "https://";   
  else  
        $url = "http://";   
  // Append the host(domain name, ip) to the URL.   
  $url.= $_SERVER['HTTP_HOST'];   
  
  // Append the requested resource location to the URL   
  $url.= $_SERVER['REQUEST_URI'];    
    
  $new_url = strtok($url, '?');
  header("refresh: 0, url=$new_url"."#listEvents");
  ob_end_flush(); 
  
  
  echo "<script>";
  echo '
  Swal.fire({
      icon: "success",
      title: "Vous êtes désinscrit de l\'évènement",
      showConfirmButton: false,
      timer: 2500
    })
  ';
echo "</script>"; 
}


?>