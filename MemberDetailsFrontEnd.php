<?php

$connect = new PDO("mysql:host=localhost; dbname=scout;", "root", "");

$query = "SELECT * FROM sections ORDER BY SectionID ASC";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchALL();

// function fill_select_box($connect)
// { 
//  $output = '';
//  $query = "SELECT * FROM category ORDER BY CategoryName ASC";
//  $statement = $connect->prepare($query);
//  $statement->execute();
//  $result = $statement->fetchAll();
//  foreach($result as $row)
//  {
//   $output .= '<option value="'.$row["CategoryID"].'">'.$row["CategoryName"].'</option>';
//  }
//  return $output;
// }
?>
<html>
<head>
  <title>test</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
  <script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.js"></script> -->
  <script src="http://parsleyjs.org/dist/parsley.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.1/parsley.min.js"></script>

  <!-- <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>   -->
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" /> -->

  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script> 
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" />

  

  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" /> -->

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" />

  <!-- <link href="css/bootstrap-select.min.css" rel="stylesheet" />
  <script src="js/bootstrap-select.min.js"></script> -->
  
 
 </head>
 
<style>
  body
  {
   margin:0;
   padding:0;
   background-color:#f1f1f1;
  }
  .box
  {
   width:1200px;
   padding:20px;
   background-color:#fff;
   border:1px solid #ccc;
   border-radius:5px;
   margin-top:25px;
   box-sizing:border-box;
  }
  table.dataTable thead .none.sorting:after {
    display: none;
    input.parsley-success,
    select.parsley-success,
    textarea.parsley-success {
    color: #468847;
    background-color: #DFF0D8;
    border: 1px solid #D6E9C6;
 }


 input.parsley-success,
 select.parsley-success,
 textarea.parsley-success {
   color: #468847;
   background-color: #DFF0D8;
   border: 1px solid #D6E9C6;
 }

 input.parsley-error,
 select.parsley-error,
 textarea.parsley-error {
   color: #B94A48;
   background-color: #F2DEDE;
   border: 1px solid #EED3D7;
 }

 .parsley-errors-list {
   margin: 2px 0 3px;
   padding: 0;
   list-style-type: none;
   font-size: 0.9em;
   line-height: 0.9em;
   opacity: 0;

   transition: all .3s ease-in;
   -o-transition: all .3s ease-in;
   -moz-transition: all .3s ease-in;
   -webkit-transition: all .3s ease-in;
 }

 .parsley-errors-list.filled {
   opacity: 1;
 }
 
 .parsley-type, .parsley-required, .parsley-equalto{
  color:#ff0000;
 }

}

.btn-group-xs > .btn, .btn-xs {
  padding: .38rem .18rem;
  font-size: .875rem;
  line-height: .5;
  border-radius: .2rem;
  font-size:10px
}
</style>
 </head>
 
 <script type="text/javascript" language="javascript" >

$(function(){
  $('#Contact').inputmask("(999) 999-9999");
});
</script>

 <body>
  <div class="container box">
  <nav class="navbar navbar-expand-md navbar-dark bg-dark text-white mt-5">              
                        <div class="collapse navbar-collapse" id="navbarCollapse">
                            <div class="navbar-nav">
                                <a href="AddMemberFrontEnd.php" class="btn btn-lg btn-secondary mb-3 float-left">Index</a>  
                                <a href="MemberDetailsFrontEnd.php" class="nav-item nav-link">Member Record</a>
                                <a href="InventoryDetailsFrontEnd.php" class="nav-item nav-link active">Badge Status</a>
                            </div>
                        </div>
                    </nav>
   <h1 align="center">Member Details</h1>
   <br />
   <form method="post" id="insert_form_temp">
   <div class="table-responsive">
    <br />
   <div align="left">
    <div style="width=1200px"> 
      <div style="width:150px; float:left;">
      <select name="filter_section" id="filter_section" class="form-control required" style="width:150px">
                <option value="select_section">Sort By Section</option>
                <?php 
                  foreach($result as $row)
                  {
                    echo '<option value="'.$row["SectionID"].'">'.$row["SectionName"].'</option>';
                  }
                ?>
        </select>
      </div>     
      <div style="float:left;">
        <button type="button" name="filter" id="filter" class="btn btn-info">Go</button>       
      </div>
      <div style="float:right;">
        <!-- <button type="button" name="add" id="add" class="btn btn-success add">Add Member</button> -->
        <!-- <button type="button" id="" data-toggle="modal" data-target="#add_modal" class="btn btn-success btn-sm ">Add Member</button> -->
        <button type="button" class="btn btn-success addMember">Add Member</button>
        <!-- <button type="button" class="btn btn-danger addbadge">Add Badge</button> -->
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
       <th width="6%"></th>
       <p id="msg" style="display:none">Saved</p>
      </tr>
     </thead>
    </form>
    </table>
    
   </div>
  </div>
  
 </body>
