<div class="container-xxl flex-grow-1 container-p-y">                                                  
    <!-- Complex Headers -->                 
    <div class="card">                            
        <div class="card-body">  
            
             <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="card-header p-0">Testimonials List</h5>                             

                

            </div>       
                                     
        <div class="table-responsive tbl-padding">   
            <form id="test" method="post" >

                <table class="table table-striped" id="example">                  
                    <thead>  
                        <tr>
                        <th colspan="8" class="px-0">
                                    <button type="submit" name="delete_all" id="delete_all" value= "Delete" class="btn p-0" style="display:none;">
                                        <!--Delete-->
                                        <i class="menu-icon tf-icons bx bxs-trash mx-1"></i>
                                    </button>
                                    <!--<button type="submit" id="sta" class="btn btn-label-secondary btn-xs" disabled>Change Status</button> -->
                                    <button type="button" id="status" name="status" value="Status" class="btn btn-outline-success btn-xs" style="display:none;" >Change Status</button>
                                </th>
                        </tr>
                        <tr>  
                            <th> 
                                <input type="checkbox" id="toggle" value="Select All" onclick="toggle_check()" class="form-check-input">
                            </th>
                            <th>Sr No</th>                                  
                            <th> Name</th>                                       
                            <th>Designation</th>                                      
                            <th>Brief Intro</th>                                                                            
                            <th>Current Status</th>
                            <th>Created Date</th>
                            <th>Action</th>                                   
                        </tr>                      
                    </thead>             
                    <tbody>                  
                        <?php
                        $count = 1;
                        foreach ($testimonial_list as $value) :
                            ?>                                       
                            <tr>                                 <td class="text-center"><input type="checkbox" name="checkbox_value[]" value="<?php echo $value['id']; ?>"></td> 


                                <td><?php echo $count++; ?></td>                                    
                                <td><?php echo $value['name']; ?></td>                                       
                                <td><?php echo $value['designation']; ?></td>                                                                                  <td>                                
                                    <button type="button" class="btn btn-primary btn-xs fetch-test" data-id="<?php echo $value['id']; ?>" data-bs-toggle="modal" data-bs-target="#basicModal">View</button>                     
                                <td>     
                                    <label class="switch switch-success">
                                        <?php if ($value['status'] == 1) { ?>
                                            <input type="checkbox" checked  data-id="<?php echo $value['id']; ?>"    data-status= "0"   class="switch-input status-testimonial"  />
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="bx bx-check"></i>
                                                </span>
                                            </span>
                                            <!-- <span class="switch-label">Active</span> -->
                                            <?php
                                        } elseif ($value['status'] == 0) {
                                            ?>
                                            <input type="checkbox"  data-id="<?php echo $value['id']; ?>"    data-status=' 1 ' class="switch-input status-testimonial"  />
                                            <span class="switch-toggle-slider">
                                                <span class="switch-off">
                                                    <i class="bx bx-x" style="color:red;"></i>
                                                </span>
                                            </span>
                                            <!-- <span class="switch-label">Deactivated</span>-->
                                        <?php } ?>
                                    </label> 
                                </td>
                                
                                 <td><?php echo date("d-m-Y", strtotime($value['createdDate'])); ?></td>



                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
 <?php
                                            $rrr = $this->common->subside($this->session->userdata('user_id'));
                                            if ($rrr->num_rows() > 0) {
                                                $res = $this->common->eachcheckpri('edittest', $this->session->userdata('brw_logged_type'));
                                                if ($res->num_rows() > 0) {
                                                    ?>
                                        <a class="btn btn-info btn-actions btn-sm"  popup="tooltip-custom" data-bs-toggle="tooltip" placement="top" title="Edit" href="<?php echo base_url(); ?>edit-testimonial/<?php echo $value["id"]; ?>"><i class="far fa-edit font-14"></i></a>
 <?php
                                                } else {
                                                    
                                                }
                                            } else { ?>
                                        <a class="btn btn-info btn-actions btn-sm"  popup="tooltip-custom" data-bs-toggle="tooltip" placement="top" title="Edit" href="<?php echo base_url(); ?>edit-testimonial/<?php echo $value["id"]; ?>"><i class="far fa-edit font-14"></i></a>
  <?php }
                                     $del = $this->common->subside($this->session->userdata('user_id'));
                                     if($del->num_rows() > 0){
                                     $delres = $this->common->eachcheckpri('deltest',$this->session->userdata('brw_logged_type'));
                                      if($delres->num_rows() > 0){
                                      ?>
                                     <button type="button" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" data-bs-original-title="Delete" class="btn btn-info btn-actions btn-sm delete-testimonial"  data-id="<?php echo $value['id']; ?>"><i class="far fa-trash-alt font-14" title="Delete Service"></i></button>
  <?php }else{
                                      } 
                                     }else{ ?>
                                     <button type="button" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" data-bs-original-title="Delete" class="btn btn-info btn-actions btn-sm delete-testimonial"  data-id="<?php echo $value['id']; ?>"><i class="far fa-trash-alt font-14" title="Delete Service"></i></button>
<?php } ?>


                                    </div>   
                                </td>










                                </td>                                    
                            </tr><?php endforeach; ?>                                         
                    </tbody>                    
                </table> 
            </form>
        </div>               
    </div>
</div>
</div>   
<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">  
    <div class="modal-dialog" role="document">    
        <div class="modal-content">           
            <div class="modal-header">           
                <h5 class="modal-title" id="modalLongTitle">Brief Intro</h5>          
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>           
            </div>       
            <div class="modal-body">         
                <p id="shortinfo" ></p>          
            </div>         
            <div class="modal-footer">              
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>       
            </div>     
        </div>   
    </div>
</div>          
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>