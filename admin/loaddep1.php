<?php
include '../dbconnection.php';
$q=$_GET['q'];
$sel_d=mysqli_query($dbcon,"select * from dep_data where cid='$q'");
if(mysqli_num_rows($sel_d)>0)
{
    ?>
<select name="dep" id="dep" class="form-control" required="required">
    <option value="">Choose Department</option>
<?php
    while($rd=mysqli_fetch_row($sel_d))
    {
        ?>
    <option value="<?php echo $rd[0] ?>"><?php echo $rd[2] ?></option>
    <?php
    }
    ?>
</select>
    <?php
}
else
{
    ?>
<select name="dep" class="form-control">
    <option value="0">Choose Department</option>
</select>
<?php
}
?>