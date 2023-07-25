<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Complex Headers -->
    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-header p-0">Service list</h5>
               
            </div>
             <!-- <div class="d-flex justify-content-between align-items-center mb-4">
                <form method="POST" action="<?php echo base_url();?>importsecr" enctype="multipart/form-data">
                <input type="file" name="file" id="file">
                <input type="submit" name="importSubmit" value="importSubmit" id="importSubmit">

                </form>
             </div> -->

            <div class="table-responsive tbl-padding">
                <form id="slist" method="post" >
                    <table class="table table-striped" id="example">

                        <thead>

                            
                        <th colspan="9" class="px-0">
                                    <button type="submit" id="delete_all" name="delete_all" value= "Delete" class="btn p-0"  style="display: none;">
                                        <!--Delete-->
                                        <i class="menu-icon tf-icons bx bxs-trash mx-1"></i>
                                    </button>
                                    <!--<button type="submit" id="sta" class="btn btn-label-secondary btn-xs" disabled>Change Status</button> -->
                                    <button type="button" id="status" name="status" value="Status" class="btn btn-outline-success btn-xs" style="display:none;" >Change Status</button>
                                </th>
                           
                            <tr>
                                <th> 
                                    <input type="checkbox" id="toggle" value="Select All" onclick="toggle_check()" class="form-check-input">
                                </th>
                                <th>      Sr No
                                </th>
                                <th>Category Name</th>
                                <th>Sub Category Name</th>
                                <th> Name</th>
                                <th>Current Status</th>
                                <th>Featured Service</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 1; ?>
                            <?php foreach ($service_list as $value) : ?>
                                <tr>
                                    <td class="text-center"><input type="checkbox" name="checkbox_value[]" value="<?php echo $value['id']; ?>"></td> 

                                    <td>
                                        <?php echo $count++; ?>
                                    </td>

                                <td><?php echo $this->common->cat_name($value['category_id'],'subcategory_name','servicesubcategoory') ?></td> 
                                <td><?php echo $this->common->cat_name($value['subcategory_id'],'subcategory_name','servicesubcategoory') ?></td>
                                    <td><?php echo $value['name']; ?></td>
                                    <td>     <label class="switch switch-success">
                                            <?php if ($value['status'] == 1) { ?>
                                                <input type="checkbox" checked  data-id="<?php echo $value['id']; ?>"    data-status= "0"   class="switch-input status-service"  />
                                                <span class="switch-toggle-slider">
                                                    <span class="switch-on">
                                                        <i class="bx bx-check"></i>
                                                    </span>
                                                </span>
                                                <?php
                                            } elseif ($value['status'] == 0) {
                                                ?>
                                                <input type="checkbox"  data-id="<?php echo $value['id']; ?>"    data-status=' 1 ' class="switch-input status-service"  />
                                                <span class="switch-toggle-slider">
                                                    <span class="switch-off">
                                                        <i class="bx bx-x" style="color:red;"></i>
                                                    </span>
                                                </span>
                                            <?php } ?>
                                        </label> 
                                    </td>
                                    <td>
                                        <?php if ($value['featured'] == 1) { ?>
                                            <button type="button"  data-status='0'   class="btn btn-success btn-xs featured-service"  data-id="<?php echo $value['id']; ?>"><i class="fa fa-thumbs-up "></i></button>
                                        <?php } else { ?>
                                            <button type="button"  data-status='1'   class="btn btn-danger btn-xs featured-service"  data-id="<?php echo $value['id']; ?>"><i class="fa fa-thumbs-down"></i></button>
                                        <?php } ?>

                                    </td>
                                    <td><?php echo date("d-m-Y", strtotime($value['createdDate'])); ?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
    <?php             
                                     $rrr = $this->common->subside($this->session->userdata('user_id'));
                                     if($rrr->num_rows() > 0){
                                     $res= $this->common->eachcheckpri('edits',$this->session->userdata('brw_logged_type'));
                                      if($res->num_rows() > 0){
                                      ?>
                                            <a class="btn btn-info btn-actions btn-sm"  href="edit-service/<?php echo $value['id']; ?>"><i class="far fa-edit font-14"  data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Edit" ></i></a>
<?php }else{
                                      } 
                                     }else{ ?>
                                                                                        <a class="btn btn-info btn-actions btn-sm"  href="edit-service/<?php echo $value['id']; ?>"><i class="far fa-edit font-14"  data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Edit" ></i></a>
                                     <?php }
                                    $del = $this->common->subside($this->session->userdata('user_id'));
                                     if($del->num_rows() > 0){
                                     $delres = $this->common->eachcheckpri('dels',$this->session->userdata('brw_logged_type'));
                                      if($delres->num_rows() > 0){
                                      ?>
                                            <button type="button" class="btn btn-info btn-actions btn-sm delete-service" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" data-bs-original-title="Delete" data-id="<?php echo $value['id']; ?>"><i class="far fa-trash-alt font-14"></i></button>
                                             <?php }else{
                                      } 
                                     }else{ ?>
                                                                                        <button type="button" class="btn btn-info btn-actions btn-sm delete-service" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" data-bs-original-title="Delete" data-id="<?php echo $value['id']; ?>"><i class="far fa-trash-alt font-14"></i></button>

                                            <?php }  ?>
                                                                                                                                    <a class="btn btn-info btn-actions btn-sm" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" data-bs-original-title="Seo" href="editseo/<?php echo $value['id']; ?>">SEO</a>

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