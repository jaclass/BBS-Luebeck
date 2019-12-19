<?php
/**
 * @author Ge Song
 * model for comment
 */
class comment{
    private $id;
    private $content;
    private $img_url;
    private $liked_num;         /* logic control could be implemented by local storage */
    private $created_time;
    private $discussion_id;     /* foreign key */
    private $prev_comment;   /* foreign class */
    private $create_user;    /* foreign class */
    
    public function __construct($id,$content,$img_url,$created_time,$discussion_id,$prev_comment,$create_user){
        $this->id = $id;
        $this->content = $content;
        $this->img_url = $img_url;
        $this->created_time = $created_time;
        $this->discussion_id = $discussion_id;
        $this->prev_comment = $prev_comment;
        $this->create_user = $create_user;
    }
    
    // convert the object into JSON
    public function JSONify(){  
        return json_encode($this->arrify());
    }
    
    // convert the object into array
    public function arrify(){
        $data = array('id' => $this->id, 'content' => $this->content, 'img_url' => $this->img_url,
            'created_time' => $this->created_time, 'discussion_id' => $this->discussion_id,
            'create_user' => $this->create_user
        );
        if($this->prev_comment == null){   /*prev_comment can be null*/
            $data['prev_comment'] = null;
        }else{
            $data['prev_comment'] = ($this->prev_comment)->arrify();
        }
        return $data;
    }
}

?>