<meta http-equiv="refresh" content="1800;url=logout.php" />
<?php 
require_once('includes/header.php');
require_once('includes/script.php');
require_once('style/parsley.php'); 
require_once('includes/connection.php');
?>

<style>

h4 {
  background: #293E6A;
}

.bg-custom {
    background: #C0C0C0;
}

</style>

<meta http-equiv="refresh" content="1800;url=logout.php" />
<?php
// echo "THis ID  ";
// echo $_GET['success'];

$query = "SELECT * FROM members WHERE members.MemberID = '".$_GET['success']."'";
$result = mysqli_query($con, $query);
if ($row=mysqli_fetch_assoc($result)) {
    $MemberName = $row['MemberName'];
}
?>

<div class="container" onLoad="getDetail(this.value);">
        <div class="row">
            <div class="col">
                <div class="card bg-custom text-white mt-5"> 
                    <h4 class="text-center py-3">Badge Details for <?php echo $MemberName ?></h4>
                </div>
            </div>
        </div>
    
        <div class="row">
            
            <div class=col-lg-12>
                <div class="card mt-3">
                    <table id="user_data" class="table table-bordered table-striped">  
                        <tr class="bg-outline-dark text-dark ml-5">
                   
                            <th>Badge Earned</th>
                            <th>Member Color</th>
                            <th>Badge Name</th>
                            <th>Badge Category</th>
                            <th>Badge Level</th>
                            <th>Date Tested</th>
                            <th>Tested By</th>
                        </tr>   
<?php 


if(isset($_SESSION['memberlogin']))
{
    $_SESSION['GET'] = $GetID = $_GET['success'];
//     echo $GetID;
//     echo $_GET['success'];
//     echo $_SESSION['GET'];
   
    $query = "SELECT * FROM members, colors, sections, earned, badges, category WHERE 
    members.MemberID ='".$GetID."' AND 
    earned.ColorID = colors.ColorID AND 
    earned.SectionID = sections.SectionID AND
    badges.BadgeID = earned.BadgeID AND
    category.CategoryID = badges.CategoryID AND
    earned.MemberID = '".$GetID."' ORDER BY earned.MemberID desc
    ";
    
        $result = mysqli_query($con, $query);
    
        if($row=mysqli_fetch_assoc($result))
        {
            $MemberName = $row['MemberName'];
            
    echo $row['MemberID'];
    
    require_once('includes/footer.php'); 
    ?>
    

                    <?php
                        $query = "SELECT * FROM members, colors, sections, earned, badges, badgelevel, admin, category WHERE 
                        members.MemberID ='".$GetID."' AND 
                        earned.ColorID = colors.ColorID AND 
                        earned.SectionID = sections.SectionID AND
                        earned.BadgeID = badges.BadgeID AND
                        earned.LevelID = badgelevel.LevelID AND 
                        earned.AdminID = admin.AdminID AND 
                        category.CategoryID = badges.CategoryID AND
                        earned.MemberID = '".$GetID."' ORDER BY earned.DateReceived DESC
                        ";
                        $result = mysqli_query($con, $query);   
                        while($row=mysqli_fetch_assoc($result))
                            { 
                        ?>
                        <tr>                          
                            <td value = "<?php echo $row["SectionID"]; ?>"> <?php echo $row["SectionName"]; ?></td>
                            <td value = "<?php echo $row["ColorID"]; ?>"> <?php echo $row["Color"]; ?></td>
                            <td value = "<?php echo $row["BadgeID"]; ?>"> <?php echo $row["BadgeName"]; ?></H>
                            <td value = "<?php echo $row["CategoryID"]; ?>"> <?php echo $row["CategoryName"]; ?></td>
                            <td value = "<?php echo $row["LevelID"]; ?>"> <?php echo $row["Levels"]; ?></td>
                            <td value = "<?php echo $row["DateReceived"]; ?>"> <?php echo $row["DateReceived"]; ?></td>
                            <td value = "<?php echo $row["AdminID"]; ?>"> <?php echo $row["FName"]; ?></td>
                        </tr>
                    <?php           
                        }
                   }
    
        // else
        //     {
        //     header("location:message.php");
        //     exit();
        //     }        
    }
    ?>

</table>    
    <div class="row">                                             
        <div class="card-body">
            <button type="button"  class="btn btn-primary mb-1" style="position:relative; top:2px;" disabled>Back</button>
            <button type="button" id="<?php echo "$GetID" ?>" class="btn btn-outline-info update_account" >Edit Profile</button>      
            <button type="button" id="<?php echo "$GetID" ?>" class="btn btn-outline-success update_password">Change Password</button> 
            <button type="button" id="<?php echo "$GetID" ?>" class="btn btn-outline-danger schedule_test">Schedule Badge Test</button>                       
            <!-- <a href="AddBadgeFrontEnd.php?addBadge=<?php echo $GetID ?>" class="btn btn-danger">Schedule Badge Test</a> -->
            
            <div class="form-inline float-right">
                <form method="post" action="exportcsv.php?success=<?php echo "$GetID" ?>"> 
                    <button type="submit" name="csv" value="CSV Export" class="btn btn-outline-dark " style="position:relative; top:2px;"/><i class="fas fa-file-csv"></i> CSV Export</button>
                </form><span style="width: 3px"></span> 
                <form method="post" action="exportpdf.php?success=<?php echo "$GetID" ?>"> 
                    <button type="submit" name="pdf" value="PDF Export" class="btn btn-outline-dark " style="position:relative; top:2px;"/><i class="fas fa-file-pdf"></i> PDF Export</button>                       
                </form><span style="width: 3px"></span>
                <form method="post" action="exportexcel.php?success=<?php echo "$GetID" ?>"> 
                    <button type="submit" name="excel" value="Excel Export" class="btn btn-outline-dark " style="position:relative; top:2px;" /><i class="fas fa-file-excel"></i> Excel Export</button>                       
                </form> 
            </div>              
        </div>      
    </div>    
