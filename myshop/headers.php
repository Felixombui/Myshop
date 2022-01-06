<?php
session_start();
include 'config.php';
//CHECK STOCKS
$outletname = $_COOKIE['outlet'];
$itmqry = mysqli_query( $config, 'SELECT * FROM itemsforsale' );
while ( $itmsrow = mysqli_fetch_assoc( $itmqry ) ) {
    $itemname = $itmsrow['itemname'];
    $limit = $itmsrow['not_limit'];
    //check stocks
    $stkqry = mysqli_query( $config, "SELECT * FROM stock WHERE item='$itemname' AND outletname='$outletname'" );
    if ( mysqli_num_rows( $stkqry )>0 ) {
        $stkrow = mysqli_fetch_assoc( $stkqry );
        $stockbalance = $stkrow['newbal'];
        $variance = $stockbalance-$limit;
        if ( $variance<1 ) {
            $orderamount = $itmsrow['orderamnt'];
            $phonenumber = $_SESSION['phonenumber'];
            //submit order
            $orderurl = 'http://mdl.melanginedairies.co.ke/salesapp/submitorder.php?outlet='.urlencode( $outletname ).'&item='.urlencode( $itemname ).'&amount='.$orderamount.'&phone='.$phonenumber;
            file_get_contents( $orderurl );
        }
    }
}
echo "<table><tr><th align = 'left'>MyShop App</th><th><a href='index.php'><img src = 'images/home.png' width = '20' height = '20' align = 'left'></a> <img src = 'images/alerts.png' width = '20' height = '20'></a></th><th align = 'right'><div class = 'menu'><img src = 'images/menu.png' width = '20' height = '20'><span class = 'menutext'>
<table width = '100%' style = 'text-align: left; color:white;'>
<tr><td><a href='index.php' style='color:white; padding-right:50px;'><img src = 'images/home.png' width = '20' height = '20' align = 'left'>Home</a></td></tr>
<tr><td><a href='products.php' style='color:white; padding-right:50px;'><img src = 'images/products.png' width = '20' height = '20' align = 'left'>Products</a></td></tr>
<tr><td><a href='selectcategory.php' style='color:white; padding-right:50px;'><img src = 'images/emptycart.png' width = '20' height = '20' align = 'left'>Sell Items</a></td></tr>
<tr><td><a href='salesreport.php' style='color:white; padding-right:50px;'><img src = 'images/orders.png' width = '20' height = '20' align = 'left'>Sales Reports</a></td></tr>
<tr><td><a href='stockbalances.php' style='color:white; padding-right:50px;'><img src = 'images/view.png' width = '20' height = '20' align = 'left'>Stock Balances</a></td></tr>
<tr><td><a href='contactus.php' style='color:white; padding-right:50px;'><img src = 'images/support.png' width = '20' height = '20' align = 'left'>Contact us</a></td></tr>
</table>
</span></div></th></tr></table>";
echo "<table style = 'margin-top: 7px; text-align:left; color:white;'><tr style = 'background-color: blue;'><td style = 'padding: 5px;'><img src = 'images/user.png' width = '20' height = '20' align = 'left'>Welcome ".$_SESSION['fullnames'].' | <a href="logout.php" style="color:white;">Logout</a></td></tr></table>';
?>

