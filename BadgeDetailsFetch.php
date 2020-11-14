<?php
//fetch.php
$connect = mysqli_connect("us-cdbr-iron-east-01.cleardb.net", "b8a2927a50099e", "8036e8df", "heroku_c1c6c2ef5faa08f");
// $columns = array('InventoryID', 'BadgeName', 'CategoryName', 'Levels', 'Quantity', 'DateRestock');   //this has to match with the db
$columns = array('InventoryID', 'CategoryID', 'BadgeID', 'LevelID', 'Quantity', 'RestockDate');

// $query = "SELECT * FROM inventory ";

// $query = "SELECT * FROM ((( inventorys
// INNER JOIN badgedetail ON inventorys.InventoryID = badgedetail.BadgeDetailID)
// INNER JOIN category ON inventorys.CategoryID = category.CategoryID)
// INNER JOIN badgelevel ON inventorys.LevelID = badgelevel.LevelID)
// ";

$query = "SELECT * FROM (((inventorys
INNER JOIN badges ON inventorys.BadgeID = badges.BadgeID)
INNER JOIN category ON inventorys.CategoryID = category.CategoryID)
INNER JOIN badgelevel ON inventorys.LevelID = badgelevel.LevelID)
";

$query .= " WHERE ";
if(isset($_POST['filter_badge']) && $_POST['filter_badge'] != '' )
{
 $query .= "badges.BadgeID = '".$_POST["filter_badge"]."' AND ";
}
if(isset($_POST["search"]["value"]))
{
    $query .= '(badges.BadgeName LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR category.CategoryName LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR inventorys.Quantity LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR badgelevel.Levels LIKE "%'.$_POST["search"]["value"].'%") ';
}

// if(isset($_POST["search"]["value"]))
// {
//     $query .= '(badge LIKE "%'.$_POST["search"]["value"].'%" ';
//     $query .= 'OR category LIKE "%'.$_POST["search"]["value"].'%" ';
//     $query .= 'OR quantity LIKE "%'.$_POST["search"]["value"].'%" ';
//     $query .= 'OR level LIKE "%'.$_POST["search"]["value"].'%") ';
// }

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY InventoryID DESC ';
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
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["InventoryID"].'" data-column="InventoryID">' . $row["InventoryID"] . '</div>'; 
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["CategoryID"].'" data-column="CategoryID">' . $row["CategoryName"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["BadgeID"].'" data-column="BadgeID">' . $row["BadgeName"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["LevelID"].'" data-column="LevelID">' . $row["Levels"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["Quantity"].'" data-column="Quantity">' . $row["Quantity"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["RestockDate"].'" data-column="RestockDate">' . $row["RestockDate"] . '</div>';
    $sub_array[] = '<button type="button" name="update_badge" id="'.$row["InventoryID"].'" class="btn btn-info btn-xs update_badge">Update Badge</button>';
    // $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["InventoryID"].'">Delete Badge</button>';    
    $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM inventorys";
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