</div>
</div>
</div>


</div>

<?php 
    include('modal/accountmodal.php');
    include('modal/passwordmodal.php');
    include('modal/badgetestmodal.php');
?>

<!-- //Activate Update Modal -->
<script type="text/javascript" language="javascript" >
$(document).on('click', '.update_account', function(){ 
    $('#account_form').parsley(); 
    let member_id = $(this).attr("id"); 
      $.ajax({  
          url:"UpdateAccountFrontEnd.php",  
          method:"POST",  
          data:{m_id:member_id},  
          dataType:"json",  
          success:function(data){  
                $('#updatemember').val(data.MemberName);  
                $('#updateuser').val(data.memberusername);  
                $('#Contact').val(data.Contact);  
                $('#email').val(data.Email);  
                $('#Date').val(data.Date);  
                $('.modal-title').text("Update Profile");
                $('#m_id').val(member_id);
                $('#action').val("Confirm");
                $('#operation').val("Confirm");
                $('#action').removeClass('btn btn-success').addClass('btn btn-danger'); 
                $('#accountModal').modal('show'); 
                // $('#user_data').DataTable().ajax.reload(); 
          }  
      });  
}); 

$(document).on('submit', '#account_form', function(event){
    $('#account_form').parsley(); 
event.preventDefault();
var member_id = $(this).attr("id");
 $.ajax({
  url:"UpdateAccountBackEnd.php",
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
   $('#account_form')[0].reset();
   $('#accountModal').modal('hide');
//    $('#user_data').DataTable().ajax.reload(); 
   location.reload();
  }
 });
});
</script>

<!-- //Activate NEW Password Modal -->
<script type="text/javascript" language="javascript" >
$(document).on('click', '.update_password', function(){ 
    $('#password_form').parsley(); 
    let user_id = $(this).attr("id"); 
      $.ajax({  
          url:"UpdatePasswordFrontEnd.php",  
          method:"POST",  
          data:{u_id:user_id},  
          dataType:"json",  
          success:function(data){   
                $('#updatemember').val(data.MemberName);
                $('.modal-title').text("Update Profile");
                $('#u_id').val(user_id);
                $('#act').val("Reset Password");
                $('#operate').val("Reset Password");
                $('#act').removeClass('btn btn-success').addClass('btn btn-danger'); 
                $('#passwordModal').modal('show'); 
                // $('#user_data').DataTable().ajax.reload(); 
          }  
      });  
}); 

$(document).on('submit', '#password_form', function(event){
    $('#password_form').parsley(); 
event.preventDefault();
var user_id = $(this).attr("id");
 $.ajax({
  url:"UpdatePasswordBackEnd.php",
  method:'POST',
  data:new FormData(this),
  contentType:false,
  processData:false,
  beforeSend:function(){  
      $('#act').val("Updating..");  
  },
  success:function(data)
  {
   alert(data);
   $('#password_form')[0].reset();
   $('#passwordModal').modal('hide');
//    $('#user_data').DataTable().ajax.reload(); 
   location.reload();
  }
 });
});
</script>

<!-- //Activate Badge Test Schedule Modal -->
<script type="text/javascript" language="javascript" >
$(document).on('click', '.schedule_test', function(){ 
    $('#schedule_form').parsley(); 
    let user_id = $(this).attr("id"); 
      $.ajax({  
          url:"ScheduleTestFrontEnd.php",  
          method:"POST",  
          data:{u_id:user_id},  
          dataType:"json",  
          success:function(data){   
                $('#updatemember').val(data.MemberName);
                $('.modal-title').text("Schedule Badge Test");
                $('.modal-title').css("background-color", "yellow"); // change header bg color using jquery method 
                $('.modal-title').css("color", "lightgray");
                $('#u_id').val(user_id);
                $('#act').val("Reset Password");
                $('#operate').val("Reset Password");
                $('#act').removeClass('btn btn-success').addClass('btn btn-danger'); 
                $('#badgetestModal').modal('show'); 
                // $('#user_data').DataTable().ajax.reload(); 
          }  
      });  
}); 

$(document).on('submit', '#schedule_form', function(event){
    $('#schedule_form').parsley(); 
event.preventDefault();
var user_id = $(this).attr("id");
 $.ajax({
  url:"ScheduleTestBackEnd.php",
  method:'POST',
  data:new FormData(this),
  contentType:false,
  processData:false,
  beforeSend:function(){  
      $('#act').val("Updating..");  
  },
  success:function(data)
  {
   alert(data);
   $('#schedule_form')[0].reset();
   $('#badgetestModal').modal('hide');
//    $('#user_data').DataTable().ajax.reload(); 
   location.reload();
  }
 });
});
</script>


<script>

$(function(){
  $('#Contact').inputmask("(999) 999-9999");
});
</script>



