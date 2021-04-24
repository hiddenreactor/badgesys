<?php
//fetch.php

 $connect = mysqli_connect('us-cdbr-east-03.cleardb.com','b9cd122ae5026e','287b0048','heroku_d1dabaaefc9d538');
 $output ='';

$sql = "SELECT * FROM badgelevel WHERE CategoryID='".$_POST["CategoryID"]."' ";
$result = mysqli_query($connect, $sql);
$output = '<option value = "">Select Level</option>';
while($row = mysqli_fetch_array($result))
{
    $output .='<option value="'.$row["LevelID"].'">'.$row["Levels"].'</option>';
}
    echo $output;
?>
