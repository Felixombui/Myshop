<?php
include 'headers.php';

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
<table>
    <tr><th>Item Name</th><th>Qty Sold</th><th>Amount(Ksh)</th><th>Stock Bal</th><th>View</th></tr>
    <?php
    if(isset($_POST['search'])){
        $itsqry=mysqli_query($confg,"SELECT * FROM itemsforsale");
        while($itsmrow=mysqli_fetch_assoc($itsqry)){
        $itemname=$itsmrow['itemname'];
        $salesqry=mysqli_query($config,"SELECT SUM(quantity) as quantitysold,SUM(totalcost) AS TotalCost FROM sales WHERE itemname='$itemname' AND salesdate='$salesdate'");
        while($salesrow=mysqli_fetch_assoc($salesqry)){
            $quantitysold=$salesrow['quantitysold'];
            $totalcost=$salesrow['TotalCost'];
            $stckqry=mysqli_query($config,"SELECT * FROM stock WHERE item='$itemname' ORDERBY id DESC LIMIT 1");
            $stckrow=mysqli_fetch_assoc($stckqry);
            $stockbal=$stckrow['newbal'];
            echo '<tr><td>'.$itemname.'</td><td>'.$quantitysold.'</td><td>'.$totalcost.'</td><td>'.$stockbal.'</td><td><a href="salesreport.php?item='.$itemname.'"><img src="../images/view.png" width="20" height="20"></a></td></tr>';
    }
}
    }
    ?>
</table>