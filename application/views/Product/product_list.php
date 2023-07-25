<style>
    .tbl-padding div#example_wrapper{
        padding: 0;
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Complex Headers -->
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-header p-0">E-Paper List</h5>
            </div>       
         <!-- <div class="d-flex justify-content-between align-items-center mb-4">
                <form method="POST" action="<?php echo base_url();?>importpro" enctype="multipart/form-data">
                <input type="file" name="file" id="file">
                <input type="submit" name="importSubmit" value="importSubmit" id="importSubmit">

                </form>
             </div> -->
         <?php if ($this->session->flashdata('error')) { ?>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <?php echo $this->session->flashdata('error'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                        <div class="form_error">
                            <?php echo validation_errors(); ?>
                        </div>
                    </div>
                <?php } ?> 
             <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <?php echo $this->session->flashdata('success'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
                            <div class="form_error">
                                <?php echo validation_errors(); ?>
                            </div>
                        </div>
                    <?php } ?>
            <div class="table-responsive tbl-padding">
                <form id="plist" method="post" >
                    <table class="table table-striped" id="example">
    
                        <thead>
                            <tr>
                                <th colspan="9" class="px-0">
                                    <button type="submit" id="delete_all" name="delete_all" value= "Delete" class="btn p-0" style="display:none;">
                                        <!--Delete-->
                                        <i class="menu-icon tf-icons bx bxs-trash mx-1"></i>
                                    </button>
                                    <!--<button type="submit" id="sta" class="btn btn-label-secondary btn-xs">Change Status</button>     -->
                                    
                                    <button type="button" id="status" name="status" value="Status" class="btn btn-outline-success btn-xs" style="display:none;">Change Status</button>
                                </th>
                            </tr>
                            <tr>
                                <th> 
                                    <input type="checkbox" id="toggle" value="Select All" onclick="toggle_check()" class="form-check-input">
                                </th>
                                <th >
                                    Sr No
                                </th>
                                
                                <th>Title</th>
                                <th>File</th>
                                <th>Status</th>
                               
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 1; ?>
                            <?php foreach ($product_list as $value) : ?>
                                <tr>
                                    <td class="text-center"><input type="checkbox" name="checkbox_value[]" value="<?php echo $value['id']; ?>"></td> 
    
                                    <td>   <?php echo $count++; ?>
                                    </td>
                                    
    
    
                                    <td><?php echo $value['name']; ?></td>
                                    <td><a  href="<?php echo $value['pdf_url']; ?>" target="_blank" >View</a></td>
    
                                    <td>     <label class="switch switch-success">
                                            <?php if ($value['status'] == 1) { ?>
                                                <input type="checkbox" checked  data-id="<?php echo $value['id']; ?>"    data-status= "0"   class="switch-input status-product"  />
                                                <span class="switch-toggle-slider">
                                                    <span class="switch-on">
                                                        <i class="bx bx-check"></i>
                                                    </span>
                                                </span>
                                                <!-- <span class="switch-label">Active</span> -->
                                                <?php
                                            } elseif ($value['status'] == 0) {
                                                ?>
                                                <input type="checkbox"  data-id="<?php echo $value['id']; ?>"    data-status=' 1 ' class="switch-input status-product"  />
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
                                     $res= $this->common->eachcheckpri('editp',$this->session->userdata('brw_logged_type'));
                                      if($res->num_rows() > 0){
                                      ?>
                                            <a class="btn btn-info btn-actions btn-sm"  data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" data-bs-original-title="Edit" href="<?php echo base_url(); ?>edit-product/<?php echo $value["id"]; ?>"><i class="far fa-edit font-14"></i></a>
                                         <?php }else{
                                      } 
                                     }else{ ?>
                                         <a class="btn btn-info btn-actions btn-sm"  data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" data-bs-original-title="Edit" href="<?php echo base_url(); ?>edit-product/<?php echo $value["id"]; ?>"><i class="far fa-edit font-14"></i></a>
                                   <?php }
                                           $del = $this->common->subside($this->session->userdata('user_id'));
                                     if($del->num_rows() > 0){
                                     $delres = $this->common->eachcheckpri('delp',$this->session->userdata('brw_logged_type'));
                                      if($delres->num_rows() > 0){
                                      ?>
                                            <button type="button" class="btn btn-info btn-actions btn-sm delete-product"  data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" data-bs-original-title="Delete"  data-id="<?php echo $value['id']; ?>"><i class="far fa-trash-alt font-14" title="Delete Blog"></i></button>
                                           <?php }else{
                                      } 
                                     }else{ ?>
                                            <button type="button" class="btn btn-info btn-actions btn-sm delete-product"  data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" data-bs-original-title="Delete"  data-id="<?php echo $value['id']; ?>"><i class="far fa-trash-alt font-14" title="Delete Blog"></i></button>
                                          <?php }  ?>
                                            <a class="btn btn-info btn-actions btn-sm"  data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" data-bs-original-title="SEO" href="<?php echo base_url(); ?>editproductseo/<?php echo $value["id"]; ?>">SEO</a>
    
                                           
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

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
// $(document).ready(function () {
//     $('#example').DataTable({
//         "language": {
//       "emptyTable": "No data available in table"
//     },
//         stateSave: true,
//         "columnDefs": [
//        { "orderable": false, "targets": 0 }
//            ]
           
//     });
  
    

// });
 </script>