</html>



<?php
include('modal/viewmodal.php');
include('modal/updatemodal.php');
include('modal/addmembermodal.php');
include('modal/addbadgemodal.php');
?>

<script type="text/javascript" language="javascript" >

$(document).on('click', '.addbadge', function(){  
      var user_id = $(this).attr("id");  
      $.ajax({  
          url:"addbadgefrontend.php",  
          method:"POST",  
          data:{user_id:user_id},  
          dataType:"json",  
          success:function(data){  
            response = true;
                $('#Member').val(data.MemberID); 
                $('#Section').val(data.SectionID);  
                $('#Color').val(data.ColorID);
                $('.modal-title').text("Add Badge");
                $('#user').val(user_id);
                $('#action').val("Addme");
                $('#operation').val("Addme");
                $('#action').removeClass('btn btn-success').addClass('btn btn-warning'); 
                $('#AddBadgeModal').modal('show'); 
                $('#user_data').DataTable().ajax.reload(); 
          }  
      });  
}); 

$(document).on('submit', '#add_badge_form', function(event){
  $('select').removeAttr('disabled');
event.preventDefault();
var user_id = $(this).attr("id");
 $.ajax({
  url:"addbadgebackend.php",
  method:'POST',
  data:new FormData(this),
  contentType:false,
  processData:false,
  beforeSend:function(){  
      $('#action').removeClass('btn btn-success').addClass('btn btn-warning');
      $('#action').val("Adding..");  
  },
  success:function(data)
  {
   alert(data);
   $('#add_badge_form')[0].reset();
   $('#AddBadgeModal').modal('hide');
   $('#user_data').DataTable().ajax.reload(); 
   location.reload();
  }
 });

});
</script>

<script>
  window.ParsleyValidator
    .addValidator('checkmember', function (value, requirement) {
        var response = false;

        $.ajax({
            url: "MemberDetailsBackEnd.php",
            data: {fname: value},
            dataType: 'json',
            type: 'post',
            async: false,
            success: function(data) {
                response = true;
            }
        });
        return response;
    }, 32)
    .addMessage('en', 'checkmember', 'The name already exist. Please enter different name or add middle name.');

    $("#fname").parsley({
    errorClass: 'is-invalid',
    successClass: 'is-valid',
    errorsWrapper: '<span class="invalid-feedback"></span>',
    errorTemplate: '<span></span>',
    trigger: 'change'

});
</script>


<script>

$('.addMember').on('click',function(){
    $('#validate_form').parsley();
    $('.modal-body').load('content.html',function(){
        $('#addMemberModal').modal({show:true});
        $('.modal-title').text("Add Member");
        // $('#action').val("Update");
        $('#action').removeClass('btn btn-success').addClass('btn btn-warning');
    });
});

$('#validate_form').on('submit', function(event){
    $('#validate_form').parsley();
  event.preventDefault();
  if($('#validate_form').parsley().isValid())
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
     $('#validate_form')[0].reset();
     $('#validate_form').parsley().reset();
     $('#addMemberModal').hide();
    }
   });
  }
 });
</script>

<script>

$(function(){
  $('#Contactme').inputmask("(999) 999-9999");
});
</script>

<script type="text/javascript" language="javascript" >

