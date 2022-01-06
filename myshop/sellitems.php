<?php
include 'headers.php';
$outletname = $_COOKIE['outlet'];
$category = $_GET['category'];
if ( empty( $_SESSION['user'] ) ) {
    header( 'location:login.php' );
}
$itmsqry = mysqli_query( $config, "SELECT * FROM itemsforsale WHERE category='$category'" );
if ( mysqli_num_rows( $itmsqry )<1 ) {
    echo '<div style="margin-top:150px;" align="center"><img src="images/products.png" width="20" height="20">No items registered yet!</div>';
}
?>
<table><tr><td>
<?php
while( $itmsrow = mysqli_fetch_assoc( $itmsqry ) ) {
    $itemid = $itmsrow['id'];
    $itemname = $itmsrow['itemname'];
    $unit = $itmsrow['unit'];
    $stckqry = mysqli_query( $config, "SELECT * FROM stock WHERE item='$itemname' AND outletname='$outletname' ORDER BY id DESC LIMIT 1" );
    $stckrow = mysqli_fetch_assoc( $stckqry );
    $stockamount = $stckrow['newbal'];
    if ( $stockamount>0 ) {
        echo '<a href="sale.php?id='.$itemid.'&category='.$category.'"><div style = "float: left; width:180px; height:100px; border:1px solid pink; box-shadow:3px 3px solid grey; text-align:center; margin:8px;"><div style="margin-top:30px;">'.$itemname.'<br>Stock Bal: '.round( $stockamount, 1 ).'</div></div></a>';
    }
}
?>
</td></tr></table>
<?php
include 'styles.html';
?>
