<?php
include 'headers.php';
if ( isset( $_POST['send'] ) ) {
    $message = addslashes( $_POST['message'] );
    if ( empty( $message ) ) {
        $info = '<div class="error"><img src="images/error.png" width="20" height="20" align="left">Type a message!';
    } else {
        $fullnames = $_SESSION['fullnames'];
        $phonenumber = $_SESSION['phonenumber'];
        $outlet = $_COOKIE['outlet'];
        $to = 'mandela@macrasystems.com';
        $headers = 'From:info@melanginedairies.co.ke';
        $fullmessage = urlencode( 'From: '.$fullnames.' of '.$outlet.' Phone: '.$phonenumber.'. '.$message );
        @mail( $to, 'Contact from MyShop App', 'From '.$fullnames.' Outlet: '.$outlet.' Phone Number: '.$phonenumber.' Message: '.$message, $headers );
        //create notification sms
        $url = 'https://sms.macrasystems.com/sendsms/index.php?username=Melangine&senderid=MDL&phonenumber=254708138498&message='.$fullmessage;
        file_get_contents( $url );
        $info = '<div class="success"><img src="images/success.png" width="20" height="20" align="left">Your message has been sent successfully.';
    }
}
?>
<table><tr><td>
Incase of an issue with myshop app, please write us
<form method = 'post'>
<table>
<tr><td><input type = 'text' name = 'names' value = "<?php echo $_SESSION['fullnames'] ?>" readonly></td></tr>
<tr><td><input type = 'text' name = 'outlet' value = "<?php echo $_COOKIE['outlet'] ?>" readonly></td></tr>
<tr><td><input type = 'text' name = 'phonenumber' value = "<?php echo $_SESSION['phonenumber'] ?>" readonly></td></tr>
<tr><td><textarea name = 'message' placeholder = 'Type your message here...' style = 'width: 100%;' rows = '8'></textarea></td></tr>
<tr><td><input type = 'submit' name = 'send' value = 'Send'></td></tr>
<tr><td align = 'left'><?php echo $info ?></td></tr>
</table>
</form>
</td></tr></table>
<?php include 'styles.html' ?>