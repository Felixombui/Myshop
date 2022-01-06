<?php
include 'headers.php';
if ( empty( $_SESSION['admin'] ) ) {
    header( 'location:adminlogin.php' );
}
//echo $_SESSION['admin'];
if ( isset( $_POST['submit'] ) ) {
    $names = addslashes( $_POST['names'] );

    $emailaddress = addslashes( $_POST['emailaddress'] );
    $phonenumber = addslashes( $_POST['phonenumber'] );
    $password = addslashes( $_POST['password'] );
    $cpassword = addslashes( $_POST['cpassword'] );

    if ( empty( $names ) ) {
        $info = '<div class="error" align="left"><img src="../images/error.png" width="20" height="20" align="left"> You must enter full names!';
    } elseif ( empty( $emailaddress ) ) {
        $info = '<div class="error" align="left"><img src="../images/error.png" width="20" height="20" align="left"> You must enter your email address!';
    } elseif ( empty( $password ) ) {
        $info = '<div class="error" align="left"><img src="../images/error.png" width="20" height="20" align="left"> You must create a password!';
    } elseif ( !$password == $cpassword ) {
        $info = '<div class="error" align="left"><img src="../images/error.png" width="20" height="20" align="left"> The passwords you entered do not match!';
    } else {
        $password = md5( $password, false );
        if ( mysqli_query( $config, "INSERT INTO adminusers(names,emailaddress,phonenumber,`password`) values('$names','$emailaddress','$phonenumber','$password')" ) ) {
            $info = '<div class="success" align="left"><img src="../images/success.png" width="20" height="20" align="left"> User account created successfully.';
        }
    }
}
?>
<table><tr><td>
<form method = 'post'>
<input type = 'text' name = 'names' placeholder = 'Enter Full names'>
<input type = 'email' name = 'emailaddress' placeholder = 'Enter Email Address'>
<input type = 'text' name = 'phonenumber' placeholder = 'Enter Phone Number'>
<input type = 'password' name = 'password' placeholder = 'Create a password'>
<input type = 'password' name = 'cpassword' placeholder = 'Confirm Password'>
<input type = 'submit' name = 'submit' value = 'Create User Account'>
</form>
<?php echo $info ?>
</td></tr></table>
<?php include '../styles.html' ?>