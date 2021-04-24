<meta http-equiv="refresh" content="1800;url=logout.php" />
<?php

require_once('includes/header.php');

$connect = new PDO("mysql:host=us-cdbr-east-03.cleardb.com; dbname=heroku_d1dabaaefc9d538;", "b9cd122ae5026e", "287b0048");
   
    if (isset($_SESSION['admin'])) {
        $_SESSION['GET'] = $GetID = $_GET['success'];
        // echo "Admin ID: ";
        // echo $_SESSION['admin'];
        // echo " Session Get: ";
        // echo $_SESSION['GET'];
        // echo " GetID: ";
        // echo $GetID;
        if ($_SESSION['admin'] == $_SESSION['GET']) {
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
   <h1 align="center">Member Details</h1>
<br />
   <form method="post" id="insert_form_temp">
   <div class="table-responsive">
    <br />
   <div align="left">
    <div style="width=1200px"> 
      <div style="width:163px; float:left;">
      <select name="filter_section" id="filter_section" class="form-control required" style="width:160px">
                <option value="select_section">Sort By Section</option>
                <?php
                
        $query = "SELECT * FROM sections ORDER BY SectionID ASC";
            $statement = $connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchALL();
            foreach ($result as $row) {
                echo '<option value="'.$row["SectionName"].'">'.$row["SectionName"].'</option>';
            } ?>
        </select>
      </div>   
      <div style="float:left;">
        <button type="button" name="filter" id="filter" class="btn btn-outline-info">Go</button>       
      </div>
      <div style="float:right;">
        <!-- <button type="button" name="add" id="add" class="btn btn-success add">Add Member</button> -->
        <button type="button" class="btn btn-outline-success addMember">Add Member</button>
      </div>
    </div>    
      <div style="clear:both"></div>
   </div>
   
    <br />
    <div id="alert_message"></div>
    <table id="user_data" class="table table-bordered table-striped">
    <thead>
     <tr>
       <th width="0%">Member ID</th>
       <th width="13%">Member Name</th>
       <th width="10%">Current Color</th>
       <th width="15%">Member Email</th>
       <th width="12%">Member Contact</th>       
       <th width="8%" style="border-right:none;">Action</th>
       <th width="8%" style="border-right:none;"></th>
       <th width="8%"></th>
       <p id="msg" style="display:none">Saved</p>
      </tr>
     </thead>
    </form>
    </table>
    
   </div>
  </div>
  
<?php
include('modal/viewmodal.php');
include('modal/updatemodal.php');
include('modal/addmembermodal.php');
include('modal/earnedbadgemodal.php'); 
require_once('includes/footer.php');
        }
        else
        {
            $Error = "Invalid Access Detected, your session is over.";
            echo '<div class = "alert alert-danger text-center">'.$Error.'</div>';
            session_unset();
            session_destroy();
            header( "refresh:2;url=index.php" );
        }
    
    
      } 

?>  

