<script src="../js/sweetalert2.all.min.js"></script>
<?php
session_start();
unset($_SESSION);
session_destroy();
header("Location:../../SignUpProf/LoginProf.php");
echo "<script>alert('you have successfuly logged out')</script>";
?>