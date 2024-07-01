<?php

class Post {
    private $error = "";

    /* Get Posts */
    public function get_posts($id){
        $query = "SELECT * FROM posts WHERE userid = '$id' ORDER BY id DESC LIMIT 10";

        $DB = new Database();
        $result = $DB->read($query);
            if($result){
                return $result;
            }else{
                return false;
            }
    }

    /* Create The Post */
    public function create_post($userid, $data){
        if(!empty($data['post'])) {
            /* if not empty post */
            $post = addslashes($data['post']);
            $postid = $this->create_postid();

            $query = "INSERT INTO posts (postid,userid,post) VALUES ('$postid','$userid','$post')";
            $DB = new Database();
            $DB->save($query);
        }else{
            $this->error .= 'Please type something to post.';
        }

        return $this->error;
    }

    private function create_postid(){
        $length = rand(3,19);
        $number = "";
        for($i = 0; $i < $length; $i++){
            $rand = rand(0,9);
            $number = $number . $rand;
        }
        return $number;
    }

}