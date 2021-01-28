<?php
include '../dbconnection.php';
$q=$_GET['q'];
$sel_stf=mysqli_query($dbcon,"select * from staff_data where nme like '%$q%'");
if(mysqli_num_rows($sel_stf)>0)
{
    ?>
<table class="table table-bordered table-condensed table-hover table-responsive table-striped">
<tr>
    <td>#</td>
    <td>Name</td>
    <td>Contact Info.</td>
    <td></td>
</tr>
<?php
$i=0;
while($rst=mysqli_fetch_row($sel_stf))
{
    $i++;
    ?>
<tr>
    <td><?php echo $i ?></td>
    <td><?php echo $rst[1] ?><br /><b><?php echo strtoupper($rst[2]) ?></b></td>
    <td><?php echo $rst[3] ?><br /><?php echo $rst[4] ?></td>
    <td style="width: 8%;"><a href="tel:<?php echo $rst[4] ?>"><img src="../logo/call.png" alt="call" class="img img-responsive" /></a></td>
</tr>
<?php
}
?>
</table>
<?php
}
else{
    ?>
<table class="table table-bordered table-condensed table-hover table-responsive table-striped">
<tr>
    <td>#</td>
    <td>Name</td>
    <td>Contact Info.</td>
    <td></td>
</tr>
<tr>
    <td colspan="4">No Data Found</td>
</tr>
</table>
<?php
}
?>