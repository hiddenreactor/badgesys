<?php 
require_once('includes/connection.php');
require_once('includes/header.php');
require_once('includes/footer.php');
$query = "SELECT * FROM sections ORDER BY SectionID ASC";
// $query = "SELECT * FROM members, sections, colors WHERE
// members.SectionID=sections.SectionID AND
// members.ColorID=colors.ColorID ORDER BY MemberName
// ";
$result = mysqli_query($con, $query);
?>

<div class="container">
        <div class="row">
            <div class="col">
                <div class="card bg-dark text-white mt-5">
                    <h3 class="text-center py-3"> Member Summary </h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">          
                        <table id="members_data" class="table table-striped bg-light text-dark">
                          <thead>
                            <tr>
                            <th>
                              <select name="sections" id="sections" class="form-control">
                              <option value="">Select Section</option>
                              <?php 
                              while($row = mysqli_fetch_array($result))
                              {
                                echo '<option value="'.$row["SectionID"].'">'.$row["SectionName"].'</option>';
                              }
                              ?>
                              </select>
                            </th>       
                            <th>Member Name</th> 
                            <th>Color</th>
                            <th>Badge Name</th>
                            <th>Badge Level</th>
                            <th>Date Received</th>
                            </tr>
                          </thead>
                          </table>
                    
                <div>                
            </div>
        </div>
    </div>

    
  



<script type="text/javascript" language="javascript" >
$(document).ready(function(){
 
 load_data();

 function load_data(is_section)
 {
  var dataMember = $('#members_data').DataTable({
   "processing":true,
   "serverSide":true,
   "order":[],
   "ajax":{
    url:"DetailsBackEnd.php",
    type:"POST",
    data:{is_section:is_section}
   },
   "columnDefs":[
    {
     "targets":[0],
     "orderable":false,
    },
   ],
  });
 }

 $(document).on('change', '#sections', function(){
  var category = $(this).val();
  $('#members_data').DataTable().destroy();
  if(category != '')
  {
   load_data(category);
  }
  else
  {
   load_data();
  }
 });
});
</script>
