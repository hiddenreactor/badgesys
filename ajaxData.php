<?php 
// Include the database config file 
require_once('includes/connection.php');
 
if(!empty($_POST["SectionID"])){ 
    // Fetch state data based on the specific country 
    $query = "SELECT * FROM members WHERE SectionID = ".$_POST['SectionID']." AND status = 1 ORDER BY SectionID ASC"; 
    $result = $con->query($query); 
     
    // Generate HTML of state options list 
    if($result->num_rows > 0){ 
        echo '<option value="">Select Member</option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['MemberID'].'">'.$row['MemberName'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">State not available</option>'; 
    } 
}elseif(!empty($_POST["MemberID"])){ 
    // Fetch city data based on the specific state 
    $query = "SELECT * FROM cities WHERE MemberID = ".$_POST['state_id']." AND status = 1 ORDER BY city_name ASC"; 
    $result = $db->query($query); 
     
    // Generate HTML of city options list 
    if($result->num_rows > 0){ 
        echo '<option value="">Select city</option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">City not available</option>'; 
    } 
} 
?>