1. Hanlo - Social Media App

2. - Arif Eka Brillian (165150200111179)

   - Dika Perdana Sinaga (165150200111175)

   - Igar Ramaddhan 165150201111257

   - Timothy Marshal Sianipar (165150200111041)

   - Wahyu Hendro Hartono (165150200111181)

3) Tabel

CREATE TABLE `Comments` (

`id` int(11) NOT NULL AUTO_INCREMENT,

`content` varchar(255) NOT NULL,

`createdAt` datetime NOT NULL,

`updatedAt` datetime NOT NULL,

`postId` int(11) DEFAULT NULL,

`userId` int(11) DEFAULT NULL,

PRIMARY KEY (`id`),

KEY `postId` (`postId`),

KEY `userId` (`userId`),

CONSTRAINT `Comments_ibfk_1` FOREIGN KEY (`postId`) REFERENCES `Posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,

CONSTRAINT `Comments_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE

) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

CREATE TABLE `Friends` (

`id` int(11) NOT NULL AUTO_INCREMENT,

`createdAt` datetime NOT NULL,

`updatedAt` datetime NOT NULL,

`userId` int(11) DEFAULT NULL,

`friendId` int(11) DEFAULT NULL,

PRIMARY KEY (`id`),

KEY `userId` (`userId`),

KEY `friendId` (`friendId`),

CONSTRAINT `Friends_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,

CONSTRAINT `Friends_ibfk_2` FOREIGN KEY (`friendId`) REFERENCES `Users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Messages` (

`id` int(11) NOT NULL AUTO_INCREMENT,

`content` varchar(255) NOT NULL,

`createdAt` datetime NOT NULL,

`updatedAt` datetime NOT NULL,

`from` int(11) DEFAULT NULL,

`to` int(11) DEFAULT NULL,

PRIMARY KEY (`id`),

KEY `from` (`from`),

KEY `to` (`to`),

CONSTRAINT `Messages_ibfk_1` FOREIGN KEY (`from`) REFERENCES `Users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,

CONSTRAINT `Messages_ibfk_2` FOREIGN KEY (`to`) REFERENCES `Users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Posts` (

`id` int(11) NOT NULL AUTO_INCREMENT,

`content` varchar(255) NOT NULL,

`createdAt` datetime NOT NULL,

`updatedAt` datetime NOT NULL,

`userId` int(11) DEFAULT NULL,

PRIMARY KEY (`id`),

KEY `userId` (`userId`),

CONSTRAINT `Posts_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE

) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

CREATE TABLE `Users` (

`id` int(11) NOT NULL AUTO_INCREMENT,

`username` varchar(255) NOT NULL,

`displayName` varchar(255) NOT NULL,

`password` varchar(255) NOT NULL,

`createdAt` datetime NOT NULL,

`updatedAt` datetime NOT NULL,

PRIMARY KEY (`id`)

) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

4. Web service tabel Posts

connection.php

<?php
define('HOST','127.0.0.1');
define('USER','root');
//sesuaikan nama user
define('PASS','my-secret');
//sesuaiakan nama password
define('DB','post');//sesuaiakan naman database
$conn = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');
date_default_timezone_set("Asia/Jakarta");
?>

post.php

<?php REQUIRE_ONCE('connection.php');
$QUERY = MYSQLI_QUERY($conn, "SELECT * FROM Posts" );
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
