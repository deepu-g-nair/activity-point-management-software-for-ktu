<?php
include '../dbconnection.php';
$id=$_GET['id'];
$val=$_GET['val'];
$up=mysqli_query($dbcon,"update subcat_mrk set mrk='$val' where id='$id'");
?>