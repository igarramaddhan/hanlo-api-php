<?php   REQUIRE_ONCE('connection.php'); 
		$USER_ID = $_GET ['userId']; 
    $QUERY = MYSQLI_QUERY($conn, "SELECT f.id, f.userId, f.friendId, u.username, u.displayName FROM Friends f JOIN Users u ON f.friendId = u.id WHERE f.userId=".$USER_ID); 
 
    $friends = array();
    while($ROW = MYSQLI_FETCH_ASSOC($QUERY)){
        $friend = new stdClass; 
        $friend-> id = $ROW['id'];  
        $friend-> userId = $ROW['userId']; 
				$friend-> friendId = $ROW['friendId'];
				$friend-> username = $ROW['username'];
				$friend-> displayName = $ROW['displayName'];
        
        $friends[] = $friend;
    }
    
    header('Content-Type:application/json;charset=utf-8'); 
 
    ECHO JSON_ENCODE( $friends); 
 
    MYSQLI_CLOSE($conn); 
?>