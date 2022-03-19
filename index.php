<!DOCTYPE HTML>
<html>
    <head>
        <?php
            require_once "navbar.php";
        ?>
    </head>
    <body>
        <?php if(isset($_SESSION["name"])){echo "<h1>Welcome ".$_SESSION["name"]."</h1>";}?>
    </body>
    <footer><?php require_once "footer.php"; ?></footer>
</html>