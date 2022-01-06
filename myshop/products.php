<?php
include 'headers.php';

$outletname = $_COOKIE['outlet'];
$squery = mysqli_query( $config, 'SELECT * FROM itemsforsale' );

?>
<form method = 'post'>
<table>
<tr><td>

</td></tr>
<tr><td>
<table style = 'border-collapse: collapse; border:1px solid pink;'><tr><th>Item</th></tr>
<?php

while( @$srow = mysqli_fetch_assoc( $squery ) ) {
    $itemname = $srow['itemname'];
    $stckqry = mysqli_query( $config, "SELECT * FROM stock WHERE item='$itemname'" );
    $unitcost = $srow['unitcost'];
    $quantity = $srow['quantity'];
    $cost = $srow['totalcost'];
    $date = $srow['salesdate'];
    $totalsales = $totalsales+$cost;
    $totalquantity = $totalquantity+$quantity;
    echo '<tr><td>'.$itemname.'</td></tr>';
}

?>
</table>
</td></tr>

</table>
</form>
<?php
include 'styles.html';
?>