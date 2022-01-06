<?php
include '../config.php';
if(isset($_COOKIE['admincookie'])){
    $cookiemail=$_COOKIE['admincookie'];
    $loginqry=mysqli_query($config,"SELECT * FROM adminusers WHERE emailaddress'$cookiemail'");
    if(@mysqli_num_rows($loginqry)>0){
        $loginrow=mysqli_fetch_assoc($loginqry);
        session_start();
        $_SESSION['admin']=$loginrow['names'];
        header('location:index.php');
    }
}
if ( isset( $_POST['login'] ) ) {
    $emailaddress = addslashes( $_POST['emailaddress'] );
    $password = addslashes( $_POST['password'] );
    if ( empty( $emailaddress ) ) {
        $info = '<div class="error" align="left"><img src="../images/error.png" width="20" height="20" align="left"> You must enter your email address!';
    } elseif ( empty( $password ) ) {
        $info = '<div class="error" align="left"><img src="../images/error.png" width="20" height="20" align="left"> You must enter your password!';
    } else {
        $password = md5( $password, false );
        $loginqry = mysqli_query( $config, "SELECT * FROM adminusers  WHERE emailaddress='$emailaddress' AND password='$password'" );
        if ( mysqli_num_rows( $loginqry )>0 ) {
            session_start();
            $row = mysqli_fetch_assoc( $loginqry );
            $_SESSION['admin'] = $row['names'];
            setcookie( 'admincookie', $emailaddress, time() + ( 10 * 365 * 24 * 60 * 60 ) );
            header( 'location:index.php' );
        } else {
            $info = '<div class="error" align="left"><img src="../images/error.png" width="20" height="20" align="left"> Wrong email address and password!';
        }
    }
}
?>
<table style = 'margin-top: 150px;'><tr><td>
<img src = '../images/myshopapp.png' width = '150' height = '150'>
<form method = 'post'>
<input type = 'email' name = 'emailaddress' placeholder = 'Enter your email address'>
<input type = 'password' name = 'password' placeholder = 'Enter your password'>
<input type = 'submit' name = 'login' value = 'Login'>
<a href = 'recover.php'>Forgot your password?</a>
</form>
<?php echo $info ?>
</td></tr></table>
<?php include '../styles.html' ?>