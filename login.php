<?php
session_start();
unset($_SESSION['email']);
include("classes/connect.php");
include("classes/login.php");

$email = "";
$password = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $login = new Login();
    $result = $login->evaluate($_POST);
    if($result != ""){
    echo '<div style="text-align:center;font-size:12px;color:black;backgrond-color:grey;">';
    echo "The Following Errors Occured:<br>";
    echo $result;
    echo '</div>';
    }else{
        header('Location: profile.php');
        die;
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
}
?>

<html>
    <head>
        <title>Mybook | Login</title>
    </head>
    <style>
        #bar{height:100px;background-color:rgb(59,89,152);color:#d9dfeb;padding:4px;}
        #bar2{
            background-color:white;
            width:800px;height:200px;
            margin:auto;margin-top:50px;
            padding:10px;padding-top:50px;
            text-align:center;
            font-weight: bold;
        }
        #signup_button{
            background-color:#42b72a;
            width:70px;
            padding: 4px;border-radius:4px;
            float:right;text-align:center;
        }
        #text{
            height:40px;width:300px;
            border-radius:4px;border:solid 1px #aaa;
            padding:4px;
            font-size:14px;
        }
        #button {
            width:300px;height:40px;
            border-radius:4px;border:none;
            background-color:rgb(59,89,152);color:white;
            font-weight: bold;
        }
    </style>
    <body style="font-family: tahoma;background-color:#e9ebee;">
        <div id="bar">
            <div style="font-size:40px;">Mybook</div>
            <div id="signup_button">Signup</div>
        </div>

        <div id="bar2">
            Login to Mybook<br><br>
            <form method="post" action="">
                <input name="email" value="<?php echo $email;?>" type="text" id="text" placeholder="Email"><br><br>
                <input name="password" type="password" id="text" placeholder="Password"><br><br>
                <input type="submit" id="button" value="Login">
            </form>
        </div>
    </body>
</html>