$(document).on('click', '.update_member', function(){  
      var user_id = $(this).attr("id");  
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

<script>
       
$(document).on('click', '.view_data', function(){  
      var user_id = $(this).attr("id");  
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

// $(document).on('click', '.add_data', function(){  
//       var user_id = $(this).attr("id");  
//       if(user_id != '')  
//       {  
//           $.ajax({  
//                 url:"ViewMemberBadgeFetchSingle.php",  
//                 method:"POST",  
//                 data:{user_id:user_id},  
//                 success:function(data){  
//                     $('#user_detail').html(data);  
//                     $('#viewmodal').modal('show');  
//                 }  
//           });  
//       }            
// });
      
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


 var count = 0;

$(document).on('click', '.add', function(){
  var count = 0;
  count++;
  var html = '';
  html += '<tr>';        
  html += '<td><select name="Category[]" class="form-control Category" data-badgeid="'+count+'"><option value="">Select Category</option><?php echo fill_select_box($connect); ?></select></td>';
  html += '<td><select name="Badge[]" class="form-control Badges" id="Badge'+count+'" ><option value="">Select Badge</option></select></td>';
  html += '<td><select name="Level[]" class="form-control Level" id="Level'+count+'"><option value="">Select Level</option></select></td>';        
  html += '<td><input type="text" name="Quantity[]" class="form-control Quantity" id="Quantity"></td>';  
  html += '<td style="width:9%; text-align:center"><input type="submit" name="submit" class="btn btn-success btn-sm glyphicon glyphicon-plus"value= "+"/ style="margin-top: 3px"></td>'; 
  html += '<td style="width:9%; text-align:center"><button type="button" name="remove" class="btn btn-danger btn-sm remove glyphicon glyphicon-minus"value= "-"/  style="margin-top: 3px"></button></td></tr>'; 
  // html += '<td><button type="button" name="remove" class="btn btn-danger btn-xs remove"><span class="glyphicon glyphicon-minus"></span></button></td>';
  $('tbody').append(html);
});
 
//remove row when add badge button clicked
$(document).on('click', '.remove', function(){
    $(this).closest('tr').remove();
  });

//Badge select box based on category
  $(document).on('change', '.Category', function(){
    var CategoryID = $(this).val();
    var badgeid = $(this).data('badgeid');
    
        $.ajax({
            type:'POST',
            url:'SelectBadge.php',
            data: "CategoryID="+CategoryID,
            dataType:"json",
            success:function(data){
              var html = '';
              var html = '<option value="">Select Badges</option>';
              for(var count = 0; count < data.length; count++)
              {
                html += '<option value="'+data[count].id+'">'+data[count].name+'</option>';
              }                  
              $('#Badge'+badgeid).html(html); 
                
            }
        });       
  });

//Level select box based on category
$(document).on('change', '.Category', function(){
    var CategoryID = $(this).val();
    var badgeid = $(this).data('badgeid');
    
        $.ajax({
            type:'POST',
            url:'SelectLevel.php',
            data: "CategoryID="+CategoryID,
            dataType:"json",
            success:function(data){
              var html = '';
              var html = '<option value="">Select Level</option>';
              for(var count = 0; count < data.length; count++)
              {
                html += '<option value="'+data[count].id+'">'+data[count].name+'</option>';
              }                  
              $('#Level'+badgeid).html(html); 
                
            }
        });       
});
    

 $('#insert_form_temp').on('submit', function(event){
event.preventDefault();
    var error = '';

    $('.Category').each(function(){
      var count = 1;

      if($(this).val() == '')
      {
        error += '<p>Select Item Category at '+count+' row</p>';
        return false;
      }

      count = count + 1;

    });

    $('.Badges').each(function(){
      var count = 1;

      if($(this).val() == '')
      {
        error += '<p>Select Badge at '+count+' row</p>';
        return false;
      }

      count = count + 1;

    });

    $('.Level').each(function(){

      var count = 1;

      if($(this).val() == '')
      {
        error += '<p>Select level '+count+' Row</p> ';
        return false;
      }

      count = count + 1;

    });

    $('.Quantity').each(function(){
      var count = 1;
      if($(this).val() == '')
      {
        error += '<p>Enter Quantity at '+count+' Row</p>';
        return false;
      }
      count = count + 1;
    });

    var form_data = $(this).serialize();

    if(error == '')
    {
      $.ajax({
        url:"AddInventoryInsert.php",
        method:"POST",
        data:form_data,
        success:function(data)
        {
          if(data == 'ok')
          {
            $('#user_data').find("tr:gt(0)").remove();
            $('#alert_message').html('<div class="alert alert-success">New Badge Inserted</div>');
            $('#alert_message').delay(2000).fadeOut('slow');
            $('#user_data').DataTable().ajax.reload(); 
          }
        }
      });
    }
    else
    {
      $('#error').html('<div class="alert alert-danger">'+error+'</div>');
    }

});

 
});

</script>

<script>
  window.ParsleyValidator
    .addValidator('username', function (value, requirement) {
        var response = false;

        $.ajax({
            url: "AdminBackEnd.php",
            data: {username: value},
            dataType: 'json',
            type: 'post',
            async: false,
            success: function(data) {
                response = true;
            }
        });
        return response;
    }, 32)
    .addMessage('en', 'username', 'The username already exists.');

    $("#username").parsley({
    errorClass: 'is-invalid',
    successClass: 'is-valid',
    errorsWrapper: '<span class="invalid-feedback"></span>',
    errorTemplate: '<span></span>',
    trigger: 'change'

});
</script>
