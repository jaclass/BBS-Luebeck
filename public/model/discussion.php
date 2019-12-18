<?php
/**
 * @author Ge Song
 * model for discussion
 */


class discussion{
	private $id;
	private $name;
	private $discription;
	private $comment_num;
	private $label;
	private $created_time;
	private $create_user;   /* foreign class */
	
	public function __construct($id,$name,$discription,$comment_num,$label,$created_time,$create_user){
	    $this->id = $id;
	    $this->name = $name;
	    $this->discription = $discription;
	    $this->comment_num = $comment_num;
	    $this->label = $label;
	    $this->created_time = $created_time;
	    $this->create_user = $create_user;
	}
	
	// convert the object into JSON
	public function JSONify(){
	    return json_encode($this->arrify());
	}
	
	// convert the object into array
	public function arrify(){
	    return array('id' => $this->id, 'name' => $this->name, 'discription' => $this->discription,
	        'comment_num' => $this->comment_num, 'label' => $this->label, 'created_time' => $this->created_time,
	        'user' => ($this->create_user)->arrify()
	    );
	}
}

?>