<!DOCTYPE HTML>
<html>
    <head>
        <?php
            require_once "navbar.php"; 
        ?>
    </head>
    <body>
        <?php
            if(isset($_POST["login"])){
                $email = $_POST["email"];
                $password = $_POST["password"];

                if($email == "" || $password == ""){
                    echo "<p>Please fill in all the details</p>";
                }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //Wrong email format
                    echo "<p>Invalid email format!</p>";
                }else{
                    login($email, $password);
                }
            }
        ?>
        <div class="container">
            <div class="card">
                <h1>Login</h1>
                <form method="POST">
                    <label>Email</label><br>
                    <input type="email" placeholder="Email" name="email"><br>

                    <label>Password</label><br>
                    <input type="password" placeholder="Password" name="password"><br>

                    <input type="submit" name="login" value="Login">
                </form>
            </div>
        </div>
    </body>
    <footer><?php require_once "footer.php"; ?></footer>
</html>