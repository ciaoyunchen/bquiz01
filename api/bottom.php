<?php
include_once "../connect.php";

$bottom=find("bottom",1);
$bottom['bottom']=$_POST['bottom'];


save("bottom",$bottom);
to("../admin.php?do=bottom");


?>