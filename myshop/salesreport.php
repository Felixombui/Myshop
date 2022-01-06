<?php
include 'headers.php';
$sdate=$_GET['sdate'];
$edate=$_GET['edate'];
if(empty($sdate)){
    if ( isset( $_POST['search'] ) ) {
    $startdate = $_POST['sdate'];
    $enddate = $_POST['edate'];
    $outletname = $_COOKIE['outlet'];
    $squery = mysqli_query( $config, "SELECT * FROM sales WHERE outletname='$outletname' AND salesdate>='$startdate' AND salesdate<='$enddate'" );

}
}else{
    $startdate=$sdate;
    $enddate=$edate;
    $outletname=$_COOKIE['outlet'];
    $squery = mysqli_query( $config, "SELECT * FROM sales WHERE outletname='$outletname' AND salesdate>='$startdate' AND salesdate<='$enddate'" );
}
?>
<form method = 'post'>
<table>
<tr><td>
Select Date: From: <input type = 'date' name = 'sdate' value='<?php echo $startdate ?>'>To<input type = 'date' name = 'edate' value='<?php echo $enddate ?>'><input type = 'submit' name = 'search' value = 'Go'>
</td></tr>
<tr><td>
<table style = 'border-collapse: collapse; border:1px solid pink;'><tr><th>Item</th><th>Quantity</th><th>Cost</th><th>Date</th></tr>
<?php

if(isset($_POST['search'])){
    $totalsales = 0;
    $totalquantity = 0;
    $startdate=$_POST['sdate'];
    $enddate=$_POST['edate'];
    $outletname=$_COOKIE['outlet'];
    $grossquantity=0;
    $grosssales=0;
    $catqry=mysqli_query($config,"SELECT * FROM itemsforsale");
    while($catrow=mysqli_fetch_assoc($catqry)){
        $id=$catrow['id'];
        $itemname=$catrow['itemname'];
        $squery=mysqli_query($config,"SELECT * FROM sales WHERE itemname='$itemname' AND outletname='$outletname' AND salesdate>='$startdate' AND salesdate<='$enddate'");
        if(mysqli_num_rows($squery)>0){
            $unitcost=0;
            $totalquantity=0;
            $totalcost=0;
            
            while($srow=mysqli_fetch_assoc($squery)){
                $unitcost=$srow['unitcost'];
                $quantity=$srow['quantity'];
                $cost=$srow['totalcost'];
                $totalquantity=$totalquantity+$quantity;
                $totalcost=$totalcost+$cost;
                $grossquantity=$grossquantity+$totalquantity;
                $grosssales=$grosssales+$totalcost;
                
            }
            echo '<tr><td style="padding:5px;"><a href="salescategory.php?id='.$id.'&sdate='.$startdate.'&edate='.$enddate.'">'.$itemname.'</a></td><td>'.round( $totalquantity, 1 ).'</td><td align="right">'.number_format( $totalcost, 2 ).'</td><td><a href="salescategory.php?id='.$id.'&sdate='.$startdate.'&edate='.$enddate.'">View</a></td></tr>';
        }
    }
}
//while( @$srow = mysqli_fetch_assoc( $squery ) ) {
 //   $itemname = $srow['itemname'];
 //   $unitcost = $srow['unitcost'];
 //   $quantity = $srow['quantity'];
 //   $cost = $srow['totalcost'];
 //   $date = $srow['salesdate'];
 //   $totalsales = $totalsales+$cost;
 //   $totalquantity = $totalquantity+$quantity;
 //   echo '<tr><td>'.$itemname.'</td><td>'.round( $quantity, 1 ).'</td><td align="right">'.number_format( $cost, 2 ).'</td><td>'.$date.'</td></tr>';
//}
echo '<tr style="background-color:cyan; font-weight:bold;"><td>Totals</td><td>'.round( $grossquantity, 1 ).'</td><td align="right">'.number_format( $totalcost, 2 ).'</td><td></td></tr>'
?>
</table>
</td></tr>

</table>
</form>
<?php
include 'styles.html';
?>