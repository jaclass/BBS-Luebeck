<?php
/**
 * @author Ge Song
 * database connection
 */
class dbConnection{
    public static function connect(){
        /*fit it to your db configuration*/
        $connection = new mysqli("localhost:3306", "319973","123123","bbs");
        if($connection->connect_error){
            die("Unable to connect database: " . $connection->connect_error);
        }
        return $connection;
    }
}

