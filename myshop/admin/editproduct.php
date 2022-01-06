<?php
include 'headers.php';
if ( empty( $_SESSION['admin'] ) ) {
    header( 'location:adminlogin.php' );
}
$id = $_GET['id'];
$prdctqry = mysqli_query( $config, "SELECT * FROM itemsforsale WHERE id='$id'" );
$row = mysqli_fetch_assoc( $prdctqry );
if ( isset( $_POST['update'] ) ) {
    $unitcost = addslashes( $_POST['unitcost'] );
    $unit = addslashes( $_POST['unit'] );
    $alert = addslashes( $_POST['alert'] );
    $order = addslashes( $_POST['order'] );
    $unitsperpack = addslashes( $_POST['unitsperpack'] );
    $id = $_GET['id'];
    if ( empty( $unit ) ) {
        $info = '<div class="error" align="left"><img src="../images/error.png" width="20" height="20" align="left"> Unit cannot be blank!';
    } elseif ( empty( $unitcost ) ) {
        $info = '<div class="error" align="left"><img src="../images/error.png" width="20" height="20" align="left"> Unit cost cannot be blank or zero!';
    } elseif ( empty( $order ) ) {
        $info = '<div class="error" align="left"><img src="../images/error.png" width="20" height="20" align="left"> Auto order amount cannot be blank or zero!';
    } else {
        if ( mysqli_query( $config, "UPDATE itemsforsale SET unitcost='$unitcost',unit='$unit',not_limit='$alert',orderamnt='$order',itemsperpackage='$unitsperpack' WHERE id='$id'" ) ) {
            $info = '<div class="success" align="left"><img src="../images/success.png" width="20" height="20" align="left"> Update was successful';
        }
    }
}
?>
<form method = 'post'>
<table>
<tr><td align = 'left'>Product:</td><td><input type = 'text' name = 'item' value = "<?php echo $row['itemname'] ?>" readonly></td></tr>
<tr><td align = 'left'>Unit cost:</td><td><input type = 'number' name = 'unitcost' value = "<?php echo $row['unitcost'] ?>" style = 'width: 100%;'></td></tr>
<tr><td align = 'left'>Unit:</td><td><input type = 'text' name = 'unit' value = "<?php echo $row['unit'] ?>"></td></tr>
<tr><td align = 'left'>Alert Limit:</td><td><input type = 'number' name = 'alert' value = "<?php echo $row['not_limit'] ?>" style = 'width: 100%;'></td></tr>
<tr><td align = 'left'>Order Amount:</td><td><input type = 'number' name = 'order' value = "<?php echo $row['orderamnt'] ?>" style = 'width: 100%;'></td></tr>
<tr><td align = 'left'>Units Per Pack:</td><td><input type = 'number' name = 'unitsperpack' value = "<?php echo $row['itemsperpackage'] ?>" style = 'width: 100%;'></td></tr>
</table>
<table><tr><td><input type = 'submit' name = 'update' value = 'Update'></td></tr></table>
<table><tr><td><?php echo $info ?></td></tr></table>
</form>
<?php include '../styles.html' ?>