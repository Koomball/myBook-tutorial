<?php
    session_start();
    // print_r($_SESSION);
    include("classes/connect.php");
    include("classes/login.php");
    include("classes/user.php");
    include("classes/post.php");

    $login = new Login();
    $user_data = $login->check_login($_SESSION['mybook_userid']);
    /* Posting */
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $id = $_SESSION['mybook_userid'];
            $post = new Post();
            $result = $post->create_post($id, $_POST);
            if($result == ""){
                header("Location: profile.php");
                die;
            }else{
                echo '<div style="text-align:center;font-size:12px;color:black;backgrond-color:grey;">';
                echo "The Following Errors Occured:<br>";
                echo $result;
                echo '</div>';
            }
    }
    
    /* Collect Posts */
    $id = $_SESSION['mybook_userid'];
    $post = new Post();
    $posts = $post->get_posts($id);

    /* Collect Friends */
    $id = $_SESSION['mybook_userid'];
    $user = new User();
    $friends = $user->get_friends($id);
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
            margin-top:-200px;
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
            background-color: white;color:#aaa;
            margin-top:20px;
            padding:8px;
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
            <div style="background-color:white;text-align:center;color:#405d9b;">
                    <?php 
                        $image = "";
                        if(file_exists($user_data['cover_image'])){
                            $image = $user_data['cover_image'];
                        }
                    ?>
                <img src="<?php echo $image?>" style="width:100%;">
                <span style="font-size:11px;">
                    <?php 
                        $image = "";
                        if(file_exists($user_data['profile_image'])){
                            $image = $user_data['profile_image'];
                        }
                    ?>
                    <img src="<?php echo $image ?>"  id="profile_pic"><br>

                    <a href="change_profile_image.php?change=profile"> Change Profile Image</a> |
                    <a href="change_profile_image.php?change=cover"> Change Profile Cover</a>
                </span>
                <br>
                <div style="font-size:20px;"><?php echo $user_data['first_name'] . ' ' . $user_data['last_name'];?></div>
                <br>
                <a href="index.php"><div id="menu_buttons">Timeline</div></a>
                <div id="menu_buttons">About</div> 
                <div id="menu_buttons">Friends</div> 
                <div id="menu_buttons">Photos</div>
                <div id="menu_buttons">Settings</div>
            </div>

            <!--below cover area-->
            <div style="display:flex;">
                <!--Friends Area-->
                <div style="min-height:400px;flex:1;">
                    <div id="friends_bar">
                        Friends<br>
                        <?php
                        if($friends){
                            foreach($friends as $FRIEND_ROW){
                                include("user.php");
                            }
                        }
                        ?>
                    </div>
                </div>
                <!--Posts Area-->
                <div style="min-height:400px;flex:2.5;padding:20px;padding-right:0px;">
                    <div style="border:solid thin #aaa;padding: 10px;background-color:white;">
                        <form method="post">
                            <textarea name="post" placeholder="Whats on your mind?"></textarea>
                            <input id="post_button" type="submit"value="Post"><br>
                        </form>
                        
                    </div>
                    <!--Posts-->   
                    <div id="post_bar">
                        <?php
                        if($posts){
                            foreach($posts as $ROW){
                                $user = new User();
                                $ROW_USER = $user->get_user($ROW['userid']);
                                include("post.php");
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>