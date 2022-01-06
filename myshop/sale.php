<?php
include 'headers.php';
$id = $_GET['id'];
$category=$_GET['category'];
$itmqry = mysqli_query( $config, "SELECT * FROM itemsforsale WHERE id='$id'" );
$itmrow = mysqli_fetch_assoc( $itmqry );
$itemname = $itmrow['itemname'];
$unitcost = $itmrow['unitcost'];
$unit = $itmrow['unit'];
$outletname = $_COOKIE['outlet'];
$stckqry = mysqli_query( $config, "SELECT * FROM stock WHERE item='$itemname' and outletname='$outletname' ORDER BY id DESC LIMIT 1" );
$stckrow = mysqli_fetch_assoc( $stckqry );
if ( isset( $_POST['sell'] ) ) {
    $amountpaid = $_POST['amount'];
    $quantity = $amountpaid/$unitcost;
    $salesdate = date( 'Y-m-d' );
    $prev = $stckrow['newbal'];
    $newbal = $prev-$quantity;
    if ( $prev<$quantity ) {
        $info = '<div class="error" align="left"><img src="images/error.png" width="20" height="20" align="left">Not enough quantity for sale!</div>';
    } else {
        if ( mysqli_query( $config, "INSERT INTO stock (item,prevbal,newstock,newbal,outletname) VALUES('$itemname','$prev','$quantity','$newbal','$outletname')" ) ) {
            if ( mysqli_query( $config, "INSERT INTO sales(itemname,unitcost,quantity,totalcost,salesdate,outletname) VALUES('$itemname','$unitcost','$quantity','$amountpaid','$salesdate','$outletname')" ) ) {
                header( 'location:salesuccess.php?category='.$category );
                //$info = '<div class="success" align="left"><img src="images/success.png" width="20" height="20" align="left">Sale was successful.</div>';
            } else {
                $info = '<div class="error" align="left"><img src="images/error.png" width="20" height="20" align="left">Transaction failed at sales!</div>';
            }
        } else {
            $info = '<div class="error" align="left"><img src="images/error.png" width="20" height="20" align="left">Transaction failed at stock!</div>';
        }
    }

}
?>
<form method = 'post'>
<table>
<tr><td>Item: <?php echo $itemname ?><br>Unit Cost: Ksh.<?php echo number_format( $unitcost, 2 ) ?> per <?php echo $unit ?></td></tr>
<tr><td><input type = 'number' name = 'amount' placeholder = 'Enter Amount Paid' style = 'width:100%'></td></tr>
<tr><td><input type = 'submit' name = 'sell' value = 'Submit Sale'></td></tr>
<tr><td><?php echo $info ?></td></tr>
</table>
</form>
<?php
include 'styles.html';
?>