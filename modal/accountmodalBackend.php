<?php

include_once('lib/access.php');
include_once('includes/config/connection.php');
// sleep(1);

if (isset($_POST["email"])) {
    $query = " SELECT * FROM members WHERE Email = '".$_POST["email"]."'";

    $statement = $connect->prepare($query);

    $statement->execute();

    $total_row = $statement->rowCount();

    if ($total_row == 0) {
        $output = array(
   'success' => true
  );

        echo json_encode($output);
    }
}

?>