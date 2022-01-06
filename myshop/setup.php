<?php
include 'config.php';
if ( !$outletname ) {
    $detail = "<tr><td><input type = 'submit' name = 'submit' value = 'Submit'></td></tr>";
}
if ( isset( $_POST['submit'] ) ) {
    $phonenumber = $_POST['phonenumber'];
    $checklocal = mysqli_query( $config, "SELECT * FROM shopdetails WHERE Telephone='$phonenumber'" );
    if ( mysqli_num_rows( $checklocal )>0 ) {
        $localrow = mysqli_fetch_assoc( $checklocal );
        $outletname = $localrow['ShopName'];
        //echo 'Login succeeded';
        setcookie( 'outlet', $outletname,  time()+10 * 365 * 24 * 60 * 60 );
        header( 'location:index.php' );
    } else {
        $checkmdl = mysqli_query( $config2, "SELECT * FROM customers WHERE phonenumber='$phonenumber'" );
        if ( mysqli_num_rows( $checkmdl )>0 ) {
            $mdlrow = mysqli_fetch_assoc( $checkmdl );
            $outletname = $mdlrow['names'];
            $emailaddress = $mdlrow['emailaddress'];
            $location = $mdlrow['location'];
            $detail = "<tr><td><input type = 'text' name = 'outletname' value = '".$outletname."' readonly=readonly></td></tr>
        <tr><td><input type = 'text' name = 'address' placeholder='Enter Box Address'></td></tr>
        <tr><td><input type = 'text' name = 'location' value = '".$location."' ></td></tr>
        <tr><td><input type = 'text' name = 'emailaddress' value = '".$emailaddress."' readonly=readonly></td></tr>
        <tr><td><input type = 'submit' name = 'register' value = 'Register Outlet' ></td></tr>";

        } else {
            $info = '<div class="error"><img src="images/error.png" width="20" height="20" align="left">The phone number you entered is not registered with MDL Systems.';
        }
    }
}
if ( isset( $_POST['register'] ) ) {
    $box = addslashes( $_POST['address'] );
    $outletname = addslashes( $_POST['outletname'] );
    $location = addslashes( $_POST['location'] );
    $phonenumber = addslashes( $_POST['phonenumber'] );
    $emailaddress = addslashes( $_POST['emailaddress'] );
    if ( mysqli_query( $config, "INSERT INTO shopdetails(ShopName,BoxNo,`Location`,Telephone,EmailAddress) VALUES('$outletname','$box','$location','$phonenumber','$emailaddress' )" ) ) {
        echo 'login succeeded';
        setcookie( 'outlet', $outletname, time() + ( 10 * 365 * 24 * 60 * 60 ) );
        header( 'location:adduser.php' );
    }
}
?>
<table><tr><td>

<form method = 'post'>
<table><tr><th>Registration</th></tr>
<tr><td><input type = 'text' name = 'phonenumber' placeholder = 'Enter Registered Phone Number' value = "<?php echo $phonenumber ?>"></td></tr>
<?php echo $detail ?>
<tr><td><?php echo $info ?></td></tr>
</table>
</form>
</td></tr></table>
<?php
include 'styles.html';
?>