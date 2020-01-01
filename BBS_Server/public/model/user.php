<?php
/**
 * @author Ge Song
 * model for user
 */
class user{
    private $id;
    private $username;
    private $password;
    
    public function __construct($id,$username,$password){
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
    }
    
    // convert the object into JSON
    public function JSONify(){
        return json_encode($this->arrify());
    }
    
    // convert the object into array
    public function arrify(){
        $data =  array('id' => $this->id, 'username' => $this->username);
        return $data;
    }
}