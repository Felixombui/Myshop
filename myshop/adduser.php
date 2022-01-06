<?php
include 'config.php';
$outletname = $_COOKIE['outlet'];
if ( isset( $_POST['add'] ) ) {
    $fullnames = addslashes( $_POST['fullnames'] );
    $username = addslashes( $_POST['username'] );
    $phonenumber = addslashes( $_POST['phonenumber'] );
    $emailaddress = addslashes( $_POST['emailaddress'] );
    $password = addslashes( $_POST['password'] );
    $cpassword = addslashes( $_POST['cpassword'] );
    if ( empty( $fullnames ) ) {
        $info = '<div class="error"><img src="images/error.png" width="20" height="20" align="left"> Eenter full names!';
    } elseif ( empty( $username ) ) {
        $info = '<div class="error"><img src="images/error.png" width="20" height="20" align="left"> Create a username!';
    } elseif ( empty( $phonenumber ) ) {
        $info = '<div class="error"><img src="images/error.png" width="20" height="20" align="left"> Enter phone number!';
    } elseif ( empty( $password ) ) {
        $info = '<div class="error"><img src="images/error.png" width="20" height="20" align="left"> Create a password!';
    } elseif ( !$cpassword == $password ) {
        $info = '<div class="error"><img src="images/error.png" width="20" height="20" align="left"> Passwords you entered do not match!';
    } else {
        $checkuser = mysqli_query( $config, "SELECT * FROM shopusers WHERE username='$username'" );
        if ( mysqli_num_rows( $checkuser )>0 ) {
            $info = '<div class="error"><img src="images/error.png" width="20" height="20" align="left"> The username has already been used! Please choose another.';
        } else {
            $password = md5( $password, false );
            if ( mysqli_query( $config, "INSERT INTO shopusers(fullnames,username,phonenumber,EmailAddress,pwd,shop,`status`) VALUES('$fullnames','$username','$phonenumber','$emailaddress','$password','$outletname','Active')" ) ) {
                setcookie( 'usercookie', $username, time() + ( 10 * 365 * 24 * 60 * 60 ) );
                header( 'location:index.php' );
            }
        }
    }

}
?>
<table><tr><th>Create User</th></tr>
<form method = 'post'>
<table>
<tr><td><input type = 'text' name = 'fullnames' placeholder = 'Enter user full names'></td></tr>
<tr><td><input type = 'text' name = 'username' placeholder = 'Create username'></td></tr>
<tr><td><input type = 'text' name = 'phonenumber' placeholder = 'Enter user phone number'></td></tr>
<tr><td><input type = 'text' name = 'emailaddress' placeholder = 'Enter user email address'></td></tr>
<tr><td><input type = 'password' name = 'password' placeholder = 'Create a password'></td></tr>
<tr><td><input type = 'password' name = 'cpassword' placeholder = 'Confirm Password'></td></tr>
<tr><td><input type = 'text' name = 'outles' value = '<?php echo $outletname ?>' readonly = readonly></td></tr>
<tr><td><input type = 'submit' name = 'add' value = 'Create User Account'></td></tr>
</table>

</form>
</table>
<?php
include 'styles.html';
?>