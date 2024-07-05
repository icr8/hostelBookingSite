<?php
 require 'config/constants.php';
 include'./partials/header.php';

 //destroy all sessions and redirect to login page
 session_destroy();

 header('location: ' . 'adminLogin.php');
 die();
