<?php
include "../sql/conn.php";

// remove all session variables
session_unset();

// destroy the session
session_destroy();

// redirect user
header("Location: ../login.php");
exit();
