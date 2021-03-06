<?php
/**
 * @author Ge Song
 * database util class
 */
require __DIR__ . '/../model/user.php';
require __DIR__ . '/../model/comment.php';
require __DIR__ . '/../model/discussion.php';
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
            $result = (new user($row['user_id'],$row['username'],$row['password']))->arrify();
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
            $result = (new user($row['user_id'],$row['username'],$row['password']))->arrify();
            mysqli_close($connection);
            return $result;
        }
    }
    
    /*user creating*/
    public static function user_create($username, $password){
        $connection = dbConnection::connect();
        $sql = "SELECT * FROM user WHERE username='$username'";
        $result = mysqli_query($connection, $sql);
        if(mysqli_num_rows($result) > 0){   // the user name already exists
            mysqli_close($connection);
            return array("error"=>"username already exists!");
        }else{
            $insert_sql = "INSERT INTO user (username, password) VALUES ('$username', '$password')";
            mysqli_query($connection, $insert_sql);
            $result = (new user($connection->insert_id,$username,$password))->arrify();
            mysqli_close($connection);
            return $result;
        }
        
    }
    
    /*discussion searching*/
    public static function discussion_search($query_array){
        $num_per_page=10;
        $result_array = array();
        $cur_page=-1;
        $connection = dbConnection::connect();
        $sql = "SELECT * FROM discussion";
        $need_where = true;
        if(array_key_exists("discussion_name", $query_array)){  //if query contains discussion_name
            $name = $query_array["discussion_name"];
            $name=mysqli_real_escape_string($connection,$name);
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
        if(array_key_exists("user_id", $query_array)){    //if query contains user_id
            $id = $query_array["user_id"];
            if($need_where){
                $sql.=" WHERE";
                $need_where=false;
            }else{
                $sql.=" AND";
            }
            $sql.=" user_id = '$id'";
        }
        if(array_key_exists("discussion_id", $query_array)){    //if query contains discussion_id
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
            $cur_page = $query_array["page_num"];
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
        $return_array = array("cur_page"=>$cur_page, "discussions"=>$result_array);
        mysqli_close($connection);
        return $return_array;
    }
    
    /*discussion creating*/
    public static function discussion_create($user_id, $discussion_name, $discription, $label){
        $connection = dbConnection::connect();
        $discussion_name=mysqli_real_escape_string($connection,$discussion_name);
        $discription=mysqli_real_escape_string($connection,$discription);
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
        $discussion_name=mysqli_real_escape_string($connection,$discussion_name);
        $discription=mysqli_real_escape_string($connection,$discription);
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
    
    /*search comment by id*/
    public static function searchCommentbyId($comment_id){
        $connection = dbConnection::connect();
        $sql = "SELECT * FROM comment WHERE comment_id='$comment_id'";
        $result = mysqli_query($connection, $sql);
        if(mysqli_num_rows($result) == 0){
            mysqli_close($connection);
            return array("error"=>"search comment_id error");
        }else{
            $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
            $user = dbUtil::searchUserbyId($row['user_id']);
            $result = (new comment($row['comment_id'],$row['content'],$row['img_url'],$row['created_time'],$row['discussion_id'],NULL,$user,$row['like_number']))->arrify();
            mysqli_close($connection);
            return $result;
        }
    }
    
    /*comment searching*/
    public static function comment_search($discussion_id, $user_id){
        $connection = dbConnection::connect();
        $result_array = array();
        $sql = "SELECT * FROM comment WHERE discussion_id='$discussion_id'";
        $result = mysqli_query($connection, $sql);
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $user = dbUtil::searchUserbyId($row['user_id']);
            $row_array = (new comment($row['comment_id'],$row['content'],$row['img_url'],$row['created_time'],$row['discussion_id'],NULL,$user,$row['like_number']))->arrify();
            if($row['pre_comment_id'] != NULL && $row['pre_comment_id'] !=-1){
                $row_array['prev_comment'] = dbUtil::searchCommentbyId($row['pre_comment_id']);
            }
            $row_array['isliked_by_user'] = !dbUtil::evaluation_check($row['comment_id'], $user_id);
            array_push($result_array, $row_array);
        }
        mysqli_close($connection);
        return $result_array;
    }
    
    /*comment creating*/
    public static function comment_create($content, $img_url, $discussion_id, $pre_comment_id, $user_id){
        $connection = dbConnection::connect();
        $content=mysqli_real_escape_string($connection,$content);
        $sql = "INSERT INTO comment (content, img_url, created_time, discussion_id, pre_comment_id, user_id, like_number)
                VALUES ('$content', '$img_url', '". date("Y-m-d h:i"). "', '$discussion_id', '$pre_comment_id', '$user_id', 0 )";
        mysqli_query($connection, $sql);
        $result = array("comment_id"=>$connection->insert_id);
        
        //add the comment number of the discussion
        $inc_sql = "UPDATE discussion SET comment_number = comment_number + 1 WHERE discussion_id='$discussion_id'";
        mysqli_query($connection, $inc_sql);
        
        mysqli_close($connection);
        return $result;
    }
    
    /*evaluation check*/
    public static function evaluation_check($comment_id, $user_id){
        $connection = dbConnection::connect();
        $sql = "SELECT * FROM evaluation WHERE comment_id='$comment_id' AND user_id='$user_id'";
        $result = mysqli_query($connection, $sql);
        mysqli_close($connection);
        if(mysqli_num_rows($result) == 0){
            return true;
        }else{
            return false;
        }
    }
    
    /*evaluation updating*/
    public static function evaluation_update($comment_id, $user_id, $like){
        if($like==1 && !dbUtil::evaluation_check($comment_id, $user_id)){    // already like this comment
            return array("error"=>"already like this comment!");
        }
        if($like==-1 && dbUtil::evaluation_check($comment_id, $user_id)){    // have not evaluated
            return array("error"=>"not yet like this comment!");
        }
        $connection = dbConnection::connect();
        if($like==1){   // like this comment
            $inc_sql = "UPDATE comment SET like_number = like_number + 1 WHERE comment_id='$comment_id'";
            mysqli_query($connection, $inc_sql);
            $insert_sql = "INSERT INTO evaluation (comment_id, user_id) VALUES ('$comment_id', '$user_id')";
            mysqli_query($connection, $insert_sql);
            mysqli_close($connection);
        }else{
            $inc_sql = "UPDATE comment SET like_number = like_number - 1 WHERE comment_id='$comment_id'";
            mysqli_query($connection, $inc_sql);
            $delete_sql = "DELETE FROM evaluation WHERE user_id = '$user_id' and comment_id = '$comment_id'";
            mysqli_query($connection, $delete_sql);
            mysqli_close($connection);
        }
        return array("state"=>"like/unlike success");
    }
}