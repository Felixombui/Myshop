<?php
session_start();
include '../config.php';
echo "<table><tr><th align = 'left'><h3>MyShop Admin</h3>
</th><th align = 'right'><div class = 'menu'><img src = '../images/menu.png' width = '20' height = '20'><span class = 'menutext'>
<table width = '100%' style = 'text-align: left; color:white;'>
<tr><td><a href='index.php' style='color:white; padding-right:50px;'><img src = '../images/home.png' width = '20' height = '20' align = 'left'>Home</a></td></tr>

<tr><td><a href='salesreport.php' style='color:white; padding-right:50px;'><img src = '../images/orders.png' width = '20' height = '20' align = 'left'>Sales Reports</a></td></tr>
<tr><td><a href='orderlimits.php' style='color:white; padding-right:50px;'><img src = '../images/packaging.png' width = '20' height = '20' align = 'left'>Order Limits</a></td></tr>
<tr><td><a href='usersettings.php' style='color:white; padding-right:50px;'><img src = '../images/user.png' width = '20' height = '20' align = 'left'>User Settings</a></td></tr>
<tr><td><a href='contactus.php' style='color:white; padding-right:50px;'><img src = '../images/support.png' width = '20' height = '20' align = 'left'>Contact us</a></td></tr>
</table>
</span></div></th></tr></table>
<table style='margin-top:7px; background-color:blue; color:white;'><tr><td align='left'><img src='../images/user.png' width='20' height='20' align='left'>".$_SESSION['admin'].' | [<a href="logout.php" style="color:white;">Logout</a>]</td></tr></table>' ;
?>

