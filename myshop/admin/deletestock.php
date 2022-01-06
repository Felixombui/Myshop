<?php
include 'headers.php';
$id=$_GET['id'];
$stckqry=mysqli_query($config,"SELECT * FROM stock WHERE id='$id'");
$stckrow=mysqli_fetch_assoc($stckqry);
$item=$stckrow['item'];
$outletname=$stckrow['outletname'];
$itmqry=mysqli_query($config,"SELECT * FROM stock WHERE item='$item' AND id>'$id' AND outletname='$outletname'");
if(mysqli_num_rows($itmqry)>0){
    $msg='<table><tr><td><img src="../images/error.png" width="40" height="40"><br>The stock you are trying to remove already has transactions after it! Please contact administrator.</td></tr>
    <tr><td><a href="stocks.php"><input type="submit" name="back" value="Go Back"></td></tr></table>';
}else{
    $msg='<table><tr><td>Are you sure you want to remove this transaction? This action is irreversible.</td></tr>
    <tr><td>
    <form method="post">
    <table><tr><td><input type="submit" name="yes" Value="Yes"></td><td><input type="submit" name="no" value="No"></td></tr></table>
    </form>
    </td></tr></table>';
}

if(isset($_POST['yes'])){
    if(mysqli_query($config,"DELETE FROM stock WHERE id='$id'")){
        $msg='<table><tr><td><img src="../images/success.png" width="40" height="40"><br>Stock value has been removed successfully.</td></tr>
        <tr><td><a href="stocks.php"><input type="submit" name="ok" value="Ok"></td></tr></table>';
    }
}elseif(isset($_POST['no'])){
    header('location:stocks.php');
}
echo $msg;
?>


<?php include '../styles.html' ?>