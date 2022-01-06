<?php
session_start();
session_destroy();
setcookie( 'usercookie', $username, -3600 );
setcookie( 'outlet', $outletname, -3600 );
header( 'location:index.php' );
?>