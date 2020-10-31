<?php

    // sanitize or clean forms

    function sanitize($data) {
        $text = trim($data);
        $text = stripslashes($text);
        $text = htmlspecialchars($text);
    
        return $text;
    }

    // display error message
    function print_error(){
        
        if(isset($_SESSION['error']) &&  !empty($_SESSION['error'])){
            echo $_SESSION["error"];
            unset($_SESSION["error"]);
        }
    }
    
    //display success message
    function print_success(){

        if(isset($_SESSION['success']) &&  !empty($_SESSION['success'])){
            echo $_SESSION["success"];
            unset($_SESSION["success"]);
        }
    }


?>
