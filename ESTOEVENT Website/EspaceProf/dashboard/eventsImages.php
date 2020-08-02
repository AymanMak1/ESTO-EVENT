<?php 
require_once "vistas/parte_superior.php";
require_once '../includesPhp/conn.php';
$consulter = "SELECT * FROM evenement e, departement d where ID_Professeur=:ID_Professeur AND d.ID_Departement = e.ID_Departement";
$resultatConsulter = $db->prepare($consulter);
$resultatConsulter->bindParam(':ID_Professeur',$_SESSION['ID_Professeur']);
$resultatConsulter->execute();
$data=$resultatConsulter->fetchAll(PDO::FETCH_ASSOC);

?>
<style>

</style>

<div class="container">
    <h1>Events Images</h1>
 
</div>
	
<!--FIN del cont principal-->

<?php require_once "vistas/parte_inferior.php"?>