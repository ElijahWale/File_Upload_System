<?php
session_start();
include_once('file_upload.php'); ?>


<?php include "lib/header.php"; ?>

    <div class="container">
        <div class="row">
              <!-- success and error message -->
                <?php
                    print_success();
                    print_error();

                ?>
        
            <h1 class="text-center mt-4">LIST OF PUBLIC FILES</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">File Name</th>
                    <th scope="col">File Type</th>
                    <th scope="col">File Size</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($files as $file){
                        ?>
                    <tr>
                        <?php if($file['file_access'] == 'public'){ ?>
                            <td><?= $file['name']; ?></td>
                            <td><?= $file['type']; ?></td>
                            <td><?= floor($file['size']/1000) . " KB"; ?></td>
                           
                     <?php   } ?>
                        
                    </tr>

                    <?php } ?>
                </tbody>
        </table>
        </div>
      


        <div class="row">
            <form action="index.php" method="POST" enctype="multipart/form-data">
                <h3>Upload File </h3>
                <small>You only upload png, jpg,pdf and doc file</small>
                <input type="file" name="file_upload">
                <h4>File Access</h4>
                <select name="file_access" id="">
                    <option value="public">Public</option>
                    <option value="private">Private</option>
                </select>
                <button type="submit" name="upload" class=" mt-4 btn-block btn btn-primary">Upload</button>
            </form>
        </div>
        <div class="row">
            <div class="table">
                <table>
                    <thead>
                        <th>Id</th>
                        <th>Filename</th>
                        <th>File type</th>
                        <th>File Size</th>
                        <th>Download</th>
                        <th>File Access</th>
                        <th>File Action</th>
                    </thead>
                    <tbody>
                        <?php
                            $i = 0;
                        foreach($files as $file){
                            $i++;
                            $file_id = $file['id'];
                            ?>
                        <tr>
                            <td><?= $i;  ?></td>
                            <td><?= $file['name']; ?></td>
                            <td><?= $file['type']; ?></td>
                            <td><?= floor($file['size']/1000) . " KB"; ?></td>
                            <td><?= $file['downloads']; ?></td>
                            <td><?= $file['file_access'];?></td>
                            <td>
                                <div class="flex ">
                                   <a href="index.php?delete='<?= $file_id; ?>'" ><i class="fas fa-trash-alt  mr-2"></i>Delete</a>  
                                   <a class="mt-3" href="index.php?downloads='<?= $file_id; ?>'" >Download File<i class="fas fa-download"></i></a>
                                </div>
                                <div>
                                     
                                </div>
                              
                            
                            </td>
         
                        </tr> 
                        <?php } ?>

                        <!-- Button trigger modal -->

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include "lib/footer.php"; ?>
