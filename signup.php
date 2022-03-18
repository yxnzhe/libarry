<!DOCTYPE HTML>
<html>
    <head>
        <?php
            require_once "navbar.php";
        ?>
    </head>
    <body>
        <?php
            if(isset($_POST["signup"])){
                $name = $_POST["username"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                $confirmPass = $_POST["confirmPass"];

                if($name == "" || $email == "" || $password == "" || $confirmPass == ""){
                    echo "<p>Please fill in all the details</p>";
                }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //Wrong email format
                    echo "<p>Invalid email format!</p>";
                }else if($password != $confirmPass){
                    echo "<p>Password and confirm password must be the same</p>";
                }else{
                    signup($name, $email, $password);
                }
            }
        ?>
        <div class="container">
            <div class="card">
                <h1>Sign Up</h1>
                <form method='POST'>
                    <label>Name</label><br>
                    <input type="text" placeholder="Name" name="username" require><br>

                    <label>Email</label><br>
                    <input type="email" placeholder="Email" name="email" require><br>

                    <label>Password</label><br>
                    <input type="password" placeholder="Password" name="password" require><br>

                    <label>Confirm Password</label><br>
                    <input type="password" placeholder="Confirm Password" name="confirmPass" require><br>

                    <input type="submit" name="signup" value="Sign Up">
                </form>
            </div>
        </div>
    </body>
    <footer><?php require_once "footer.php"; ?></footer>
</html>