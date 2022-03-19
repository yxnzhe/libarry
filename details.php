<!DOCTYPE HTML>
<html>
    <head>
        <?php
            require_once "navbar.php";
            if(!isset($_SESSION["userCode"]) || !isset($_SESSION["name"])){
                echo '<script>window.alert("Session expired! Please login to view this page")</script>';
                echo '<script type="text/javascript">window.location = "login.php"</script>';
            };
            ?> 
    </head>
    <body>
        <a href="book.php" class="btn btn-outline-primary" role="button">Back</a>
        <?php if(isset($_GET["barcode"])){
            $code = $_GET["barcode"];
            $bookArr = getSingleBook($code);
            if(!$bookArr){
                echo "<h2 style='text-align: center'>Your barcode doesn't match with our system. Please double check your barcode number</h3>";
            }else{
                echo "<table class='table'>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th scope='col'>Image</th>";
                            echo "<td><img src='".$bookArr["img"]."' width=350px alt='".$bookArr["name"]." photo'></td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<th scope='col'>Code</th>";
                            echo "<td>".$bookArr["code"]."</td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<th scope='col'>Name</th>";
                            echo "<td>".$bookArr["name"]."</td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<th scope='col'>Author</th>";
                            echo "<td>".$bookArr["author"]."</td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<th scope='col'>ISBN</th>";
                            echo "<td>".$bookArr["isbn"]."</td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<th scope='col'>Price</th>";
                            echo "<td> RM ".$bookArr["price"].".00</td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<th scope='col'>Description</th>";
                            echo "<td>".$bookArr["details"]."</td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<th scope='col'>Publisher</th>";
                            echo "<td>".$bookArr["publisher"]."</td>";
                        echo "</tr>";
                    echo "</thead>";
                echo "</table>";
            }
        } ?>  
    </body>
    <footer><?php require_once "footer.php"; ?></footer>
</html>  