<?php
/**
 * @author Ge Song
 * database util class
 */
require __DIR__ . '/../model/user.php';
require __DIR__ . '/dbConnection.php';
class dbUtil{
    /*user login*/
    public static function login($username, $password){
        $connection = dbConnection::connect();
        $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $result = mysqli_query($connection, $sql);
        if(mysqli_num_rows($result) == 0){
            return array("error"=>"wrong username or password!");
        }else{
            $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
            $result = (new user($row['user_id'],$row['username'],$row['password'],$row['photo']))->arrify();
            mysqli_close($connection);
            return $result;    
        }
        mysqli_close($connection);
    }
    
    /*search user by id*/
    public static function searchUserbyId($user_id){
        $connection = dbConnection::connect();
        $sql = "SELECT * FROM user WHERE user_id='$user_id'";
        $result = mysqli_query($connection, $sql);
        if(mysqli_num_rows($result) == 0){
            mysqli_close($connection);
            return array("error"=>"search user_id error");
        }else{
            $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
            $result = (new user($row['user_id'],$row['username'],$row['password'],$row['photo']))->arrify();
            mysqli_close($connection);
            return $result;
        }
    }
    
    /*user creating*/
    public static function user_create($username, $password, $img_util){
        $connection = dbConnection::connect();
        $sql = "SELECT * FROM user WHERE username='$username'";
        $result = mysqli_query($connection, $sql);
        if(mysqli_num_rows($result) > 0){   // the user name already exists
            mysqli_close($connection);
            return array("error"=>"username already exists!");
        }else{
            $insert_sql = "INSERT INTO user (username, password, photo) VALUES ('$username', '$password', '$img_util')";
            mysqli_query($connection, $insert_sql);
            $result = (new user($connection->insert_id,$username,$password,$img_util))->arrify();
            mysqli_close($connection);
            return $result;
        }
        
    }
    
    /*discussion searching*/
    public static function discussion_search($query_array){
        $num_per_page=10;
        $result_array = array();
        $connection = dbConnection::connect();
        $sql = "SELECT * FROM discussion";
        $need_where = true;
        if(array_key_exists("discussion_name", $query_array)){  //if query contains discussion_name
            $name = $query_array["discussion_name"];
            if($need_where){
                $sql.=" WHERE";
                $need_where=false;
            }
            $sql.=" discussion_name like '%$name%'";
        }
        if(array_key_exists("label", $query_array)){    //if query contains label
            $label = $query_array["label"];
            if($need_where){
                $sql.=" WHERE";
                $need_where=false;
            }else{
                $sql.=" AND";
            }
            $sql.=" label = '$label'";
        }
        if(array_key_exists("user_id", $query_array)){    //if query contains label
            $label = $query_array["user_id"];
            if($need_where){
                $sql.=" WHERE";
                $need_where=false;
            }else{
                $sql.=" AND";
            }
            $sql.=" user_id = '$label'";
        }
        if(array_key_exists("discussion_id", $query_array)){    //if query contains label
            $id = $query_array["discussion_id"];
            if($need_where){
                $sql.=" WHERE";
                $need_where=false;
            }else{
                $sql.=" AND";
            }
            $sql.=" discussion_id = '$id'";
        }
        if(array_key_exists("order", $query_array)){    // oder option
            $order = $query_array["order"];
            $sql.=" ORDER BY $order DESC";
        }
        if(array_key_exists("page_num", $query_array)){
            $begin = ($query_array["page_num"]-1)*$num_per_page;
            $sql.=" LIMIT $begin , $num_per_page";
        }
        
        $result = mysqli_query($connection, $sql);
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $row_array=array
            (   
                "discussion_id"=>$row["discussion_id"],
                "discussion_name"=>$row["discussion_name"],
                "discription"=>$row["discription"],
                "comment_number"=>$row["comment_number"],
                "label"=>$row["label"],
                "created_time"=>$row["created_time"],
                "user_id"=>$row["user_id"],
            );
            $row_array["user"]=dbUtil::searchUserbyId($row["user_id"]);
            array_push($result_array, $row_array);
        }
        mysqli_close($connection);
        return $result_array;
    }
    
    /*discussion creating*/
    public static function discussion_create($user_id, $discussion_name, $discription, $label){
        $connection = dbConnection::connect();
        $sql = "INSERT INTO discussion (discussion_name, discription, comment_number, label, created_time, user_id) 
                VALUES ('$discussion_name', '$discription', '0', '$label' ,'". date("Y-m-d h:i"). "', '$user_id' )";
        mysqli_query($connection, $sql);
        $result = array("discussion_id"=>$connection->insert_id);
        mysqli_close($connection);
        return $result;
    }
    
    /*discussion updating*/
    public static function discussion_update($user_id, $discussion_id, $discussion_name, $discription, $label){
        $connection = dbConnection::connect();
        $auth_sql = "SELECT * FROM discussion WHERE discussion_id='$discussion_id' AND user_id='$user_id'";
        $check = mysqli_query($connection, $auth_sql);
        if(mysqli_num_rows($check) == 0){
            $error = array("error"=>"authority error");
            mysqli_close($connection);
            return $error;
        }
        $sql = "UPDATE discussion SET discussion_name='$discussion_name', discription='$discription', label='$label'
                WHERE discussion_id='$discussion_id'";
        mysqli_query($connection, $sql);
        $result = array("state"=>"success");
        mysqli_close($connection);
        return $result;
    }
    
    /*discussion deleting*/
    public static function discussion_delete($user_id, $discussion_id){
        $connection = dbConnection::connect();
        $sql = "DELETE FROM discussion WHERE user_id = '$user_id' and discussion_id = '$discussion_id'";
        mysqli_query($connection, $sql);
        $result = array("state"=>"delete success");
        mysqli_close($connection);
        return $result;
    }
}