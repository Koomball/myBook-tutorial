<?php
session_start();

include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
include("classes/post.php");
include("classes/image.php");

$login = new Login();
$user_data = $login->check_login($_SESSION['mybook_userid']);

/* Profile Image Upload */
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_FILES["file"]['name']) && $_FILES["file"]['name'] != ""){

            if($_FILES['file']['type'] == "image/png"){
                $size = (1028 * 1028) * 3;
                if($_FILES['file']['size'] <= $size){
                    $filename = "uploads/" . $_FILES['file']['name'];
                    move_uploaded_file($_FILES["file"]["tmp_name"], $filename);

                    $change = "profile";
                        
                        // check for cover or profile change
                        if(isset($_GET['change'])){$change = $_GET['change'];}

                    $imageMin = new Image();
                    if($change == "cover"){
                        $imageMin->crop_image($filename,$filename,1366,488);
                    }else{
                        $imageMin->crop_image($filename,$filename,800,800);
                    }

                    if(file_exists($filename)){
                        $userid = $user_data["userid"];
                        if($change == "cover"){
                            $query = "UPDATE users SET cover_image = '$filename' WHERE userid = '$userid' LIMIT 1"; 
                        }else{
                            $query = "UPDATE users SET profile_image = '$filename' WHERE userid = '$userid' LIMIT 1"; 
                        }
                        
                        
                        $DB = new Database();
                        $DB->save($query);

                        header("Location: profile.php");
                        die;
                    }
                }else{
                    echo '<div style="text-align:center;font-size:12px;color:black;backgrond-color:grey;">';
                    echo "The Following Errors Occured:<br>";
                    echo "Image must be 3MB or lower.";
                    echo '</div>';
                }
            }else{
                echo '<div style="text-align:center;font-size:12px;color:black;backgrond-color:grey;">';
                echo "The Following Errors Occured:<br>";
                echo "please add a valid image.";
                echo '</div>';
            }
            
        }else{
            echo '<div style="text-align:center;font-size:12px;color:black;backgrond-color:grey;">';
            echo "The Following Errors Occured:<br>";
            echo "please add a valid image.";
            echo '</div>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>MyBook | Edit Profile</title>
    </head>
    <style>
        #blue_bar{
            height:50px;
            background-color:#405d9b;color:#d9dfeb;
        }
        #searchbox{
            width:400px;height:20px;
            border-radius:5px;border:none;
            padding:4px;
            font-size:14px;
            background-image:url('search.png');background-repeat:no-repeat;background-position:right;
        }
        #profile_pic{
            width:150px;
            border-radius:50%;border:solid 2px white;
        }
        #menu_buttons{
            display:inline-block;
            width:100px;
            margin:2px;
        }
        #post_button{
            float:right;
            width:60px;
            background-color:#405d9b;color:white;
            border:none;border-radius:2px;
            padding:4px;
            font-size:14px;
        }
        #post_bar{
            margin-top:20px;
            background-color:white;
            padding:10px;
        }
        #post{
            padding: 4px;
            font-size:13px;
            display:flex;
            margin-bottom:20px;
        }
    </style>
    <body style="font-family: tahoma;background-color:#d0d8e4;">
        <!--top bar-->
        <?php include('header.php'); ?>
        <!--cover area-->
        <div style="width:800px;min-height:400px;margin:auto;">

            <!--below cover area-->
            <div style="display:flex;">

                <!--Change Profile Image-->
                <div style="min-height:400px;flex:2.5;padding:20px;padding-right:0px;">
                    <form method="post" enctype="multipart/form-data">
                        <div style="border:solid thin #aaa;padding: 10px;background-color:white;">
                        <input type="file" name="file">
                        <input id="post_button" type="submit"value="Change"><br>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </body>
</html>