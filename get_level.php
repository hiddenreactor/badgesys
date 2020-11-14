<?php
//fetch.php

 $connect = mysqli_connect("us-cdbr-iron-east-01.cleardb.net", "b8a2927a50099e", "8036e8df", "heroku_c1c6c2ef5faa08f");
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
