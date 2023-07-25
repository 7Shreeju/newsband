


<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Complex Headers -->
    <div class="card">

        
        <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="card-header p-0">Faq Category List</h5>
         <?php             
                                     $rrr = $this->common->subside($this->session->userdata('user_id'));
                                     if($rrr->num_rows() > 0){
                                     $res= $this->common->eachcheckpri('addcf',$this->session->userdata('brw_logged_type'));
                                      if($res->num_rows() > 0){
                                      ?>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalAdd">Add Faq Category</button>
         <?php }else{
                                      } 
                                     }else{ ?>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalAdd">Add Faq Category</button>
             <?php }
                                     ?>
        </div>
        <div class="table-responsive tbl-padding">
        <form id="faq_cat" method="post" >
            <table class="table table-striped " id="example">

                <thead>

                    <tr>
                    <th colspan="6" class="px-0">
                                    <button type="submit" id="delete_all" name="delete_all" value= "Delete" class="btn p-0" style="display: none;">
                                        <!--Delete-->
                                        <i class="menu-icon tf-icons bx bxs-trash mx-1"></i>
                                    </button>
                                    <!--<button type="submit" id="sta" class="btn btn-label-secondary btn-xs" disabled>Change Status</button> -->
                                    <button type="button" id="status" name="status" value="Status" class="btn btn-outline-success btn-xs" style="display:none;" >Change Status</button>
                                </th>
                    </tr>
                    <tr>
                        <th> 
                            <input type="checkbox" id="toggle" value="Select All" onclick="toggle_check()" class="form-check-input"></th>

                        <th>

                            Sr No
                        </th>
                        <th>Category</th>
                        <th>Current Status</th>
                        <th>Created Date</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $count = 1; ?>
                    <?php foreach ($faqcategory_list as $value) : ?>
                        <tr>
                            <td class="text-center"><input type="checkbox" name="checkbox_value[]" value="<?php echo $value['id']; ?>"></td> 

                            <td>
                                <?php echo $count++; ?>
                            </td>

                            <td><?php echo $value['category']; ?></td>                                           
                            <td>     <label class="switch switch-success">
                                    <?php if ($value['status'] == 1) { ?>
                                        <input type="checkbox" checked  data-id="<?php echo $value['id']; ?>"    data-status= "0"   class="switch-input status-faqcategory"  />
                                        <span class="switch-toggle-slider">
                                            <span class="switch-on">
                                                <i class="bx bx-check"></i>
                                            </span>
                                        </span>
                                        <!-- <span class="switch-label">Active</span> -->
                                        <?php
                                    } elseif ($value['status'] == 0) {
                                        ?>
                                        <input type="checkbox"  data-id="<?php echo $value['id']; ?>"    data-status=' 1 ' class="switch-input status-faqcategory"  />
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
                                     if($rrr->num_rows() > 0){
                                     $res= $this->common->eachcheckpri('editcf',$this->session->userdata('brw_logged_type'));
                                      if($res->num_rows() > 0){
                                      ?>
                                    <button type="button" class="btn btn-info btn-actions btn-sm fetch-faqcategory" data-id="<?php echo $value['id']; ?>"  data-bs-toggle="tooltip" data-bs-trigger="hover" title="EDIT" data-bs-placement="top"><i class="far fa-edit font-14"> <span class="stretched-link" data-bs-toggle="modal" data-bs-target="#exampleModalEdit"></span></i></button>
  <?php }else{
                                      } 
                                     }else{ ?>
                                      <button type="button" class="btn btn-info btn-actions btn-sm fetch-faqcategory" data-id="<?php echo $value['id']; ?>"  data-bs-toggle="tooltip" data-bs-trigger="hover" title="EDIT" data-bs-placement="top"><i class="far fa-edit font-14"> <span class="stretched-link" data-bs-toggle="modal" data-bs-target="#exampleModalEdit"></span></i></button>
                                    <?php }
                                     $del = $this->common->subside($this->session->userdata('user_id'));
                                     if($del->num_rows() > 0){
                                     $delres = $this->common->eachcheckpri('delcf',$this->session->userdata('brw_logged_type'));
                                      if($delres->num_rows() > 0){
                                      ?>
                                    <button type="button"  data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" data-bs-original-title="Delete" class="btn btn-info btn-actions btn-sm delete-faqcategory"  data-id="<?php echo $value['id']; ?>"><i class="far fa-trash-alt font-14"></i></button>
                                     <?php }else{
                                      } 
                                     }else{ ?>
                                    <button type="button"  data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" data-bs-original-title="Delete" class="btn btn-info btn-actions btn-sm delete-faqcategory"  data-id="<?php echo $value['id']; ?>"><i class="far fa-trash-alt font-14"></i></button>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>
    </div>
    </div>
    </div>
</div>


<div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <form id="update-faqcategory" method="post">                   
            <input type="hidden" class="form-control" id="id" name="id">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Edit Faq Category Name</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">

                            <label class="form-label" for="modalEditUserFirstName">Faq Category Name</label>

                            <input type="text" class="form-control" placeholder="Enter Faq Category Name" id="cat_name" name="category">

                            <div id="faqcategory1_error" class="invalid-feedback"></div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="updatfaq-btn" class="btn btn-primary m-t-15 waves-effect">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="exampleModalAdd" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <form class="add-faqcategory" method="post">                   
            <input type="hidden" class="form-control" placeholder="Enter  Category id" name="id">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Add FAQ's Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">

                            <label class="form-label" for="modalEditUserFirstName">FAQ's Category Name</label>

                            <input type="text" class="form-control" placeholder="Enter Faq Category Name"  name="category">

                            <div id="category_error" class="invalid-feedback"></div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="addfaq-btn" class="btn btn-primary m-t-15 waves-effect">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>      
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>