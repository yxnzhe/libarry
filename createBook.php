<!DOCTYPE HTML>
<html>
    <head>
        <?php
            require_once "navbar.php"; 
            if(isset($_SESSION["userCode"])){
                if($_SESSION["userCode"] != "LMS001"){
                    echo '<script>window.alert("You do not have the permission to view this page!")</script>';
                    echo '<script type="text/javascript">window.location = "index.php"</script>';
                }
            }
            if(!isset($_SESSION["userCode"]) || !isset($_SESSION["name"])){
                echo '<script>window.alert("Session expired! Please login to view this page")</script>';
                echo '<script type="text/javascript">window.location = "login.php"</script>';
            };
        ?>
    </head>
    <body>
        <div class="container">
            <a href="book.php" class="btn btn-outline-primary" role="button">View</a>
            <div class="card">
                <?php
                    if(isset($_POST["createBook"])){
                        $barcode = $_POST["barcode"];
                        $bName = $_POST["bookName"];
                        $author = $_POST["author"];
                        $isbn = $_POST["isbn"];
                        $price = $_POST["price"];
                        $description = $_POST["details"];
                        $publisher = $_POST["publisher"];
                        $img = $_POST["img"];

                        if($barcode == "" || $bName == "" || $author == "" || $isbn == "" || $price == "" || $description == "" || $publisher == "" || $img == ""){
                            echo "<p>Please fill in all the details</p>";
                        }else{
                            createNewBook($barcode, $bName, $author, $isbn, $price);
                            writeDetails($barcode, $description, $publisher, $img);
                        }
                    }
                ?>
                <form method="POST">
                    <label>Barcode</label><br>
                    <input type="text" placeholder="Barcode" name="barcode"><br>

                    <label>Book Name</label><br>
                    <input type="text" placeholder="Book Name" name="bookName"><br>

                    <label>Author</label><br>
                    <input type="text" placeholder="Author" name="author"><br>

                    <label>ISBN</label><br>
                    <input type="text" placeholder="ISBN" name="isbn"><br>

                    <label>Selling Price</label><br>
                    <input type="int" placeholder="Selling Price" name="price" min=1><br>

                    <label>Description</label><br>
                    <textarea name="details" rows="4" cols="50" placeholder="Description"></textarea><br>

                    <label>Publisher</label><br>
                    <input type="text" placeholder="Publisher" name="publisher"><br>

                    <label>Image</label><br>
                    <textarea name="img" rows="4" cols="50" placeholder="Image"></textarea><br>

                    <input type="submit" name="createBook" value="Create Book">
                </form>
            </div>
        </div>
    </body>
    <footer><?php require_once "footer.php"; ?></footer>
</html>