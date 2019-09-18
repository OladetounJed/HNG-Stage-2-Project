<?php
// Include config file
require_once "config.php";
// include "username.php";
// Define variables and initialize with empty values
$name = $username = $email = $phoneno =  $password =  "";
$name_err = $username_err = $email_err = $phoneno_err =  $password_err =  "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // include "validation/name.php";
    include "validation/username.php";
    include "validation/email.php";
    // include "validation/phoneno.php";
    // include "validation/password.php";
   
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (name,username, email, phoneno, password) VALUES (? , ? , ? , ? ,?)";
         
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssss", $param_name, $param_username, $param_email, $param_phoneno,$param_password);
            
            // Set parameters
            $param_username = $name;
            $param_username = $username;
            $param_username = $email;
            $param_username = $phoneno;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: login.php");
            } else{
                // echo $stmt->error();
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $mysqli->close();
}
?>
 <!DOCTYPE html>
<html>
    <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="style.css">
            <link href="https://fonts.googleapis.com/css?family=Red+Hat+Text&display=swap" rel="stylesheet">
        <title>
            Register Page
        </title>
    </head>
    <body>
        <header>
            <nav class="header-con">
                <a href="#Home" class="header-logo">
                The Internship
                </a>
                
                <a href="#Login" class="header-link">
                    Login
                </a>
                <a href="#About" class="header-link">
                    About Program
                </a>
                <a href="#Register" class="header-link">
                    Register
                </a>
                <a href="#Contact" class="header-link">
                    Contact
                </a>
                
            </nav>
        </header>
        <section>

        <main>
            <p class="main-header">Register For The Internship Program</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>
                    <input type="text" name="name" id="name" placeholder="Name (First and Last)"><br>
                    <span><?php echo $name_err; ?></span>

                    <div class="form-group">
                        <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>
                        <input type="text" name="username" id="username" placeholder="Username"><br>
                        <span><?php echo $username_err; ?></span>
                    </div>
                
                    <div class="form-group">
                        <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>
                        <input type="email" name="email" id="email" placeholder="Email Address"><br>
                        <span><?php echo $email_err; ?></span>
                    </div>
                    
                    <div class="form-group">
                        <?php echo (!empty($phoneno_err)) ? 'has-error' : ''; ?>
                        <input type="number" name="phoneno" id="phone-number" placeholder="Phone Number"><br>
                        <span><?php echo $phoneno_err; ?></span>
                    </div>
                    
                    <div class="form-group">
                        <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>
                        <input type="password" name="password" id="password" placeholder="Password"><br>
                        <span><?php echo $password_err; ?></span>
                    </div>

                    <input type="submit" id="submit" value="Register">
                </form>
        </main>

            <a href="index.html">
                <button class="register-btn" type="button">Already have an account?</button>
            </a>
            

        
    </section>


    <script src="script.js"></script>
    </body>
    
</html>
