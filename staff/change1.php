<?php
include '../dbconnection.php';
$id=$_GET['id'];
$val=$_GET['val'];
$up=mysqli_query($dbcon,"update category_data set cat_nme='$val' where catid='$id'");
?>