<?php
include 'headers.php';
$category=$_GET['category'];
?>
<table><tr><td>
<div style = 'margin-top:150px;'>
<img src = 'images/success.png' width = '20' height = '20'>Sale was successful.<br>
<a href = 'sellitems.php?category='.$category><button style = 'background-color: orange; width:50%; padding:8px; border-radius:3px;'>Done</button></a></div>
</td></tr></table>