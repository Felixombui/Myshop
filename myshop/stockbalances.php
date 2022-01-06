<?php
include 'headers.php';
$outletname = $_COOKIE['outlet'];
$itmsqry = mysqli_query( $config, 'SELECT * FROM itemsforsale' );
if ( isset( $_POST['search'] ) ) {
    $searchkey = addslashes( $_POST['searchitem'] );
    $itmsqry = mysqli_query( $config, "SELECT * FROM itemsforsale WHERE itemname LIKE '%$searchkey%'" );

}
?>
<form method = 'post'>
<table><tr><td align = 'left'><input type = 'text' name = 'searchitem' placeholder = 'Search items' style = 'width:80%'><input type = 'submit' name = 'search' value = 'Search' style = 'width:19%'></td></tr></table>
</form>
<table style = 'border-collapse: collapse; border:1px solid pink'>
<tr class = 'rowheader'><th class = 'rowheader'>Item</th><th class = 'rowheader'>Stock Balance</th></tr>
<?php
while( $itmsrow = mysqli_fetch_assoc( $itmsqry ) ) {
    $itemname = $itmsrow['itemname'];
    $stckqry = mysqli_query( $config, "SELECT * FROM stock WHERE item='$itemname' AND outletname='$outletname' ORDER BY id DESC LIMIT 1" );
    while( $stckrow = mysqli_fetch_assoc( $stckqry ) ) {
        $item = $stckrow['item'];
        $balance = $stckrow['newbal'];
        echo '<tr><td>'.$item.'</td><td>'.$balance.'</td></tr>';
    }

}
?>
</table>
<style>
.rowheader {
    background-color: silver;
}
</style>
<?php include 'styles.html' ?>