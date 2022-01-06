<?php
include '../config.php';
$remoteqry = mysqli_query( $config2, 'SELECT * FROM items' );
set_time_limit( 0 );
while( $remoterow = mysqli_fetch_assoc( $remoteqry ) ) {
    $itemname = $remoterow['itemname'];
    $unit = $remoterow['unitofmeasure'];
    $qry = mysqli_query( $config, "SELECT * FROM itemsforsale WHERE itemname='$itemname'" );
    if ( mysqli_num_rows( $qry )>0 ) {
        //do nothing
    } else {
        mysqli_query( $config, "INSERT INTO itemsforsale(itemname,unitcost,unit,not_limit,orderamnt) VALUES('$itemname','0.0','$unit','0','0')" );
    }
}
header( 'location:orderlimits.php' );
?>