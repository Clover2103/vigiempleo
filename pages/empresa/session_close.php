<?php

SESSION_START();
session_unset();
session_destroy();
header("location: https://vigiempleo.com/");

?>