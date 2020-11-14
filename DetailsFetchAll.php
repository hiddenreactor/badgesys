<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "scout");
$columns = array('MemberID', 'MemberName', 'Color', 'Email', 'Contact');   //this has to match with the db

// $query = "SELECT * FROM inventory ";

$query = "SELECT * FROM (( members
INNER JOIN colors ON members.ColorID = colors.ColorID)
INNER JOIN sections ON members.SectionID = sections.SectionID)
";

$query .= " WHERE ";
if(isset($_POST['filter_section']) && $_POST['filter_section'] != '' )
{
 $query .= "SectionName = '".$_POST["filter_section"]."' AND ";
}
if(isset($_POST["search"]["value"]))
{
    $query .= '(members.MemberName LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR colors.Color LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR members.Email LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR members.Contact LIKE "%'.$_POST["search"]["value"].'%") ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY MemberID ASC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
    $sub_array = array();
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["MemberID"].'" data-column="MemberID">' . $row["MemberID"] . '</div>'; 
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["MemberName"].'" data-column="MemberName">' . $row["MemberName"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["SectionName"].'" data-column="SectionName">' . $row["SectionName"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["Email"].'" data-column="Email">' . $row["Email"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["Contact"].'" data-column="Contact">' . $row["Contact"] . '</div>';
    // $sub_array[] = '<button type="button" name="update" class="btn btn-warning btn-xs update" id="'.$row["MemberID"].'">View Badge Details</button>';
    $sub_array[] = '<a href="DetailsFetchSingle.php?success='.$row["MemberID"].'" class="btn btn-warning btn-xs view">View Badge Details</a>';
    // $sub_array[] = '<button type="button" name="earnedbadge" class="btn btn-primary btn-xs view" id="'.$row["MemberID"].'">View Badge Details</button>';
    $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM members";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>

