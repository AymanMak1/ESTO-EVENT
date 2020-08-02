<?php

//load.php

require_once '../includesPhp/conn.php';

$data = array();

$query = "SELECT * FROM evenement ORDER BY ID_Evenement";

$statement = $db->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'ID_Evenement'   => $row["ID_Evenement"],
  'sujetEvent'   => $row["sujetEvent"],
  'dateDebut'   => $row["dateDebut"],
  'dateFin'   => $row["dateFin"]
 );
}

echo json_encode($data);

?>

