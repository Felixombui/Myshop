<?php
include 'headers.php';

if ( empty( $_SESSION['admin'] ) ) {
    header( 'location:adminlogin.php' );
}
//echo $_SESSION['admin'];
?>
<table><tr><td>
<a href = 'categories.php'><div style = 'float: left; width:180px; height:100px; border:1px solid pink; box-shadow:3px 3px solid grey; text-align:center; margin:8px;'>
<img src = '../images/orders.png' width = '30' height = '30' style = 'margin:7px;'><br>Sales Report
</div></a>
<a href = 'orderlimits.php'><div style = 'float: left; width:180px; height:100px; border:1px solid pink; box-shadow:3px 3px solid grey; text-align:center; margin:8px;'>
<img src = '../images/packaging.png' width = '30' height = '30' style = 'margin:7px;'><br>Order Limits
</div></a>
<a href = 'stocks.php'><div style = 'float: left; width:180px; height:100px; border:1px solid pink; box-shadow:3px 3px solid grey; text-align:center; margin:8px;'>
<img src = '../images/db.png' width = '30' height = '30' style = 'margin:7px;'><br>Stocks
</div></a>
<a href = 'usersettings.php'><div style = 'float: left; width:180px; height:100px; border:1px solid pink; box-shadow:3px 3px solid grey; text-align:center; margin:8px;'>
<img src = '../images/user.png' width = '30' height = '30' style = 'margin:7px;'><br>User Settings
</div></a>
</td></tr></table>
<?php include '../styles.html' ?>