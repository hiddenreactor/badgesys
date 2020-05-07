<?php
//fetch.php
require_once('includes/connection.php');
$column = array("sections.SectionName", "members.MemberName", "colors.Color",  "badges.BadgeName", "earned.Level", "earned.DateReceived");
// $query = "
//  SELECT * FROM members
//  INNER JOIN sections 
//  ON sections.SectionID = members.SectionID 
// ";
// $query = "
//  SELECT * FROM ((((earned
//  INNER JOIN members ON earned.MemberID = members.MemberID)
//  INNER JOIN sections ON earned.SectionID = sections.SectionID)
//  INNER JOIN colors ON earned.ColorID = colors.ColorID)
//  INNER JOIN badges ON earned.BadgeID = badges.BadgeID
//  )
// ";
$query = "
 SELECT * FROM ((((earned
 INNER JOIN members ON earned.MemberID = members.MemberID)
 INNER JOIN sections ON earned.SectionID = sections.SectionID)
 INNER JOIN colors ON earned.ColorID = colors.ColorID)
 INNER JOIN badges ON earned.BadgeID = badges.BadgeID
 )
";
$query .= " WHERE ";
if(isset($_POST["is_section"]))
{
 $query .= "earned.SectionID = '".$_POST["is_section"]."' AND ";
}
if(isset($_POST["search"]["value"]))
{
 $query .= '(sections.SectionName LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR members.MemberName LIKE "%'.$_POST["search"]["value"].'%" '; 
 $query .= 'OR colors.Color LIKE "%'.$_POST["search"]["value"].'%" '; 
 $query .= 'OR badges.BadgeName LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR earned.Level LIKE "%'.$_POST["search"]["value"].'%") ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY members.MemberID DESC ';
}

$query1 = '';

if($_POST["length"] != 1)
{
 $query1 .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($con, $query));

$result = mysqli_query($con, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = $row["SectionName"];
 $sub_array[] = $row["MemberName"];  
 $sub_array[] = $row["Color"];
 $sub_array[] = $row["BadgeName"];
 $sub_array[] = $row["Level"];
 $sub_array[] = $row["DateReceived"];
 $data[] = $sub_array;
}

function get_all_data($con)
{
 $query = "SELECT * FROM earned";
 $result = mysqli_query($con, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($con),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>
