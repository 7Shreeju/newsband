

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Complex Headers -->

    <div class="card">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-header p-0">Event List</h5>

              
            </div>    

        

        <div class="table-responsive tbl-padding">
            <form id="event" method="post" >

                <table class="table table-striped" id="example">

                    <thead>
                        <tr>
                        <th colspan="8" class="px-0">
                                    <button type="submit"  name="delete_all" id="delete_all" value= "Delete" class="btn p-0" style="display:none;">
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

                           
                            <th >

                                Sr No

                            </th>

                            <th>Category Name</th>

                            <th>Event Name</th>

                            <th>Current Status</th>
                            <th>Featured Event</th>
                            <th>Created Date</th>
                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>
                        <?php $count = 1; ?>
                        <?php foreach ($event_list as $value) : ?>

                            <tr>
                                <td class="text-center"><input type="checkbox" name="checkbox_value[]" value="<?php echo $value['id']; ?>"></td> 

                                <td> <?php echo $count++; ?></td>

                                <td><?php echo $this->common->cat_name($value['category_id'], 'category_name', 'event_category'); ?></td> 

                                <td><?php echo $value['name']; ?></td>


                                <td>     
                                    <label class="switch switch-success">
                                        <?php if ($value['status'] == 1) { ?>
                                            <input type="checkbox" checked  data-id="<?php echo $value['id']; ?>"    data-status= "0"   class="switch-input status-event"  />
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="bx bx-check"></i>
                                                </span>
                                            </span>
                                            <!-- <span class="switch-label">Active</span> -->
                                            <?php
                                        } elseif ($value['status'] == 0) {
                                            ?>
                                            <input type="checkbox"  data-id="<?php echo $value['id']; ?>"    data-status=' 1 ' class="switch-input status-event"  />
                                            <span class="switch-toggle-slider">
                                                <span class="switch-off">
                                                    <i class="bx bx-x" style="color:red;"></i>
                                                </span>
                                            </span>
                                            <!-- <span class="switch-label">Deactivated</span>-->
                                        <?php } ?>
                                    </label> 
                                </td>
                               
                                <td>
                                    <?php if ($value['alt_features'] == 1) { ?>
                                        <button type="button"  data-status='0'   class="btn btn-success btn-xs feature-event"  data-id="<?php echo $value['id']; ?>"><i class="fa fa-thumbs-up "></i></button>
                                    <?php } else { ?>
                                        <button type="button"  data-status='1'   class="btn btn-danger btn-xs feature-event"  data-id="<?php echo $value['id']; ?>"><i class="fa fa-thumbs-down"></i></button>
                                    <?php } ?>



                                </td>
                                 <td><?php echo date("d-m-Y", strtotime($value['createdDate'])); ?></td>
                                <td>

                                    <div class="btn-group" role="group" aria-label="Basic example">
<?php             
                                     $rrr = $this->common->subside($this->session->userdata('user_id'));
                                     if($rrr->num_rows() > 0){
                                     $res= $this->common->eachcheckpri('edite',$this->session->userdata('brw_logged_type'));
                                      if($res->num_rows() > 0){
                                      ?>
                                        <a class="btn btn-info btn-actions btn-sm"  popup="tooltip-custom" data-bs-toggle="tooltip" placement="top" title="Edit" href="<?php echo base_url(); ?>edit-event/<?php echo $value["id"]; ?>"><i class="far fa-edit font-14"></i></a>
                                    <?php }else{
                                      } 
                                     }else{ ?>
                                        <a class="btn btn-info btn-actions btn-sm"  popup="tooltip-custom" data-bs-toggle="tooltip" placement="top" title="Edit" href="<?php echo base_url(); ?>edit-event/<?php echo $value["id"]; ?>"><i class="far fa-edit font-14"></i></a>
                                 <?php }
                                     $del = $this->common->subside($this->session->userdata('user_id'));
                                     if($del->num_rows() > 0){
                                     $delres = $this->common->eachcheckpri('dele',$this->session->userdata('brw_logged_type'));
                                      if($delres->num_rows() > 0){
                                      ?>
                                        <button type="button" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" data-bs-original-title="Delete" class="btn btn-info btn-actions btn-sm delete-event"  data-id="<?php echo $value['id']; ?>"><i class="far fa-trash-alt font-14" title="Delete Blog"></i></button>
                              <?php }else{
                                      } 
                                     }else{ ?>
                                     <button type="button" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" data-bs-original-title="Delete" class="btn btn-info btn-actions btn-sm delete-event"  data-id="<?php echo $value['id']; ?>"><i class="far fa-trash-alt font-14" title="Delete Blog"></i></button>

                                        <?php } ?>
                                        <a class="btn btn-info btn-actions btn-sm" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" data-bs-original-title="Seo" href="<?php echo base_url(); ?>edit-eventseo/<?php echo $value["id"]; ?>">SEO</i></a>

                                    </div>


                                </td>


                            </tr>

                        <?php endforeach ?>

                    </tbody>



                </table>
            </form>
        </div>

                                    </div>

    </div>

</div>


<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>