<script type="text/javascript" language="javascript" >
$(function(){
  $('#Contact').inputmask("(999) 999-9999");
});          
</script>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){  
fetch_data();
  function fetch_data(filter_section = '')
  {
   var dataTable = $('#user_data').DataTable({
    processing : true,
    serverSide : true,
    order : [],
    ajax : {
     url:"MemberDetailsFetch.php",
     type:"POST",
     data: {filter_section:filter_section}   
    },
//     dom: 'lBfrtip', 
//     buttons: [   
//   {
//         extend:    'excelHtml5',
//         text:      'Excel',
//         className: 'btn btn-primary',
//         title: 'Member Badge Summary',
//         // titleAttr: 'Export all rows to Excel file',
//     },
//     {
//         extend:    'csvHtml5',
//         text:      'CSV',
//         className: 'btn btn-primary',
//         title: 'Member Badge Summary',
//         // titleAttr: 'Export all rows to Excel file',
//     },
//     {
//         extend:    'pdfHtml5',
//         text:      'PDF',
//         className: 'btn btn-primary',
//         // orientation: 'landscape',
//         title: 'Member Badge Summary',
//         titleAttr: 'Export all rows to PDF file',
//         pageSize: 'LEGAL'

//     },
//     {
//         extend:    'copyHtml5',
//         text:      'Copy Data',
//         className: 'btn btn-primary',
//         // titleAttr: 'Copy all rows to clipboard',
//     },
//     {
//         extend:    'print',
//         text:      'Print Data',
//         className: 'btn btn-primary',
//         title: 'Member Badge Summary'
//         // titleAttr: 'Copy all rows to clipboard',
//     },
// ],
    "lengthMenu": [[10,25,50,100,200,250,500, -1], [10,25,50,100,200,250,500, "All"]],
    "columnDefs":[
    {
      "targets":[0,5,6,7],
      "orderable":false
    },
    {
      "targets":[0],
      "visible": false
    }
    ]
   });
   
   $('#filter').click(function(){
   var filter_section = $('#filter_section').val();
   if(filter_section != '')
   {
    $('#user_data').DataTable().destroy();
    fetch_data(filter_section);
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

<!-- //activate View Badge Modal -->
<script type="text/javascript" language="javascript" >       
$(document).on('click', '.view_data', function(){    
  event.preventDefault(); 
      let user_id = $(this).attr("id"); 
      if(user_id != '')  
      {        
          $.ajax({  
                url:"ViewMemberBadgeFetchSingle.php",  
                method:"POST",  
                data:{user_id:user_id}, 
                success:function(data){  
                    $('#user_detail').html(data);  
                    $('#viewmodal').modal('show');  
                }  
          });  
      }            
});
</script>

<!-- //activate earned Badge Modal -->
<script type="text/javascript" language="javascript" >
$(document).on('click', '.earnedbadge', function(){  
  event.preventDefault();
      let user_id = $(this).attr("id"); 
      $.ajax({  
          url:"earnedbadgefrontend.php",  
          method:"POST",  
          data:{user_id:user_id},  
          dataType:"json",  
          success:function(data){  
            response = true;
                $('#Member').val(data.MemberID); 
                $('#MemberName').val(data.MemberName); 
                $('#CategoryID').val(data.CategoryID); 
                $('#Section').val(data.SectionID);  
                $('#Color').val(data.ColorID);
                $('#user').val(user_id);
                $('.modal-title').text("Earned Badge");
                $('#actions').val("Earned_Badge");
                $('#operations').val("Earned_Badge");
                $('#action').removeClass('btn btn-success').addClass('btn btn-warning'); 
                $('#EarnedBadgeModal').modal('show'); 
                $('#user_data').DataTable().ajax.reload(); 
          }  
      });  
}); 

$(document).on('submit', '#earned_badge_form', function(event){  
event.preventDefault();
$('select').removeAttr('disabled');
var user_id = $(this).attr("id");
 $.ajax({
  url:"earnedbadgebackend.php",
  method:'POST',
  data:new FormData(this),
  contentType:false,
  processData:false,
  beforeSend:function(){  
      $('#actions').val("Earning..");  
  },
  success:function(data)
  {
   alert(data);
   $('#earned_badge_form')[0].reset();
   $('#EarnedBadgeModal').modal('hide');
   $('#user_data').DataTable().ajax.reload(); 
   window.location.reload();
  }
 });

});
</script>

<!-- //Activate Update Modal -->
<script type="text/javascript" language="javascript" >
$(document).on('click', '.update_member', function(){ 
      $('#update_form').parsley();  
      let user_id = $(this).attr("id");  
      $.ajax({  
          url:"UpdateMemberSingleFrontEnd.php",  
          method:"POST",  
          data:{user_id:user_id},  
          dataType:"json",  
          success:function(data){  
                $('#updatemember').val(data.MemberName);  
                $('#SectionID').val(data.SectionID);  
                $('#ColorID').val(data.ColorID);  
                $('#Contact').val(data.Contact);  
                $('#updateemail').val(data.Email);  
                $('#Date').val(data.Date);  
                $('.modal-title').text("Update Member");
                $('#user_id').val(user_id);
                $('#action').val("Update");
                $('#operation').val("Update");
                $('#action').removeClass('btn btn-success').addClass('btn btn-danger'); 
                $('#UpdateModal').modal('show'); 
                $('#user_data').DataTable().ajax.reload(); 
          }  
      });  
}); 

$(document).on('submit', '#update_form', function(event){
  $('#update_form').parsley(); 
event.preventDefault();
var user_id = $(this).attr("id");
 $.ajax({
  url:"UpdateMemberSingleBackEnd.php",
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
   $('#update_form')[0].reset();
   $('#UpdateModal').modal('hide');
   $('#user_data').DataTable().ajax.reload(); 
   location.reload();
  }
 });
});
</script>

<!-- //Activate Add Member Modal -->
<script type="text/javascript" language="javascript" >
$('.addMember').on('click',function(){
    $('#member_form').parsley();
    $('.modal-body').load('content.html',function(){
        $('#addMemberModal').modal({show:true});
        $('.modal-title').text("Add Member");
        // $('#action').val("Update");
        $('#action').removeClass('btn btn-success').addClass('btn btn-warning');
    });
});

$('#member_form').on('submit', function(event){
    $('#member_form').parsley();
  event.preventDefault();
  if($('#member_form').parsley().isValid())
  {
   $.ajax({
    url:"MemberDetailsBackEnd.php",
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
     $('#member_form')[0].reset();
     $('#member_form').parsley().reset();
     $('#addMemberModal').hide();
    }
   });
  }
 });
</script>

<script>

$(function(){
  $('#Contact').inputmask("(999) 999-9999");
});
</script>



