<?php
include 'config.php';
if(isset($_POST['recover'])){
$phonenumber=addslashes($_POST['phonenumber']);
$recqry=mysqli_query($config,"SELECT * FROM shopusers WHERE phonenumber='$phonenumber'");
if(mysqli_num_rows($recqry)>0){
    $recrow=mysqli_fetch_assoc($recqry);
    $fullnames=$recrow['fullnames'];
    $permitted_chars = '0123456789';
        $randomstring= substr(str_shuffle($permitted_chars), 0, 4).'';
        $password=md5($randomstring,false);
    $reset=mysqli_query($config,"UPDATE shopusers SET pwd='$password' WHERE phonenumber='$phonenumber'");
    if($reset){
        $sms='Dear '.$fullnames.', Your new password for MyShop App is: '.addslashes($randomstring).'. Thank you.';
        $chars=strlen($phonenumber);
                    if($chars=10){
                        $newnumber=ltrim($phonenumber,'0');
                        $phonenumber='254'.$newnumber;
                    }
                    $sms=urlencode($sms);
                    $url='http://sms.macrasystems.com/sendsms/index.php?username=Melangine&senderid=MDL&phonenumber='.$phonenumber.'&message='.$sms.'';
                        file_get_contents($url);
                    //end of new sms api
                    $message=urldecode($sms);
                    $info='<div class="success"><img src="images/success.png" width="20" height="20" >Success! Your password has been sent to your phone..</div>';
    }else{
        $info='<div class="err"><img src="images/error.png" width="20" height="20" >Error! Your password was not reset! Please try again later or contact our customer care.</div>';
    }
}else{
    $info='<div class="err"><img src="images/error.png" width="20" height="20" align="left"> The phone number you entered does not exist in the user register!</div>';
}
}
?>
<div width = '100%' style = 'margin-top: 150px;'>
<table><tr><td align = 'center'><img src = 'images/myshopapp.png' width = '160' height = '120'></td></tr>
<tr><td>
<form method = 'post'>
<table style = 'border-collapse:collapse; border:0px solid pink;'><tr><td>&nbsp;
</td></tr>
<tr><td><input type = 'text' name = 'phonenumber' placeholder = 'Enter your phone number' required='required' style = 'border:none; border-bottom:1px solid pink;'></td></tr>
<tr><td><input type = 'submit' name = 'recover' value = 'Recover'></td></tr>
<tr><td align = 'left'><?php echo $info ?></td></tr>
</table>
</form>
</td></tr>
</table>
</div>
<?php
include 'styles.html';
?>