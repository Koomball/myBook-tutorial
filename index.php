<?php
session_start();
// print_r($_SESSION);
include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
include("classes/post.php");

$login = new Login();
$user_data = $login->check_login($_SESSION['mybook_userid']);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>MyBook | Profile</title>
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
        #friends{
            clear:both;
            font-size:12px;font-weight:bold;color:#405d9b;
        }
        #friends_bar{
            min-height:400px;
            color:#405d9b;
            margin-top:20px;
            padding:8px;
            text-align:center;
            font-size:20px;
        }
        #friends_img{
            width:75px;
            float:left;
            margin:8px;
        }
        textarea{
            width:100%;height:60px;
            border:none;
            font-family:tahoma;
            font-size:14px;
        }
        #post_button{
            float:right;
            width:50px;
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
                <!--Friends Area-->
                <div style="min-height:400px;flex:1;">
                    <div id="friends_bar">
                        <img id="profile_pic" src="selfie.jpg"><br>
                        <a href="profile.php" style="color:#405d9b;"><?php echo $user_data['first_name'] . ' ' . $user_data['last_name'];?></a>
                    </div>
                </div>
                <!--Posts Area-->
                <div style="min-height:400px;flex:2.5;padding:20px;padding-right:0px;">
                    <div style="border:solid thin #aaa;padding: 10px;background-color:white;">
                        <textarea placeholder="Whats on your mind?"></textarea>
                        <input id="post_button" type="submit"value="Post"><br>
                    </div>
                    <!--Posts-->   
                    <div id="post_bar">

                        <!--Post 1-->
                        <div id="post">
                            <div>
                                <img src="user1.jpg" style="width:75px;margin-right:6px;">
                            </div>
                            <div>
                                <div style="font-weight:bold;color:#405d9b;">First User</div>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                <br><br>
                                <a href="#">Like</a> . <a href="#">Comment</a> . <span style="color:#999;">20 June 2024</span>
                            </div>
                        </div>
                        <!--Post 2-->
                        <div id="post">
                            <div>
                                <img src="user2.jpg" style="width:75px;margin-right:6px;">
                            </div>
                            <div>
                                <div style="font-weight:bold;color:#405d9b;">Second User</div>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                <br><br>
                                <a href="#">Like</a> . <a href="#">Comment</a> . <span style="color:#999;">20 June 2024</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>