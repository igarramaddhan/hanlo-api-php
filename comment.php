<?php   REQUIRE_ONCE('connection.php'); 
		$POST_ID = $_GET ['postId']; 
    $QUERY = MYSQLI_QUERY($conn, "SELECT * FROM Comments WHERE postId=".$POST_ID); 
 
    $comments = array();
    while($ROW = MYSQLI_FETCH_ASSOC($QUERY)){
        $comment = new stdClass; 
        $comment-> id = $ROW['id'];  
        $comment-> content = $ROW['content']; 
				$comment-> userId = $ROW['userId'];  
				$comment-> postId = $ROW['postId'];
        
        $comments[] = $comment;
    }
    
    header('Content-Type:application/json;charset=utf-8'); 
 
    ECHO JSON_ENCODE( $comments); 
 
    MYSQLI_CLOSE($conn); 
?>