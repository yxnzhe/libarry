<?php
    function connectDb(){ //Connect to database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "elms";

        $conn = mysqli_connect($servername, $username, $password, $db);

        if(!$conn){
            die ("Connection failed: ". mysqli_connect_error()); //Return error message if there's error when connecting to the database
        }
        return $conn;
    }

    function login($email, $pass){ //Check for login credential
        if($email == "" || $pass == ""){ //Email and/or password field is empty
            echo "<p>Email and Password is Mandatory!</p>";
        }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //Wrong email format
            echo "<p>Invalid email format!</p>";
        }else{ //All field is not empty will continue to login
            $encrp = hash("sha256", $pass);
            $connect = connectDb();

            $sql = "SELECT name, userCode, password FROM users WHERE email = ?";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param("s", $email);

            if($stmt->execute()){
                $stmt->bind_result($name, $userCode, $password);
                if($stmt->fetch()){
                    if($password == $encrp){ //Password and email match with our database
                        echo '<script type="text/javascript">window.location = "index.php"</script>';
                        $_SESSION["userCode"] = "LMS00".$userCode;
                        $_SESSION["name"] = $name;
                    }else{ //Password or email doesn't match with our database
                        echo "<p>Login Failed. Email or Password inserted doesn't match with our database!<p>";
                    }
                }else{ //Unable to search for the email and password in our database
                    echo "<p>Login Failed. Email or Password inserted doesn't match with our database!<p>";
                }
            }else{ //Database error
                echo "Error: ".$sql."<br>".mysqli_error($connect);
            }
            $stmt->close();
            $connect->close();
        }
    }

    function signup($name, $email, $password){
        if($name == "" || $email == "" || $password == ""){
            echo "<p>Please fill in all the details</p>";
        }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //Wrong email format
            echo "<p>Invalid email format!</p>";
        }else{
            $encrp = hash("sha256", $password);
            $userCode = runningNum();
            $connect = connectDb();

            $sql = 'INSERT INTO users (name, userCode, email, password) VALUES (?,?,?,?)';
            $stmt = $connect->prepare($sql);
            $stmt->bind_param("ssss", $name, $userCode, $email, $encrp);

            if($stmt->execute()){
                echo "<p>Saved in database</p>";
                echo '<script type="text/javascript">window.location = "index.php"</script>';
                $_SESSION["userCode"] = "LMS00".$userCode;
                $_SESSION["name"] = $name;
            }else{
                echo "Error: ".$sql."<br>".mysqli_error($connect);
            }
            $stmt->close();
            $connect->close();
        } 
    }

    function runningNum(){ //Get the running number
        $connect = connectDb();

        $sql = "SELECT * FROM users ORDER BY userCode DESC LIMIT 1";
        if($results = $connect->query($sql)){
            $row = $results->fetch_assoc();
            if(isset($row["userCode"])){
                $previousNum = $row["userCode"];
            }else{
                $previousNum = "";
            }
            if($previousNum == ""){
                $currentNum = "1";
            }else{
                $currentNum = $previousNum + 1;
            }
        }
        $connect->close();
        return $currentNum;
    }

    function createNewBook($barcode, $bookName, $author, $isbn, $price){
        if($barcode == "" || $bookName == "" || $author == "" || $isbn == "" || $price == ""){
            echo "<p>Please fill in all the details</p>";
        }else{
            $connect = connectDb();

            $sql = 'INSERT INTO books (barcode, `name`, author, ISBN, price) VALUES (?,?,?,?,?)';
            $stmt = $connect->prepare($sql);
            $stmt->bind_param("ssssi", $barcode, $bookName, $author, $isbn, $price);

            if($stmt->execute()){
                echo "<p>Saved in database</p>";
            }else{
                echo "Error: ".$sql."<br>".mysqli_error($connect);
            }
            $stmt->close();
            $connect->close();
        }
    }

    function getAllBooks(){
        $bookArray = array();
        $connect = connectDb();

        $sql = "SELECT barcode, `name`, author, isbn, price FROM books";

        if($result = $connect->query($sql)){
            while($row = $result->fetch_assoc()){
                array_push($bookArray, $row);
            }
        }else{
            echo "Error: ".$sql."<br>".mysqli_error($connect);
        }

        return $bookArray;
        $connect->close();
    }

    function getSingleBook($barcode){
        $singleBook = array();
        $connect = connectDb();

        $sql = "SELECT b.barcode, b.name, b.author, b.isbn, b.price, d.details, d.publisher, d.img FROM books b
                INNER JOIN details d
                ON b.barcode = d.barcode
                WHERE b.barcode = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("s", $barcode);

        if($stmt->execute()){
            $stmt->bind_result($code, $name, $author, $isbn, $price, $details, $publisher, $img);
            while($stmt->fetch()){
                $singleBook += ["code" => $code];
                $singleBook += ["name" => $name];
                $singleBook += ["author" => $author];
                $singleBook += ["isbn" => $isbn];
                $singleBook += ["price" => $price];
                $singleBook += ["details" => $details];
                $singleBook += ["publisher" => $publisher];
                $singleBook += ["img" => $img];
            }
        }else{
            echo "Error: ".$sql."<br>".mysqli_error($connect);
        }

        return $singleBook;
        $stmt->close();
        $connect->close();
    }

    function writeDetails($barcode, $details, $publisher, $img){
        if($barcode == "" || $details == "" || $publisher == "" || $img == ""){
            echo "<p>Please fill in all the details</p>";
        }else{
            $connect = connectDb();

            $sql = 'INSERT INTO details (barcode, details, publisher, img) VALUES (?,?,?,?)';
            $stmt = $connect->prepare($sql);
            $stmt->bind_param("ssss", $barcode, $details, $publisher, $img);

            if($stmt->execute()){
                // echo "<p>Saved in database</p>";
            }else{
                echo "Error: ".$sql."<br>".mysqli_error($connect);
            }
            $stmt->close();
            $connect->close();
        }
    }
?>