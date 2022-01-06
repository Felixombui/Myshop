<?php
include 'headers.php';
$category=$_GET['category'];
if ( empty( $_SESSION['admin'] ) ) {
    header( 'location:adminlogin.php' );
}
$carry=$_GET['carry'];
if($carry==true){
    $startdate=$_GET['startdate'];
    $enddate=$_GET['enddate'];
    $outletname=$_GET['outletname'];
    $itmsqry=mysqli_query($config,"SELECT * FROM itemsforsale WHERE category='$category'");
}else{
if ( isset( $_POST['search'] ) ) {
    $startdate = $_POST['from'];
    $enddate = $_POST['to'];
    $outletname = $_POST['outlet'];
   // $squery = mysqli_query( $config, "SELECT * FROM sales WHERE outletname='$outletname' AND salesdate>='$startdate' AND salesdate<='$enddate'" );
   $itmsqry=mysqli_query($config,"SELECT * FROM itemsforsale WHERE category='$category'");
}
}
?>
<form method = 'post'>
<table><tr><td>Outlet:<select name = 'outlet' style = 'padding: 3px;border:none; border-bottom:1px cyan solid;'>
<option selected><?php echo $outletname ?></option>
<?php
$outletqry = mysqli_query( $config, 'SELECT * FROM shopdetails' );
while( $outletrow = mysqli_fetch_assoc( $outletqry ) ) {
    echo '<option>'.$outletrow['ShopName'].'</option>';
}
?>
</select></td><td>From:<input type = 'date' name = 'from' style = 'padding: 3px;border:none; border-bottom:1px cyan solid;' value = "<?php echo $startdate ?>"></td><td>To:<input type = 'date' name = 'to' style = 'padding: 3px;border:none; border-bottom:1px cyan solid;' value = "<?php echo $enddate ?>"></td><td><input type = 'submit' name = 'search' value = 'Go' style = 'padding: 3px;' ></td></tr></table>
</form>
<table style = 'border-collapse: collapse; border:1px solid pink;'><tr><th>Item</th><th>Quantity</th><th>Sold(Ksh)</th><th>&nbsp;</th></tr>
<?php
$totalsold=0;
while(@$itmsrow=mysqli_fetch_assoc($itmsqry)){
    $itm=$itmsrow['itemname'];
    $salesqry=mysqli_query($config,"SELECT * FROM sales WHERE itemname='$itm' AND salesdate>='$startdate' AND salesdate<='$enddate' AND outletname='$outletname'");
    $amountsold=0;
    $quantitysold=0;
   // $totalsold=0;
    while($salesrow=mysqli_fetch_assoc($salesqry)){
        $quantity=$salesrow['quantity'];
        $cost=$salesrow['totalcost'];
        $amountsold=$amountsold+$cost;
        $quantitysold=$quantitysold+$quantity;
        $totalsold=$totalsold+$cost;
    }
    //$totalsold=$totalsold+$amountsold;
    if($amountsold>0){
    echo '<tr style="padding:18px; border:1px solid cyan;"><td align="left">'.$itm.'</td><td align="right">'.number_format($quantitysold,1).'</td><td align="right">'.number_format($amountsold,2).'</td><td style="padding:10px;"><a href="salesdetails.php?itm='.urlencode($itm).'&from='.$startdate.'&to='.$enddate.'&outlet='.urlencode($outletname).'&category='.$category.'">View</a></td></tr>';
    }
    
}
//$totqry=mysqli_query($config,"SELECT SUM(totalcost) AS totalsold FROM sales WHERE salesdate>='$startdate' AND salesdate<='$enddate'");
//$totrow=mysqli_fetch_assoc($totqry);
//$totalsold=$totrow['totalsold'];
echo '<tr style=" border:1px solid cyan; box-shadow:2px 2px solid cyan;"><td>&nbsp;</td><td></td><td align="right">'.number_format($totalsold,2).'</td><td>&nbsp;</td></tr>';
?>
</table>
<?php include '../styles.html' ?>