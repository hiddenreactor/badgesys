<meta http-equiv="refresh" content="1800;url=logout.php" />
<?php
// require_once('includes/connection.php');

require_once('includes/header.php');
$connect = new PDO('us-cdbr-iron-east-01.cleardb.net','b8a2927a50099e','8036e8df','heroku_c1c6c2ef5faa08f');


// $query = "SELECT DISTINCT SectionName FROM (members INNER JOIN sections ON members.SectionID = sections.SectionID)";
if (isset($_SESSION['MemberID'])) {
    // echo "Member ID: ";
    // echo $_SESSION['MemberID'];

    $_SESSION['GET'] = $GetID = $_GET['success'];
    // echo " Get: ";
    // echo $_SESSION['GET'];
    // echo " Get ID: ";
    // echo $GetID;
    // echo " Success: ";
    // echo $_GET['success'];
    $query = "SELECT * FROM sections ORDER BY SectionID ASC";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchALL();
}

function fill_select_color($connect)
{
    $output = '';
    $query = "SELECT * FROM colors ORDER BY ColorID ASC";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        $output .= '<option value="'.$row["ColorID"].'">'.$row["Color"].'</option>';
    }
    return $output;
}
function fill_select_section($connect)
{
    $output = '';
    $query = "SELECT * FROM sections ORDER BY SectionID ASC";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        $output .= '<option value="'.$row["SectionID"].'">'.$row["SectionName"].'</option>';
    }
    return $output;
}

$timezone = "America/Vancouver";
date_default_timezone_set($timezone);
$today = date("d-m-y");
?>


 
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

 <body>
  <div class="container box">
        
              
                    <nav class="navbar navbar-expand-md navbar-dark bg-dark text-white mt-5">              
                        <div class="collapse navbar-collapse" id="navbarCollapse">
                            <div class="navbar-nav">
                                <a href="" class="btn btn-lg btn-secondary mb-3 float-left">Refresh Page</a>  
                                <!-- <a href="" class="nav-item nav-link">Page 1</a>
                                <a href="" class="nav-item nav-link active">Page 2</a> -->
                            </div>
                        </div>
                    </nav>
                
        
   <h1 align="center">Member Detail</h1>

   <?php
    
    if (isset($_SESSION['admin']) || $_SESSION['GET'] == $_SESSION['MemberID']) {
      // echo "Leader ID: ";
      // echo $_SESSION['MemberID'];
      $LeaderID = $_SESSION['MemberID'];
      // echo "$LeaderID";
        ?>

   <br />
   <form method="post" id="insert_form">
   <div class="table-responsive">
    <br />
   <div align="left">
    <div style="width=1200px"> 
      <div style="width:163px; float:left;">
        <select name="filter_section" id="filter_section" class="form-control required" style="width:160px">
                <option value="select_section">Sort By Section</option>
                <?php
                  foreach ($result as $row) {
                      echo '<option value="'.$row["SectionName"].'">'.$row["SectionName"].'</option>';
                  } ?>
        </select>
      </div>     
      <div style="float:left;">
        <button type="button" name="filter" id="filter" class="btn btn-outline-info">Go</button>
      </div>
      <div class="form-inline float-right">
          <form method="post" action="detailcsv.php" hidden> 
              <button type="submit" name="detailexcel" value="CSV Export" class="btn btn-outline-dark " hidden /><i class="fas fa-file-excel"></i> CSV Export</button>                       
          </form> 
          <form method="post" action="detailcsv.php?success=<?php echo "$LeaderID" ?>" >
              <button type="submit" name="detailcsv" value="CSV Export" class="btn btn-outline-dark " /><i class="fas fa-file-csv"></i> CSV Export</button>                       
          </form><span style="width: 3px"></span>
          <form method="post" action="detailpdf.php?success=<?php echo "$LeaderID" ?>"> 
              <button type="submit" name="detailpdf" value="PDF Export" class="btn btn-outline-dark " /><i class="fas fa-file-pdf"></i> PDF Export</button>                       
          </form><span style="width: 3px"></span>
          <!-- <form method="post" action="detailexcel.php?success=<?php echo "$LeaderID" ?>">  -->
          <form method="post" action="detailexcel.php"> 
              <button type="submit" name="detailexcel" value="Excel Export" class="btn btn-outline-dark " /><i class="fas fa-file-excel"></i> Excel Export</button>                       
          </form> 
      </div>
    </div>    
      <div style="clear:both"></div>
   </div>
    <br />
    <div id="alert_message"></div>
    <table id="user_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th width="1%">Member ID</th>
       <th width="15%">Member Name</th>
       <th width="10%">Current Section</th>
       <th width="10%">Member Email</th>
       <th width="10%">Member Contact</th>       
       <th width="5%" >Action</th>
       <p id="msg" style="display:none">Saved</p>
      </tr>
     </thead>

     
    </form>
    </table>
  </div>         
  </div> 
  

<div id="userModal" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="user_form" enctype="multipart/form-data">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">Add User</h4>
    </div>
    <div class="modal-body">
     <label>Enter Quantity</label>
     <input type="text" name="Quantity" id="Quantity" class="form-control" />
     <br />
    </div>
    <div class="modal-footer">
     <input type="hidden" name="user_id" id="user_id" />
     <input type="hidden" name="operation" id="operation" />
     <input type="submit" name="action" id="action" class="btn btn-warning" value="Add" />
     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
   </div>
  </form>
 </div>

 <?php
include('modal/usermodal.php'); ?>

<?php
 require_once('includes/footer.php');
    } else {
    $Error = "Invalid Access Detected, your session is over.";
    echo '<div class = "alert alert-danger text-center">'.$Error.'</div>';
    session_unset();
    session_destroy();
    header("refresh:2;url=index.php");
    // if($Error){
    //   unset($_SESSION['MemberID']);
    // }
}

