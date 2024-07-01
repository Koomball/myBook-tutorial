<div id="friends">
<?php 
            $image = "";
            if($FRIEND_ROW["gender"] == 'Male'){
                $image = "images/user_male.jpg";
            }else{
                $image = "images/user_female.jpg";
            }

        ?>
    <img id="friends_img" src="<?php echo $image;?>"><br>
    <?php echo $FRIEND_ROW['first_name'] . ' ' . $FRIEND_ROW['last_name'];?>
</div>