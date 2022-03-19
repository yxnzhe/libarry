<?php
    require_once "navbar.php";
    session_destroy();
    echo '<script type="text/javascript">window.location = "index.php"</script>';
    require_once "footer.php";
?>