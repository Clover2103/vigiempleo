<?php

print_r("entre aqui papa");
SESSION_START();
session_unset();
session_destroy();
header("location: https://vigiempleo.com/pages/admin/login-admin.php");

?>