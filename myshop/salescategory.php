<?php
include 'headers.php';
$id=$_GET['id'];
$sdate=$_GET['sdate'];
$edate=$_GET['edate'];
$sqry=mysqli_query($config,"SELECT * FROM itemsforsale where id='$id'");
$srow=mysqli_fetch_assoc($sqry);
$itemname=$srow['itemname'];
$outletname = $_COOKIE['outlet'];
?>
<table style = 'border-collapse: collapse; border:1px solid pink; margin-top:10px;'><tr><th>Item</th><th>Quantity</th><th>Cost</th><th>Date</th></tr>
<?php
$salesqry=mysqli_query($config,"SELECT * FROM sales WHERE itemname='$itemname' AND salesdate>='$sdate' AND salesdate<='$edate' AND outletname='$outletname'");
$totalcost=0;
$totalquantity=0;
while($salesrow=mysqli_fetch_assoc($salesqry)){
$item=$salesrow['itemname'];
$quantity=$salesrow['quantity'];
$cost=$salesrow['totalcost'];
$date=$salesrow['salesdate'];
$totalcost=$totalcost+$cost;
$totalquantity=$totalquantity+$quantity;
echo '<tr><td style="border-left:1px solid pink;">'.$item.'</td><td style="border-left:1px solid pink;">'.number_format($quantity,1).'</td><td style="border-left:1px solid pink;">'.$cost.'</td><td style="border-left:1px solid pink;">'.$date.'</td></tr>';
}
echo '<tr style="border-top:1px solid pink; background-color:grey; color:white;"><td><b>Total</b></td><td><b>'.number_format($totalquantity,1).'</b></td><td><b>'.$totalcost.'</b></td><td></td></tr>';
?>
</table>
<table><tr><td align="right"><?php echo '<a href="salesreport.php?sdate='.$sdate.'&edate='.$edate.'"><button>Back</button>'?></td></tr></table>
<?php
include 'styles.html';
?>