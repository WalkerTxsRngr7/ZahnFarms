<?php
    $dsn = "mysql:host=localhost;dbname=zahnfarms";
    
    try {
        $db = new PDO($dsn, "root", "");
    } catch(Exception $e){
        echo ($e->getmessage());
        die();
    }
?>