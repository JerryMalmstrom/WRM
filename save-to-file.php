<?php
    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
		//echo $_FILES['file']['tmp_name'] . " - " . $_FILES['file']['name'] ;
        move_uploaded_file($_FILES['file']['tmp_name'], 'images/users/' . $_FILES['file']['name']);
		
		echo 'images/users/' . $_FILES['file']['name'];
    }
?>