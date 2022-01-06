<?php
include '../config.php';
$item = $_GET['item'];
$quantity = $_GET['quantity'];
$outlet = $_GET['outlet'];
//check if outlet is active
$outletqry = mysqli_query( $config, "SELECT * FROM shopdetails WHERE ShopName='$outlet'" );
if ( mysqli_num_rows( $outletqry )>0 ) {
    $itmsqry = mysqli_query( $config, "SELECT * FROM itemsforsale WHERE ItemName='$item'" );
    $itmsrow = mysqli_fetch_assoc( $itmsqry );
    $amountperpackage = $itmsrow['itemsperpackage'];
    $newstock = $quantity*$amountperpackage;
    $stockqry = mysqli_query( $config, "SELECT * FROM stock WHERE item='$item' AND outletname='$outlet' ORDER BY id DESC LIMIT 1" );
    if ( mysqli_num_rows( $stockqry )>0 ) {
        $stockrow = mysqli_fetch_assoc( $stockqry );
        $prev = $stockrow['newbal'];
    } else {
        $prev = 0;

    }
    $newbal = $prev+$newstock;
    mysqli_query( $config, "INSERT INTO stock(item,prevbal,newstock,newbal,outletname) VALUES('$item','$prev','$newstock','$newbal','$outlet')" );
}
?>