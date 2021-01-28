<?php
include '../dbconnection.php';
$id=$_GET['id'];
$val=$_GET['val'];
$up=mysqli_query($dbcon,"update subcategory_data set subcatnme='$val' where subid='$id'");
?>