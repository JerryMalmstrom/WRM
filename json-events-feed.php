<?php

	require('config.php');

try {
	
	
	$query = "SELECT * from vevents";

	$sql = $db->query($query);
	
		
   
    // Returning array
    $events = array();
	
    // Fetch results
    while ($row = $sql->fetch_assoc()) {
        $e = array();
		$e['title'] = strtoupper($row['username']) . " : " . $row['cName'] . " : " . $row['hours'];
        $e['id'] = $row['ID'];
        $e['user'] = $row['user'];
        $e['date'] = $row['date'];
        $e['hours'] = $row['hours'];
		$e['customer'] = $row['cId'];
		$e['color'] = $row['color'];
				        
        // Merge the event array into the return array
        array_push($events, $e);
    }

    // Output json for our calendar
    echo json_encode($events);
    //echo $events;
	
	exit();

} catch (PDOException $e){
    echo $e->getMessage();
}

?>
