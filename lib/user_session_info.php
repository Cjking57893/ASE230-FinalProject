<?php
session_start();

if (isset($_SESSION['email'])) {
    $user_id = $_SESSION['user_id']; 
    $email = $_SESSION['email'];
    $username = $_SESSION['username'];
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $account_type = $_SESSION['account_type'];
} else {
    $user_id = 'Not Logged In';
    $email = 'Guest';
    $username = 'Visitor';
    $first_name = 'Guest';
    $last_name = '';
    $account_type = 'Basic';
}
