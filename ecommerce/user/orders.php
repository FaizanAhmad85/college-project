<?php
include "navbar.php";
session_start();
$login = $_SESSION['user'];
if ($login == true)
    {

    }
else
{
    header('location:login.php');
}
?>
