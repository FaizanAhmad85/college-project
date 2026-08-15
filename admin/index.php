<?php
include "navbar.php";
session_start();
$log = $_SESSION['admin_user'];
if ($log == true)
    {

    }
else
{
    header('location:admin_login.php');
}
?>