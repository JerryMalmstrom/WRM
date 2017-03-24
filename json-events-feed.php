<?php

require  'src/Medoo.php';
use Medoo\Medoo;


try {
	// Initialize
	$db = new Medoo([
		'database_type' => 'mssql',
		'database_name' => 'WRM-DB',
		'server' => 'localhost',
		'username' => 'sa',
		'password' => '1853satan',
		'charset' => 'utf8'
	]);
	
	$query = $db->select("Events",[
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
	],"");
  
  
	
   
    // Returning array
    $events = array();
	
    // Fetch results
    foreach ($query As $row) {
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
