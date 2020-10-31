<?php include('processlogin.php'); ?>
<?php include "lib/header.php"; ?>
<body>

   
    <div class="container">

        <!-- print error and success message -->

         <?php
            print_error();
            print_success();

         ?>
         <!-- end of printing error and success message -->
    <h3 class="text-center mt-5">Login</h3>
    <form action="" class="shadow-md rounded px-8 pt-6 pb-8 mb-4 bg-gray-200" method="POST">
                <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="text" placeholder="Email">
                </div>
                <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight" id="password" name="password" type="password" placeholder="******************">
                </div>
                <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="login">
                    Sign In
                </button>
                <!-- <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="forgotpassword.php">
                    Forgot Password?
                </a> -->
                </div>
                <div class="flex items-center justify-between">
                <p>Not registered? <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="register.php">
                    Create an account
                </a></p>
                </div>
    </form>


    </div>
    
    <?php include "lib/footer.php"; ?>