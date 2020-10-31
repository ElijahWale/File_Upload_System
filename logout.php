<?php
session_start();

// destroy login sessions
if(isset($_SESSION['user_id'])){
    session_unset($_SESSION['user_id']);
    session_unset($_SESSION['email']);
    session_unset($_SESSION['firstName']);
    session_destroy();
    
    header("Location: index.php");
}

?>