<?php session_start(); ?>
<?php require('core/db.php');
      require_once('core/functions.php');

      $errors= "";
if(isset($_POST['login'])){

    // validation for email
    if(empty($_POST['email'])){
        $errors.= "your email is empty";
    }else{
        $email = sanitize($_POST['email']);
    }

    // validation for password
    if(empty($_POST['password'])){
        $errors.= "<br>your password is empty";
    }else{
        $password = sanitize($_POST['password']);
    }
    
    if($errors){
        //print error message
        $resultMessage = '<div class="alert alert-danger">' . $errors .'</div>' . "<br>";
        echo $resultMessage;  
    }else{
        $email = mysqli_real_escape_string($db_connect, $email);
        $password = md5(mysqli_real_escape_string($db_connect, $password));

                //Run query: Check combinaton of email & password exists
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($db_connect, $sql);
        if(!$result){
            $_SESSION['error'] = '<div class="alert alert-danger">Error running the query!</div>';
           
        }

        //If email & password don't match print error
        $count = mysqli_num_rows($result);
        if($count !== 1){
            $_SESSION['error'] = '<div class="alert alert-danger">Wrong Username or Password</div>';
        }
        else {
            //log the user in: Set session variables
            $row = mysqli_fetch_assoc($result);
            $_SESSION['user_id']=$row['id'];
            $_SESSION['email']=$row['email'];
            $_SESSION['firstName'] = $row['firstName'];

            
            header('location: index.php');

            
        }

    }

}