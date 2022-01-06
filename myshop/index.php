<?php
include 'headers.php';
if ( empty( $_SESSION['user'] ) ) {
    header( 'location:login.php' );
}
include 'styles.html';
?>
<table><tr><td><a href = 'selectcategory.php' style = 'text-align: center;'>
<div style = 'float: left; width:180px; height:100px; border:1px solid pink; box-shadow:3px 3px solid grey; text-align:center; margin:8px;'>
<img src = 'images/emptycart.png' width = '30' height = '30' style = 'margin:7px;'><br>New Sale
</div></a>
<a href = 'salesreport.php' style = 'text-align: center;'><div style = 'float: left; width:180px; height:100px; border:1px solid pink; box-shadow:3px 3px solid grey; text-align:center; margin:8px;'>
<img src = 'images/orders.png' width = '30' height = '30' style = 'margin:7px;'><br>Sales Report
</div></a>
<a href = 'stockbalances.php' style = 'text-align: center;'><div style = 'float: left; width:180px; height:100px; border:1px solid pink; box-shadow:3px 3px solid grey; text-align:center; margin:8px;'><img src = 'images/view.png' width = '30' height = '30' style = 'margin:7px;'><br>Stock Balances
</div></a>
<a href = 'products.php' style = 'text-align: center;'><div style = 'float: left; width:180px; height:100px; border:1px solid pink; box-shadow:3px 3px solid grey; text-align:center; margin:8px;'>
<img src = 'images/products.png' width = '30' height = '30' style = 'margin:7px;'><br>Products
</div></a>
<a href = 'contactus.php' style = 'text-align: center;'><div style = 'float: left; width:180px; height:100px; border:1px solid pink; box-shadow:3px 3px solid grey; text-align:center; margin:8px;'><img src = 'images/support.png' width = '30' height = '30' style = 'margin:7px;'><br>Contact us
</div></a>
</td></tr></table>
