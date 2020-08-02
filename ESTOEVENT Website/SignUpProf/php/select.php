<?php
$DepartementProf='management';
require_once '../includesPhp/conn.php';
$reqiddept=$db->prepare("SELECT id_departement FROM departement WHERE nomdept =:nomdept");
$reqiddept->bindParam(':nomdept',$DepartementProf);
$resultiddept=$reqiddept->execute();
echo $resultiddept;