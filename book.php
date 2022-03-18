<!DOCTYPE html>
<html>
    <head>
        <?php require_once "navbar.php"; 
        if(!isset($_SESSION["userCode"]) || !isset($_SESSION["name"])){
            echo '<script>window.alert("Please login to view this page")</script>';
            echo '<script type="text/javascript">window.location = "login.php"</script>';
        };?>
    </head>
    <body>
        <div class="container">
                <?php if(isset($_POST["create"])){
                    echo '<script type="text/javascript">window.location = "createbook.php"</script>';
                }
                ?>
            <div class="card">
                <form method="POST">
                    <input type="submit" name="create" value="Create Book">
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
                            $bookArr = getAllBooks();
                            $counter = 0;
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