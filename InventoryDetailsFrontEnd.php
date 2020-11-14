<meta http-equiv="refresh" content="1800;url=logout.php" />
<?php
// require_once('includes/connection.php');

require_once('includes/header.php');

$connect = new PDO("mysql:host=us-cdbr-iron-east-01.cleardb.net; dbname=heroku_c1c6c2ef5faa08f;", "b8a2927a50099e", "8036e8df");
$query = "SELECT DISTINCT BadgeName FROM (inventorys INNER JOIN badges ON inventorys.BadgeID = badges.BadgeID)";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchALL();

// $query = "SELECT DISTINCT SectionName FROM (members INNER JOIN sections ON members.SectionID = sections.SectionID)";
   
    if (isset($_SESSION['admin'])) {        
        // echo "Admin ID: ";
        // echo $_SESSION['admin'];
        // if (isset($_SESSION['admin'])) {
//     // $_SESSION['GET'] = $GetID = $_GET['success'];
//     $query = "SELECT * FROM sections ORDER BY SectionID ASC";
//     $statement = $connect->prepare($query);
//     $statement->execute();
//     $result = $statement->fetchALL();
        // }

      ?>

 
<style>

button.dt-button,
div.dt-button,
a.dt-button {
  font-size: 0.7em;
}
/* div.dataTables_length {
max-width: 200px !important;
} */
div.dataTables_length select {
width: 80px !important;
}
</style> 
 
  <div class="container box">
 <?php require_once('includes/navbar.php'); ?>
   <h1 align="center">Badge Inventory Details</h1>
  
<br />
   <form method="post" id="inventory_form">
   <div class="table-responsive">
    <br />
    <div align="left">
    <div style="width=1200px"> 
      <div style="width:193px; float:left;">
        <select name="filter_badge" id="filter_badge" class="form-control required" style="width:190px">
                <option value="select_badge">Select Badge</option>
                <?php 
                   $query = "SELECT * FROM badges ORDER BY BadgeID ASC";
                   $statement = $connect->prepare($query);
                   $statement->execute();
                   $result = $statement->fetchALL();
                  foreach($result as $row)
                  {
                    echo '<option value="'.$row["BadgeID"].'">'.$row["BadgeName"].'</option>';
                  }
                ?>
        </select>
      </div>     
      <div style="float:left;">
        <button type="button" name="filter" id="filter" class="btn btn-outline-primary">Go</button>     
      </div>
      <div style="float:right;">
      <button type="button" class="btn btn-outline-success addInventory">Add Badge</button>
      </div>
    </div>    
      <div style="clear:both"></div>
   </div>
   
    <br />
    <div id="alert_message"></div>
    <table id="user_data" class="table table-bordered table-striped">
    <thead>
     <tr>
     <th width="0%">Inventory ID</th>
       <th width="10%">Category</th>
       <th width="15%">Badge</th>
       <th width="15%">Level</th>
       <th width="5%">Quantity</th>
       <th width="15%">Date Restock</th>
       <th width="8%">Action</th>
       <!-- <th width="8%" ></th> -->
       <p id="msg" style="display:none">Saved</p>
      </tr>
     </thead>
    </form>
    </table>
    
   </div>
  </div>
           


<?php
  require_once('includes/footer.php');
    } else {
    $Error = "Access Deny, your session is over.";
    echo '<div class = "alert alert-danger text-center">'.$Error.'</div>';

    // if($Error){
    //   unset($_SESSION['MemberID']);
    // }
}

?>
<?php
include('modal/updateinventoryemodal.php');
include('modal/addinventorymodal.php');
?>

<script type="text/javascript" language="javascript" >
$(function(){
  $('#Contact').inputmask("(999) 999-9999");
});          
</script>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){  
    fetch_data();
  function fetch_data(filter_badge = '')
  {
   var dataTable = $('#user_data').DataTable({
    processing : true,
    serverSide : true,
    order : [],
    ajax : {
     url:"BadgeDetailsFetch.php",
     type:"POST",
     data: {filter_badge:filter_badge}   
    },
    "lengthMenu": [[10,25,50,100,200,250,500, -1], [10,25,50,100,200,250,500, "All"]],
    "columnDefs":[
    {
      "targets":[0,6],
      "orderable":false
    },
    {
      "targets":[0],
      "visible": false
    }
    ]
   });
   
   $('#filter').click(function(){
   var filter_badge = $('#filter_badge').val();
   if(filter_badge != '')
   {
    $('#user_data').DataTable().destroy();
    fetch_data(filter_badge);
   }
   else
   {
    $('#user_data').DataTable().destroy();
    fetch_data();
   }
  });
  }
 });
</script>

<!-- //Activate Update Inventory Modal -->
<script type="text/javascript" language="javascript" >
$(document).on('click', '.update_badge', function(){  
      let badge_id = $(this).attr("id");  
      $.ajax({  
          url:"UpdateBadgeSingleFrontEnd.php",  
          method:"POST",  
          data:{badge_id:badge_id},  
          dataType:"json",  
          success:function(data){  
                $('#BadgeID').val(data.BadgeName);  
                $('#CategoryID').val(data.CategoryName);  
                $('#LevelID').val(data.Levels);  
                $('#Quantity').val(data.Quantity);   
                $('#RestockDate').val(data.RestockDate); 
                $('.modal-title').text("Update Inventory");
                $('#badge_id').val(badge_id);
                $('#action').val("Update");
                $('#operation').val("Update");
                $('#action').removeClass('btn btn-success').addClass('btn btn-danger'); 
                $('#UpdateInventoryModal').modal('show'); 
                $('#user_data').DataTable().ajax.reload(); 
          }  
      });  
}); 

$(document).on('submit', '#inventory_form', function(event){
event.preventDefault();
var badge_id = $(this).attr("id");
 $.ajax({
  url:"UpdateBadgeSingleBackEnd.php",
  method:'POST',
  data:new FormData(this),
  contentType:false,
  processData:false,
  beforeSend:function(){  
      $('#action').val("Updating..");  
  },
  success:function(data)
  {
   alert(data);
   $('#inventory_form')[0].reset();
   $('#UpdateInventoryModal').modal('hide');
   $('#user_data').DataTable().ajax.reload(); 
   location.reload();
  }
 });
});
</script>

<!-- //Activate Add Badge Modal -->
<script type="text/javascript" language="javascript" >
$('.addInventory').on('click',function(){
    $('#add_inventory_form').parsley();
    $('.modal-body').load('content.html',function(){
        $('#AddInventoryModals').modal({show:true});
        $('.modal-title').text("Add Inventory ");
        // $('#action').val("Update");
        $('#action').removeClass('btn btn-success').addClass('btn btn-warning');
    });
});

$('#add_inventory_form').on('submit', function(event){
    $('#add_inventory_form').parsley();
  event.preventDefault();
  if($('#add_inventory_form').parsley().isValid())
  {
   $.ajax({
    url:"addinventorybackend.php",
    method:"POST",
    data:$(this).serialize(),
    async:true,
    beforeSend:function(){
     $('#action').attr('disabled','disabled');
     $('#action').val('Submitting...');
    },
    success:function(data)
    {
    alert(data);    
    location.reload();
     $('#add_inventory_form')[0].reset();
     $('#add_inventory_form').parsley().reset();
     $('#AddInventoryModals').hide();
    }
   });
  }
 });
</script>




