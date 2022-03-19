<head>

</head>
<body>
    <div class="container">
        <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="index.php" class="nav-link px-2 text-muted">Home</a></li>
                <?php if(isset($_SESSION["userCode"]) && isset($_SESSION["name"])){ ?>
                <li class="nav-item"><a href="book.php" class="nav-link px-2 text-muted">View Book</a></li>
                <?php if($_SESSION["userCode"] == "LMS001"){ ?>
                <li class="nav-item"><a href="createbook.php" class="nav-link px-2 text-muted">Create Book</a></li>
                <?php } } ?>
                <?php if(!isset($_SESSION["userCode"]) && !isset($_SESSION["name"])){ ?>
                <li class="nav-item"><a href="login.php" class="nav-link px-2 text-muted">Login</a></li>
                <li class="nav-item"><a href="signup.php" class="nav-link px-2 text-muted">Sign Up</a></li>
                <?php } ?>
            </ul>
            <p class="text-center text-muted">© 2021 MSG Cooperation, Inc</p>
        </footer>
    </div>
</body>