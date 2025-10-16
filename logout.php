<?php
include('config.php');  // path project structure ke hisaab se adjust kare
?>
<?php
session_start();
session_unset();
session_destroy();
header("Location: login.php");
exit;
?>
