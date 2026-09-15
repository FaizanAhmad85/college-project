<?php
include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Create</title>
    <link rel="stylesheet" href="css/create_acc.css">
</head>
<body>
<form name="form" method="post" action="save.php">
    <table border="1" class="frm">
        <tr><td colspan="2" align="center" >Create Account</td></tr>
        <tr>
            <td><label for="name">Name</label></td>
            <td><input type="text" placeholder="enter your name" id="name" name="name" required></td>
        </tr>
        <tr>
            <td><label for="password">Password</label></td>
            <td><input type="password" placeholder="enter your password" id="password" name="password" required></td>
        </tr>
        <tr>
            <td><label for="gender">Gender</label></td>
            <td><select name="gender" id="gender" required>
                <option disabled selected value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select></td>
        </tr>
        <tr>
            <td><label for="dob">D.O.B</label></td>
            <td><input type="date" name="dob" id="dob" required></td>
        </tr>
        <tr>
            <td><label for="email">Email</label></td>
            <td><input type="email" placeholder="enter your email" id="email" name="email" required></td>
        </tr>
        <tr>
            <td><label for="phone">Phone no</label></td>
            <td><input type="tel" inputmode="numeric" maxlength="15" placeholder="enter your phone" id="phone" name="phone" required></td>
        </tr>
        <tr>
            <td><label for="address">Address</label></td>
            <td><textarea name="address" id="address" placeholder="enter your address" rows="3" cols="40" required></textarea></td>
        </tr>
        <tr><td colspan="2" align="center "><input type="submit" value="Create account" class="hov"
        style="background-color: orange; cursor: pointer; font-size: 20px;"></td></tr>
    </table>
</form>
    
</body>
</html>