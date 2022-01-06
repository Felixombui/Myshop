<?php
include 'config.php';
if ( !isset( $_COOKIE['outlet'] ) ) {
    header( 'location:setup.php' );
}
if ( isset( $_COOKIE['usercookie'] ) ) {
    $username = $_COOKIE['usercookie'];
    $loginqry = mysqli_query( $config, "SELECT * FROM shopusers WHERE username='$username' " );
    if ( mysqli_num_rows( $loginqry )>0 ) {
        $usrrow = mysqli_fetch_assoc( $loginqry );
        $status = $usrrow['status'];
        if ( $status == 'Active' ) {
            session_start();
            $_SESSION['userid'] = $usrrow['id'];
            $_SESSION['fullnames'] = $usrrow['fullnames'];
            $_SESSION['phonenumber'] = $usrrow['phonenumber'];
            $_SESSION['emailaddress'] = $usrrow['emailaddress'];
            $_SESSION['user'] = $usrrow['username'];
            setcookie( 'usercookie', $username, time() + ( 10 * 365 * 24 * 60 * 60 ) );
            header( 'location:index.php' );
        } else {
            $info = '<div class="error"><img src="images/error.png" width="20" height="20" align="left"> Your account is '.$status.'! Please contact your administrator';
        }

    } else {
        $info = '<div class="error"><img src="images/error.png" width="20" height="20" align="left"> Your user details do not exist!';
    }
}
if ( isset( $_POST['login'] ) ) {
    $username = addslashes( $_POST['username'] );
    $password = addslashes( $_POST['password'] );
    if ( empty( $username ) ) {
        $info = '<div class="error"><img src="images/error.png" width="20" height="20" align="left"> Enter your username!';
    } elseif ( empty( $password ) ) {
        $info = '<div class="error"><img src="images/error.png" width="20" height="20" align="left"> Enter your password!';
    } else {
        $outletname = $_COOKIE['outlet'];
        $password = md5( $password, false );
        $loginqry = mysqli_query( $config, "SELECT * FROM shopusers WHERE username='$username' AND pwd='$password'" );
        if ( mysqli_num_rows( $loginqry )>0 ) {
            $usrrow = mysqli_fetch_assoc( $loginqry );
            $status = $usrrow['status'];
            $outletname = $usrrow['shop'];
            if ( $status == 'Active' ) {
                session_start();
                $_SESSION['userid'] = $usrrow['id'];
                $_SESSION['fullnames'] = $usrrow['fullnames'];
                $_SESSION['phonenumber'] = $usrrow['phonenumber'];
                $_SESSION['emailaddress'] = $usrrow['emailaddress'];
                $_SESSION['user'] = $usrrow['username'];
                setcookie( 'usercookie', $username, time() + ( 10 * 365 * 24 * 60 * 60 ) );
                setcookie( 'outlet', $outletname, time() + ( 10 * 365 * 24 * 60 * 60 ) );
                header( 'location:index.php' );
            } else {
                $info = '<div class="error"><img src="images/error.png" width="20" height="20" align="left"> Your account is '.$status.'! Please contact your administrator';
            }
        } else {
            $info = '<div class="error"><img src="images/error.png" width="20" height="20" align="left"> Wrong user credentials! Please try again';
        }
    }
}
?>
<div width = '100%' style = 'margin-top: 150px;'>
<table><tr><td align = 'center'><img src = 'images/myshopapp.png' width = '160' height = '120'></td></tr>
<tr><td>
<form method = 'post'>
<table style = 'border-collapse:collapse; border:0px solid pink;'><tr><td>&nbsp;
</td></tr>
<tr><td><input type = 'text' name = 'username' placeholder = 'Enter your username' style = 'border:none; border-bottom:1px solid pink;'></td></tr>
<tr><td><input type = 'password' name = 'password' placeholder = 'Enter your password' style = 'border:none; border-bottom:1px solid pink;'></td></tr>
<tr><td><input type = 'submit' name = 'login' value = 'Login'></td></tr>
<tr><td><a href="recover.php">Forgot password?</a></td></tr>
<tr><td align = 'left'><?php echo $info ?></td></tr>
</table>
</form>
</td></tr>
</table>
</div>
<?php
include 'styles.html';
?>