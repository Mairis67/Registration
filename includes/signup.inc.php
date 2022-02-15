<?php

if(isset($_POST['submit'])) {
    // Grabbing the data
    $uid = $_POST['uid'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['passwordRepeat'];
    $email = $_POST['email'];

    // Instantiate SignupController class
    include '../classes/Dbh.php';
    include '../classes/Signup.php';
    include '../classes/SignupController.php';

    $signup = new SignupController($uid, $password, $passwordRepeat, $email);

    // Running error handlers and user signup

    $signup->signupUser();

    // Going back to front page
    header('location: ../index.php?error=none');
}