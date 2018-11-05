<?php   REQUIRE_ONCE('connection.php'); 
 
    $QUERY = MYSQLI_QUERY($conn,    "SELECT * FROM Users"   ); 
 
    $users = array();
    while($ROW = MYSQLI_FETCH_ASSOC($QUERY)){
        $user = new stdClass; 
        $user-> id = $ROW['id'];  
        $user-> username = $ROW['username']; 
        $user-> displayName = $ROW['displayName'];  
        
        $users[] = $user;
    }
    
    header('Content-Type:application/json;charset=utf-8'); 
 
    ECHO JSON_ENCODE( $users); 
 
    MYSQLI_CLOSE($conn); 
?>