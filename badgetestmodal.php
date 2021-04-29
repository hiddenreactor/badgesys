<div id="badgetestModal" class="modal fade" role="dialog"> 
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">                        
                     <h4 class="modal-title">Schedule Badge Test</h4>  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                </div>  
                <div class="modal-body">  
                     <form method="post" id="schedule_form">                              
                          <label><i>Under Construction--Coming soon!!</i></label>  
                          <input type="password" id="password" class="form-control mb-2" name="password" placeholder="Password" required data-parsley-length="[8, 16]" data-parsley-pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" data-parsley-trigger="focusout" data-parsley-pattern-message="Password must contain 8 letters combine with numbers and special character" onchange='check_pass();'>
                          <input type="password" id="confpass" class="form-control mb-2" name="confpass" placeholder="Confirm Password" data-parsley-equalto="#password" data-parsley-trigger="focusout" onchange='check_pass();'>
                          <br />
                    <input type="hidden" name="u_id" id="u_id" />  
                    <input type="hidden" name="operate" id="operate" />
                    <input type="submit" name="act" id="act" class="btn btn-success" value="Schedule" />
                     </form>  
                </div>  
                <div class="modal-footer">                
                    
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  


