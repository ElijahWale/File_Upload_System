<?php require('core/db.php'); ?>
 <?php require('core/functions.php'); ?> 

<?php

// select all files from database

$sql = "SELECT * FROM files";
$query_files = mysqli_query($db_connect, $sql);
if(!$query_files){
    die('query failed: ' . mysqli_error($db_connect));
}

$files = mysqli_fetch_all($query_files, MYSQLI_ASSOC);







// collecting data from form
if(isset($_POST['upload'])){



     $file_access = sanitize($_POST['file_access']);


    // Input file in different media type
   

    $file_name = $_FILES['file_upload']['name'];
    $file_size = $_FILES['file_upload']['size'];
    $file_temp = $_FILES['file_upload']['tmp_name'];
    $file_type = $_FILES['file_upload']['type'];

    // files that permitted to be uploaded to the server
    $permited = array('jpg', 'jpeg', 'png', 'gif', 'doc', 'pdf', 'ppt', 'mp3');

//   getting file extension from files uploaded

    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);



    // create this folder "listing-files in your directory, this is where the uploaded files will be stored.
    $uploaded_file = "uploads/".$file_name;

    // if file size is more than 2MB
    if ($file_size > 5048567) {
        $_SESSION['error'] = "<div class='alert alert-danger'>File Size should not be more than 5MB</div>";
    
    } 
    // if the file uploaded is not of the allowed format above
    elseif (in_array($file_ext, $permited) === false) {
        $_SESSION['error'] = "<div class='alert alert-danger'>You can upload only:-".implode(', ',$permited)."</div>";
    
    }else{
        // this is responsible for moving the file into the uploads folder
        move_uploaded_file($file_temp, $uploaded_file);

         // query the db
         $sql = "INSERT INTO files (name, type, size, downloads, file_access) VALUES ('$file_name', '$file_type', $file_size, 0, '$file_access')";
         $query = mysqli_query($db_connect, $sql);
 
         if ($query) {
             $msg = "<div class='alert alert-success'>New file uploaded Successfully</div>";
             $_SESSION['success'] = $msg;
         } else {
             $msg = "<div class='alert alert-danger'>file Not uploaded</div>";
             $_SESSION['error'] = $msg;
         }
    }


}


// Downloads files
if (isset($_GET['downloads'])) {
    $id = $_GET['downloads'];

    
        // fetch file to download from database
        $sql = "SELECT * FROM files WHERE id=$id";
        $result = mysqli_query($db_connect, $sql);

        $file = mysqli_fetch_assoc($result);
        $filepath = 'uploads/' . $file['name'];

        if (file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filepath));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize('uploads/' . $file['name']));
            readfile('uploads/' . $file['name']);

            // Now update downloads count
            $newCount = $file['downloads'] + 1;
            $updateQuery = "UPDATE files SET downloads=$newCount WHERE id=$id";
            mysqli_query($db_connect, $updateQuery);
            exit;

        }
     
    
}

// Delete files

if(isset($_GET['delete'])){
    $the_file_id = $_GET['delete'];

    $sql = "DELETE FROM files WHERE id = {$the_file_id}";

    $delete_query = mysqli_query($db_connect,$sql);
    if($delete_query){
        header("location:index.php");

    }else{
        die("QUERY FAILED: " . mysqli_error($db_connect));
    }
}

