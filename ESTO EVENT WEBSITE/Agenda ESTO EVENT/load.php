<?php

//load.php

require_once 'conn.php';

$data = array();

$query = "SELECT * FROM events ORDER BY id";

$statement = $db->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
    'id'   => $row["id"],
    'title'   => $row["title"],
    'start'   => $row["start_event"],
    'end'   => $row["end_event"]
 );
}

echo json_encode($data);

?>

