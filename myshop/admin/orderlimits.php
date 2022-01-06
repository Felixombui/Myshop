<?php
include 'headers.php';

if ( empty( $_SESSION['admin'] ) ) {
    header( 'location:adminlogin.php' );
}
$prdctqry = mysqli_query( $config, 'SELECT * FROM itemsforsale' );
?>
<table><tr><td align = 'right'><a href = 'sync.php'><button class = 'buttonstyle'><img src = '../images/sync.ico' width = '25' height = '25' align = 'left'>Sync MDL Products</button></a></td></tr></table>
<table style = 'margin-top:5px; border-collapse:collapse;border:1px solid pink;'>
<tr><th>Product</th><th>Cost</th><th>Alert Lim</th><th>Order Amount</th><th></th></tr>
<?php

while( $row = mysqli_fetch_assoc( $prdctqry ) ) {
    $id = $row['id'];
    $product = $row['itemname'];
    $notification = $row['not_limit'];
    $order = $row['orderamnt'];
    $cost = $row['unitcost'];
    echo '<tr style="border-bottom:1px solid pink;"><td align="left">'.$product.'</td><td>'.$cost.'</td><td>'.$notification.'</td><td>'.$order.'</td><td><a href="editproduct.php?id='.$id.'">Edit</a></td></tr>';
}
?>
</table>
<?php include '../styles.html' ?>