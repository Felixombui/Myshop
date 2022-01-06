<?php
include 'headers.php';
if(isset($_POST['submit'])){
    $soutletname=addslashes($_POST['soutlet']);
    $stckqry=mysqli_query($config,"SELECT * FROM stock WHERE outletname='$soutletname' ORDER BY id DESC");
    
}
?>
<form method="post">
<table><tr><td>
    <select name="soutlet">
        <option selected>--Select Outlet--</option>
        <?php
            $qry=mysqli_query($config,"SELECT * FROM shopdetails");
            while($row=mysqli_fetch_assoc($qry)){
                $soutlet=$row['ShopName'];
                echo '<option>'.$soutlet.'</option>';
            }
        ?>
        
    </select>
</td><td><input type="submit" name="submit" value="Select"></td></tr></table>
<table style="border-collapse: collapse;">
    <tr><td>Item</td><td>Prev</td><td>New</td><td>Bal</td><td>Date</td><td></td></tr>
    <?php
    while(@$stckrow=mysqli_fetch_assoc($stckqry)){
        $id=$stckrow['id'];
        $item=$stckrow['item'];
        $prevbal=$stckrow['prevbal'];
        $newstock=$stckrow['newstock'];
        $newbal=$stckrow['newbal'];
        $fulldate=explode(' ',$stckrow['date_time']);
        $date=$fulldate[0];
        echo '<tr style="border:1px solid pink; margin-top:5px;"><td align="left">'.$item.'</td><td>'.number_format($prevbal,1).'</td><td>'.number_format($newstock,1).'</td><td style="padding:5px;">'.number_format($newbal,1).'</td><td>'.$date.'</td><td><a href="deletestock.php?id='.$id.'"><img src="../images/delete.ICO" width="20" height="20"></a></td></tr>';
    }
    ?>
</table>
</form>
<?php include '../styles.html' ?>