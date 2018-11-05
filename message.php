<?php   REQUIRE_ONCE('connection.php'); 
		$USER_ID = $_GET ['userId']; 
    $QUERY = MYSQLI_QUERY($conn, "SELECT * FROM Messages WHERE `from`=".$USER_ID." OR `to`=".$USER_ID); 
 
    $messages = array();
    while($ROW = MYSQLI_FETCH_ASSOC($QUERY)){
        $message = new stdClass; 
        $message-> id = $ROW['id'];  
        $message-> content = $ROW['content']; 
				$message-> from = $ROW['from'];  
				$message-> to = $ROW['to'];
        
        $messages[] = $message;
    }
    
    header('Content-Type:application/json;charset=utf-8'); 
 
    ECHO JSON_ENCODE( $messages); 
 
    MYSQLI_CLOSE($conn); 
?>