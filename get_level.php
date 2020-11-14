<?php
//fetch.php

 $connect = mysqli_connect("localhost", "root", "", "scout");
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