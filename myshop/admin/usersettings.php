<?php
include 'headers.php';

if ( empty( $_SESSION['admin'] ) ) {
    header( 'location:adminlogin.php' );
}
//echo $_SESSION['admin'];
?>
<table><tr><td>
<a href = 'adduser.php'><div style = 'float: left; width:200px; height:100px; border:1px solid pink; box-shadow:3px 3px solid grey; text-align:center; margin:8px;'>
<img src = '../images/adduser.png' width = '30' height = '30' style = 'margin:7px;'><br>Add User
</div></a>
<a href = 'addadmin.php'><div style = 'float: left; width:200px; height:100px; border:1px solid pink; box-shadow:3px 3px solid grey; text-align:center; margin:8px;'>
<img src = '../images/user.png' width = '30' height = '30' style = 'margin:7px;'><br>Add Admin User
</div></a>
<a href = 'viewusers.php'><div style = 'float: left; width:200px; height:100px; border:1px solid pink; box-shadow:3px 3px solid grey; text-align:center; margin:8px;'>
<img src = '../images/newuser.png' width = '40' height = '30' style = 'margin:7px;'><br>View Users
</div></a>
</td></tr></table>
<?php include '../styles.html' ?>