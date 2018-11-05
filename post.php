<?php   REQUIRE_ONCE('connection.php'); 
 
    $QUERY = MYSQLI_QUERY($conn,    "SELECT * FROM Posts"   ); 
 
		$posts = array();
    while($ROW = MYSQLI_FETCH_ASSOC($QUERY)){
        $post = new stdClass; 
        $post-> id = $ROW['id'];  
        $post-> content = $ROW['content']; 
				$post-> userId = $ROW['userId'];

				$QUERY2 = MYSQLI_QUERY($conn, "SELECT * FROM Comments WHERE postId=".$ROW['id']); 

				$comments = array();
				while($ROW2 = MYSQLI_FETCH_ASSOC($QUERY2)){
					$comment = new stdClass; 
					$comment-> id = $ROW2['id'];
					$comment-> content = $ROW2['content'];
					$comment-> postId = $ROW2['postId'];
					$comment-> userId = $ROW2['userId'];
					$comments[] = $comment;
				}

				$post-> comments = $comments;

        
        $posts[] = $post;
    }
    
    header('Content-Type:application/json;charset=utf-8'); 
 
    ECHO JSON_ENCODE( $posts); 
 
    MYSQLI_CLOSE($conn); 
?>