<?php
include 'headers.php';
$from=$_GET['from'];
$to=$_GET['to'];
$itm=urldecode($_GET['itm']);
$outlet=urldecode($_GET['outlet']);
if ( empty( $_SESSION['admin'] ) ) {
    header( 'location:adminlogin.php' );
}
$squery=mysqli_query($config,"SELECT * FROM sales WHERE itemname='$itm' AND outletname='$outlet' AND salesdate>='$from' AND salesdate<='$to'");
?>

<table style = 'border-collapse: collapse; border:1px solid pink; margin-top:12px;'><tr><th>Item</th><th>Quantity</th><th>Sold(Ksh)</th></tr>
<?php
$totalsold=0;
while($srow=mysqli_fetch_assoc($squery)){
    $itm=$srow['itemname'];
    $quantitysold=$srow['quantity'];
    $amountsold=$srow['totalcost'];
    echo '<tr><td align="left">'.$itm.'</td><td align="right">'.number_format($quantitysold,1).'</td><td align="right">'.number_format($amountsold,2).'</td></tr>';
    $totalsold=$totalsold+$amountsold;
}

//$totqry=mysqli_query($config,"SELECT SUM(totalcost) AS totalsold FROM sales WHERE salesdate>='$startdate' AND salesdate<='$enddate'");
//$totrow=mysqli_fetch_assoc($totqry);
//$totalsold=$totrow['totalsold'];
echo '<tr style="border:1px solid cyan; background-color:pink;"><td>&nbsp;</td><td></td><td align="right"><b>'.number_format($totalsold,2).'</b></td><td>&nbsp;</td></tr>';

?>
</table>
<?php 
echo '<a href="salesreport.php?startdate='.$from.'&enddate='.$to.'&outletname='.$outlet.'&carry=true"><input type="submit" value="Back"></a>';
?>
<?php include '../styles.html' ?>