
<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Complex Headers -->
    <div class="card">

        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-header p-0">Pdf List</h5>


            </div>
            <div class="table-responsive tbl-padding">
                <form id="pdf" method="post" >
                    <input type="hidden" id="url" value="fetch-client" >

                    <table class="table table-striped" id="example">

                        <thead>

                            <tr>
                            <th colspan="7" class="px-0">
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
                                    <input type="checkbox" id="toggle" value="Select All" onclick="toggle_check()" class="form-check-input">
                                </th>
                                <th >  Sr No
                                </th>
                                <th>Name</th>
                                <th>Pdf</th>
                                <th>Created Date</th>
                                <th>Current Status</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 1; ?>
                            <?php foreach ($pdf_list as $value) : ?>
                                <tr>
                                    <td class="text-center"><input type="checkbox" name="checkbox_value[]" value="<?php echo $value['id']; ?>"></td> 

                                    <td>
                                        <?php echo $count++; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['name']; ?>
                                    </td>
                                    <td><a href="uploads/pdf/<?php echo $value['pdf']; ?>" target="_blank" >DOWNLOAD</a>
                                    <td>     <label class="switch switch-success">
                                            <?php if ($value['status'] == 1) { ?>
                                                <input type="checkbox" checked  data-id="<?php echo $value['id']; ?>"    data-status= "0"   class="switch-input status-pdf"  />
                                                <span class="switch-toggle-slider">
                                                    <span class="switch-on">
                                                        <i class="bx bx-check"></i>
                                                    </span>
                                                </span>
                                                <?php
                                            } elseif ($value['status'] == 0) {
                                                ?>
                                                <input type="checkbox"  data-id="<?php echo $value['id']; ?>"    data-status=' 1 ' class="switch-input status-pdf"  />
                                                <span class="switch-toggle-slider">
                                                    <span class="switch-off">
                                                        <i class="bx bx-x" style="color:red;"></i>
                                                    </span>
                                                </span>
                                            <?php } ?>
                                        </label> 
                                    </td>
                                   <td><?php echo date("d-m-Y", strtotime($value['createdDate'])); ?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
<?php             
                                     $rrr = $this->common->subside($this->session->userdata('user_id'));
                                     if($rrr->num_rows() > 0){
                                     $res= $this->common->eachcheckpri('editpd',$this->session->userdata('brw_logged_type'));
                                      if($res->num_rows() > 0){
                                      ?>
                                            <a class="btn btn-info btn-actions btn-sm" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" data-bs-original-title="Edit" href="edit-pdf/<?php echo $value['id']; ?>"><i class="far fa-edit font-14"></i></a>
<?php }else{
                                      } 
                                     }else{ ?>
                                      <a class="btn btn-info btn-actions btn-sm" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" data-bs-original-title="Edit" href="edit-pdf/<?php echo $value['id']; ?>"><i class="far fa-edit font-14"></i></a>
                                    <?php }
                                     $del = $this->common->subside($this->session->userdata('user_id'));
                                     if($del->num_rows() > 0){
                                     $delres = $this->common->eachcheckpri('delpd',$this->session->userdata('brw_logged_type'));
                                      if($delres->num_rows() > 0){
                                      ?>
                                            <button type="button" class="btn btn-info btn-actions btn-sm delete-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" data-bs-original-title="Delete" data-id="<?php echo $value['id']; ?>"><i class="far fa-trash-alt font-14"></i></button>
                                         <?php }else{
                                      } 
                                     }else{ ?>
                                      <button type="button" class="btn btn-info btn-actions btn-sm delete-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" data-bs-original-title="Delete" data-id="<?php echo $value['id']; ?>"><i class="far fa-trash-alt font-14"></i></button>
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

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>