?>  




<script>  
$(document).ready(function(){  
    $('#insert_form').parsley();

});  
</script>

<script type="text/javascript" language="javascript" >

$(document).ready(function(){

  
//  $('#add_button').click(function(){
//   $('#user_form')[0].reset();
//   $('.modal-title').text("Add User");
//   $('#action').val("Add");
//   $('#operation').val("Add");
//   $('#user_uploaded_image').html('');
//  });

 
 fetch_data();
  function fetch_data(filter_section = '')
  {
   var dataTable = $('#user_data').DataTable({
    processing : true,
    serverSide : true,
    order : [],
    ajax : {
     url:"DetailsFetchAll.php",
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
      "targets":[0,5],
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


<!-- 
<script type="text/javascript" language="javascript" >       
$(document).on('click', '.view_badge', function(){    
  event.preventDefault(); 
      let badge_id = $(this).attr("id"); 
      if(badge_id != '')  
      {        
          $.ajax({  
                url:"DetailsFetchSingleNew.php",  
                method:"POST",  
                data:{badge_id:badge_id}, 
                dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
                success:function(data){  
                    $('#user_detail').html(data);  
                    $('#usermodal').modal('show');  
                }  
          });  
      }            
});
</script> -->




  <!-- <script>   
    var form_data = $(this).serialize();

    if(error == '')
    {
      $.ajax({
        url:"NewMemberInsert.php",
        method:"POST",
        data:form_data,
        success:function(data)
        {
          if(data == 'ok')
          {
            $('#user_data').find("tr:gt(0)").remove();
            $('#alert_message').html('<div class="alert alert-success">New Member Added</div>');
            $('#alert_message').delay(2000).fadeOut('slow');
            $('#user_data').DataTable().ajax.reload(); 
          }
        }
      });
    }
    else
    {
      $('#alert_message').html('<div class="alert alert-danger">'+error+'</div>');
    }

});

</script> -->

  


