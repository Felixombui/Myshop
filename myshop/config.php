<?php
$server = 'localhost';
$dbuser = 'macrasystems';
$dbpass = 'kasarani';
$dbase = 'onlineshop';
$config = mysqli_connect( $server, $dbuser, $dbpass, $dbase ) or die( 'Could not connect to backend! Contact administrator.' );
$config2 = mysqli_connect( $server, $dbuser, $dbpass, 'macrasys_mdl' ) or die( 'Could not connect to backend! Contact administrator.' );
?>