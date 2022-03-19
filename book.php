<!DOCTYPE html>
<html>
    <head>
        <?php require_once "navbar.php"; 
        if(!isset($_SESSION["userCode"]) || !isset($_SESSION["name"])){
            echo '<script>window.alert("Session expired! Please login to view this page")</script>';
            echo '<script type="text/javascript">window.location = "login.php"</script>';
        };
        ?>
    </head>
    <body>
        <div class="container">
            <div class="card">
                <form method="POST">
                    <?php if(isset($_POST["search"])){ ?>
                        <a href="book.php" class="btn btn-outline-primary" role="button">Back</a>    
                    <?php } ?>
                    <br><div class="input-group">
                        <input type="search" class="form-control rounded" name="searchBar" placeholder="Enter book's name, author's name or ISBN"" aria-label="Search" aria-describedby="search-addon">
                        <input type="submit" name="search" value="Search" class="btn btn-outline-primary">
                    </div><br>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Barcode Number</th>
                            <th scope="col">Book Name</th>
                            <th scope="col">Author</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $counter = 0;
                            if(isset($_POST["search"])){
                                $value = trim($_POST["searchBar"]);
                                $bookArr = search($value);
                            }else{
                                $bookArr = getAllBooks();
                            } 

                            if(isset($bookArr)){
                                foreach($bookArr as $books=>$b){
                                    $counter++;
                                    echo "<tr>";
                                        echo "<th scope='row'>".($books + 1)."</th>";
                                        echo "<td>".$bookArr[$books]['barcode']."</td>";
                                        echo "<td>".$bookArr[$books]['name']."</td>";
                                        echo "<td>".$bookArr[$books]['author']."</td>";
                                        echo "<td><a href='details.php?barcode=".$bookArr[$books]['barcode']."'>View</a></td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>    
            </div>
            <?php echo "Showing ".$counter." results" ;?>
        </div>
    </body>
    <footer>
        <?php require_once "footer.php"; ?>
    </footer>
</html>