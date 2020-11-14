<div id="UpdateInventoryModal" class="modal fade"> 
 <?php
 include('style/modal.php');
 ?>
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">                        
                     <h4 class="modal-title">Update Inventory </h4>  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                </div>  
                <div class="modal-body">  
                     <form method="post" id="inventory_form">      
                          <label>Badge Name</label>  
                          <input type="text" name="BadgeID" id="BadgeID" class="form-control validate" disabled>  
                          <!-- <input type="text" id="BadgeID" class="form-control input-value" name="BadgeName" disabled placeholder="Full Name" data-parsley-pattern="^[A-Z][a-z]+\s[A-Z][a-z]+$" data-parsley-trigger="focusout" data-parsley-pattern-message="Must contain First and Last name beginning with a capital letter and seprate by a space" data-parsley-member="badgename"  data-parsley-updatemember> -->
                          <br />  
                          <label>Category</label>  
                          <input type="text" name="CategoryID" id="CategoryID" class="form-control validate" disabled>  
                         
                          <br />  
                          <label>Level</label>  
                          <input type="text" name="LevelID" id="LevelID" class="form-control validate" disabled>  
                         
                          <br />   
                          <label>Update Quantity</label>  
                          <input type="text" name="Quantity" id="Quantity" class="form-control" /> 
                          <!-- <input type="text" id="Email" class="form-control mb-2" name="Email" required placeholder="Email" data-parsley-type="email" data-parsley-trigger="focusout" data-parsley-checkemail data-parsley-checkemail-message="Email Address already Exists">  -->
                          <!-- <input type="text" id="Quantity" class="form-control mb-2" name="Quantity" required placeholder="Quantity" data-parsley-quantity="quantity" data-parsley-trigger="focusout" data-parsley-updateemail> -->
                          <br />  
                          <label>Restock Date</label>  
                          <input type='date' id="RestockDate" name="RestockDate" placeholder="YYYY-MM-DD" class="form-control RestockDate">  
                         
                          <br />  
                          <input type="hidden" name="badge_id" id="badge_id" />  
                          <input type="hidden" name="operation" id="operation" />
                          <input type="submit" name="action" id="action" class="btn btn-success" value="Update" />
                          <!-- <input type="submit" name="operation" id="operation" value="Update" class="btn btn-primary" />   -->
                     </form>  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
