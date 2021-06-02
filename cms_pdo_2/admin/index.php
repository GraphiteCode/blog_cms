<?php
session_start();
include_once '../start.php';
include_once 'includes/admin.class.php';
$admin = new Admin;
$articles = new Admin;
$drafts = new Admin;
$deleteArticle = new Admin;
$deleteDraft = new Admin;
include_once 'includes/header.php';

if (!isset($_SESSION['log in'])) { // Check for Session
    if (!isset($_POST['submit'])) { // Check for Submit 
        include_once 'includes/login.form.php'; // Log in form
    } else {
        $user = $_POST['user']; // Assign Variables
        $pass = $_POST['pass'];
        if (empty($user) || (empty($pass))) { // Check for Inputs
            $alert = 'Fill in all fields'; // Alert for blank fields
            include_once 'includes/login.form.php'; //Log in Form
        } else {
            $admin->login($user, $pass); // SQL Query
            if ($admin->login($user, $pass) == 1) { // Check for User & Password
                $_SESSION['log in'] = true; // Start Session 
                header('Location: index.php'); // Redirect to Self
                exit(); // End Code
            } else {
                $alert = 'User not found.'; // Alert for Invalid Input Credentials
                include_once 'includes/login.form.php'; // Log in Form
            }
        }
    }
} else {
    include_once 'includes/home.php'; // Logged In Main Menu
}
include_once '../includes/footer.php';
