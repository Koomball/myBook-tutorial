<?php

class Login {
    private $error = "";
    public function evaluate($data){
        $email = addslashes($data['email']);
        $password = addslashes($data['password']);

        /* select * - select command */
        /* from - declare your supplying where to select from */
        /* users - the db table your selecting from */
        /* where - specify a rule to what to select from your table*/
        /* email = '$email' - rule is row email has to match variable $email */
        /* limit 1 - limits to one result */
        $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";

        $DB = new Database();
        $result = $DB->read($query);
        if($result){
            $row = $result[0];
            if($password == $row["password"]){
                //add to session
                $_SESSION['mybook_userid'] = $row['userid'];
            }else{
                $this->error .= "No such password was found<br>";
            }
        }else{
            $this->error .= "No such email was found<br>";
        }
            return $this->error;
    }

    public function check_login($id){
        if(is_numeric($id)){
            /* Check if user is logged in */   
            $query = "SELECT * FROM users where userid = '$id' LIMIT 1";

            $DB = new Database();
            $result = $DB->read($query);
            if($result){
                $user_data = $result[0];
                return $user_data;
            }else{
                header("Location: login.php");
                die;
            }
                }else{
                    header("Location: login.php");
                    die;
                }
    }
}