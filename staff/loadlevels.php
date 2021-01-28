<?php
include '../dbconnection.php';
$q=$_GET['q'];
$sel=mysqli_query($dbcon,"select * from sublevel_settings where lid='$q'");
if(mysqli_num_rows($sel)>0)
{$i=0;
    while($r=mysqli_fetch_row($sel))
    {
        $i++;
        echo "<b>".$r[2]."</b> ($r[3])<br />";
        ?>
<input type="hidden" name="n<?php echo $i ?>" value="<?php echo $r[0] ?>" class="form-control" />
<input type="text" name="m<?php echo $i ?>" class="form-control" placeholder="Normal Mark " required="reqired" />
<?php
    }
    ?>
<input type="hidden" name="count" value="<?php echo $i ?>" />
<?php
}
else{
    echo"No data Found";
}
?>