<div id="UpdateModal" class="modal fade"> 
 <?php 
 include('style/modal.php');
 ?>
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">                        
                     <h4 class="modal-title">Update Member        
                     </h4>  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                </div>  
                <div class="modal-body">  
                     <form method="post" id="update_form">      
                          <label>Member Name</label>  
                          <!-- <input type="text" name="MemberName" id="MemberName" class="form-control validate" required>   -->
                          <input type="text" id="updatemember" class="form-control input-value" name="MemberName" disabled placeholder="Full Name" data-parsley-pattern="^[A-Z][a-z]+\s[A-Z][a-z]+$" data-parsley-trigger="focusout" data-parsley-pattern-message="Must contain First and Last name beginning with a capital letter and seprate by a space" data-parsley-member="membername"  data-parsley-updatemember>
                          <br />  
                          <label>Update Section</label>  
                          <select name='SectionID' id='SectionID' class="form-control input-value">
                            <option value="">Select Section</option>
                              <?php 
                              $query = "SELECT * FROM sections ORDER BY SectionID ASC";
                              $statement = $connect->prepare($query);
                              $statement->execute();
                              $result = $statement->fetchALL();
                                foreach($result as $row)
                                {
                                  echo '<option value="'.$row["SectionID"].'">'.$row["SectionName"].'</option>';
                                }
                              ?>        
                            </select> 
                          <br />  
                          <label>Update Color</label>  
                          <select name='ColorID' id='ColorID' class="form-control input-value">
                            <option value="">Select Color</option>
                              <?php 
                              $query = "SELECT * FROM colors ORDER BY ColorID ASC";
                              $statement = $connect->prepare($query);
                              $statement->execute();
                              $result = $statement->fetchALL();
                                foreach($result as $row)
                                {
                                  echo '<option value="'.$row["ColorID"].'">'.$row["Color"].'</option>';
                                }
                              ?>        
                            </select> 
                          <br />   
                          <label>Update Email</label>  
                          <!-- <input type="text" name="Email" id="Email" class="form-control" />  -->
                          <!-- <input type="text" id="Email" class="form-control mb-2" name="Email" required placeholder="Email" data-parsley-type="email" data-parsley-trigger="focusout" data-parsley-checkemail data-parsley-checkemail-message="Email Address already Exists">  -->
                          <input type="text" id="updateemail" class="form-control mb-2" name="Email" required placeholder="Email" data-parsley-email="email" data-parsley-trigger="focusout" data-parsley-updateemail>
                          <br />  
                          <label>Update Contact</label>  
                          <input type="text" id='Contact' name='Contact' placeholder=" Contact Number" value="" class="form-control mb-3">
                          <!-- <input type="text" name="Contact" id="Contact" class="form-control" required data-parsley-trigger="focusout" data-parsley-pattern-message="Please enter a valid Australian mobile phone number." data-parsley-pattern="^\d{3} \d{3} \d{4}$" />  -->
                          <br />  
                          <label>Date Registered</label>  
                          <input type="text" name="Date" id="Date" class="form-control" disabled />  
                          <br />
                          <input type="hidden" name="user_id" id="user_id" />  
                          <input type="hidden" name="operation" id="operation" />
                          <input type="submit" name="action" id="action" class="btn btn-success" value="Add Member" />
                          <!-- <input type="submit" name="operation" id="operation" value="Update" class="btn btn-primary" />   -->
                     </form>  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
