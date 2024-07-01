<?php

class Signup {
    private $error = "";

    /* Check is Signup Details are Accurate */
    public function evaluate($data){
        foreach ($data as $key => $value) {
            if(empty($value)){
                $this->error.= $key . " is empty!<br>";
            }
            if($key == "email"){
                if(!preg_match("/([\w\]+\@[\w\-]+\.[\w\-]+)/",$value)){
                    $this->error.= "invalid email address!<br>";
                }}
            if($key == "first_name"){
                if(is_numeric($value) || strstr($value," ")){
                    $this->error.= "invalid first name, cannot be a number or contain spaces!<br>";
                }}
            if($key == "last_name"){
                if(is_numeric($value) || strstr($value," ")){
                    $this->error.= "invalid last name, cannot be a number or contain spaces!<br>";
                }}
        }


        if($this->error == ""){
            //no error - trigger create_user
            $this->create_user($data);
        }else{
            //error - return error dont trigger create_user
            return $this->error;
        }
    }

    /* Create User if Signup Details are Accurate */
    public function create_user($data){
        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        $gender = $data['gender'];
        $email = $data['email'];
        $password = $data['password'];

        /* Create These Values */
        $url_address = strtolower($first_name) . "." . strtolower($last_name);
        $userid = $this->create_userid();



        /* Query is command to insert data */
        $query = "insert into users (userid,first_name,last_name,gender,email,password,url_address) 
                values ('$userid','$first_name','$last_name','$gender','$email','$password','$url_address')";

        $DB = new Database();
        $DB->save($query);
    }

    /* Creates userid */
    private function create_userid(){
        $length = rand(3,19);
        $number = "";
        for($i = 0; $i < $length; $i++){
            $rand = rand(0,9);
            $number = $number . $rand;
        }
        return $number;
    }
}