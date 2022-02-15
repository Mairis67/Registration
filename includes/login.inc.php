<?php

if(isset($_POST['submit'])) {
    // Grabbing the data
    $uid = $_POST['uid'];
    $password = $_POST['password'];

    // Instantiate SignupController class
    include '../classes/Dbh.php';
    include '../classes/Login.php';
    include '../classes/LoginController.php';

    $login = new LoginController($uid, $password);

    // Running error handlers and user signup

    $login->loginUser();

    // Going back to front page
    header('location: ../index.php?error=none');
}