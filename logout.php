<?php
session_start();

    unset($_SESSION['mybook_userid']);

header('Location: login.php');
die;