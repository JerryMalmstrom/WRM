<?php

try {
	
	
	$query = "SELECT e.ID,e.user,e.date,e.hours,e.customer,c.ID,c.name as cName,u.color FROM `Events` e
JOIN customers c
JOIN users u
where e.customer = c.ID and e.user = u.ID";

	$sql = $db->query($query);
	
	/*$query = $db->select("Events",[
	"[>]Customers" => ["Events.customer" => "ID"],
	"[>]Users" => ["Events.user" => "ID"],
	],[
	"Events.ID",
    "Events.user",
    "Events.date",
    "Events.hours",
    "Events.Customer",
	"Customers.ID",
	"Customers.name(cName)",
	"Users.color"
	],"");*/
  
  
	
   
    // Returning array
    $events = array();
	
    // Fetch results
    while ($row = $sql->fetch_assoc()) {
        $e = array();
		$e['title'] = $row['cName'] . ": " . $row['hours'];
        $e['id'] = $row['ID'];
        $e['user'] = $row['user'];
        $e['date'] = $row['date'];
        $e['hours'] = $row['hours'];
		$e['customer'] = $row['cName'];
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
