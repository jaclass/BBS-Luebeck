<?php
/**
 * @author Ge Song
 * model for user
 */
class user{
    private $id;
    private $username;
    private $password;
    private $img_url;
    
    public function __construct($id,$username,$password,$url){
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->img_url = $url;
    }
    
    // convert the object into JSON
    public function JSONify(){
        return json_encode($this->arrify());
    }
    
    // convert the object into array
    public function arrify(){
        $data =  array('id' => $this->id, 'username' => $this->username, 'img_url' => $this->img_url);
        return $data;
    }
}