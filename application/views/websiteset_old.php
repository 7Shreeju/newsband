<style>
    .table>:not(:first-child) {
    border-top: 0px solid #d9dee3;
}
</style>

<div class="container-xxl flex-grow-1 container-p-y">
<div class="row mb-4">
    <div class="col-md mb-4 mb-md-0">
        <div class="card">
            <h5 class="card-header">Website Setting Page</h5>
            <div class="card-body">
                <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <?php echo $this->session->flashdata('success'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                    <div class="form_error">
                        <?php echo validation_errors(); ?>
                    </div>
                </div>
                <?php } elseif($this->session->flashdata('warning')) { ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <?php echo $this->session->flashdata('warning'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                    <div class="form_error">
                        <?php echo validation_errors(); ?>
                    </div>
                </div>
                <?php } ?>  
                <form class="web-form" action="insert-settings" method="post" enctype="multipart/form-data">
                    <?php foreach ($edit_details as $value) : ?>
                    
                        <div class="row">
                            <div class="col-md-6">
                            <label class="form-label" for="bs-validation-name">Logo</label>
                            <span style="color:red;font-size:12px">(Extension: JPG, JPEG, jpg, jpeg) Note:Dimension Size 150*65px</span>
                                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $value['id']; ?>">
                                <div class="mb-3">
                                    <div class="form-group ">
                                        
                                       
                                        <input type="file" onchange="preview()" class="form-control" id="file" name="logo">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <?php if ($value['logo_url'] != NULL) { ?>
                                    <img  style="width: auto" src="<?php echo base_url();?>uploads/img/<?php echo $value['logo']; ?>" id="thumb">
                                    <?php }
                                        ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                            <label class="form-label" for="bs-validation-name">Fav icon</label>
                            <span style="color:red;font-size:12px">(Extension: JPG, JPEG, jpg, jpeg) Note:Dimension Size 150*65px</span>
                                <div class="mb-3">
                                  <input type="file" onchange="preview1()" class="form-control" id="file1" name="favicon">
                                </div>
                                <div class="mb-3">
                                    <?php if ($value['fav_url'] != NULL) { ?>
                                    <img  style="" src="<?php echo base_url();?>uploads/img/<?php echo $value['favicon']; ?>" id="thumb1">
                                    <?php }
                                        ?>
                                </div>
                            </div>
                            <h6>Social Links</h6>
                            <div class="row">
                                <div class="col-md-6">
                                <label class="form-label" for="bs-validation-name">Facebook</label>
                                    <div class="mb-3">
                                        
                                        <input type="text" placeholder="https://www.facebook.com/" class="form-control" value="<?php echo $value['fb']; ?>" name="fb">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                <label class="form-label" for="bs-validation-name">Instagram</label>
                                    <div class="mb-3">
                                      
                                        <input type="text"  class="form-control"  placeholder="https://www.instagram.com/"  value="<?php echo $value['insta']; ?>" name="insta">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                <label class="form-label" for="bs-validation-name">Twitter</label>
                                    <div class="mb-3">
                                     
                                        <input type="text"  class="form-control" placeholder="https://twitter.com/" value="<?php echo $value['twitter']; ?>" name="twitter">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                <label class="form-label" for="bs-validation-name">Whatsapp</label>
                                    <div class="mb-3">
                                        
                                        <input type="text"  class="form-control" placeholder="https://www.whatsapp.com/" value="<?php echo $value['wp']; ?>" name="wp">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                <label class="form-label" for="bs-validation-name">LinkedIn</label>
                                    <div class="mb-3">
                                      
                                        <input type="text"  class="form-control" placeholder="https://in.linkedin.com/" value="<?php echo $value['link']; ?>" name="link">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                <label class="form-label" for="bs-validation-name">Youtube</label>
                                    <div class="mb-3">
                                       
                                        <input type="text"  class="form-control" placeholder="https://www.youtube.com/" value="<?php echo $value['yt']; ?>" name="yt">
                                    </div>
                                </div>
                            </div>
                            <h6>Color Settings</h6>
                            <div class="row color-box-div">
                                <div class="col-md-3">
                                <label class="form-label" for="bs-validation-name">Background Primary Color</label>
                                    <div class="mb-3">
                                       
                                        <input type="color" class="form-control color-style" placeholder="Background Primary Color"
                                            value="<?php echo $value['bpcolor']; ?>" name="bpcolor">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                <label class="form-label" for="bs-validation-name">Background Secondary Color</label>
                                    <div class="mb-3">
                                        
                                        <input type="color" class="form-control color-style" placeholder="Background Secondary Color"
                                            value="<?php echo $value['bscolor']; ?>" name="bscolor">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                <label class="form-label" for="bs-validation-name">Primary Color</label>
                                    <div class="mb-3">
                                        
                                        <input type="color" class="form-control color-style" placeholder="Background Secondary Color"
                                            value="<?php echo $value['pcolor']; ?>" name="pcolor">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                <label class="form-label" for="bs-validation-name">Secondary Color</label>
                                    <div class="mb-3">
                                       
                                        <input type="color" class="form-control color-style" placeholder="Background Secondary Color"
                                            value="<?php echo $value['scolor']; ?>" name="scolor">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                <label class="form-label" for="bs-validation-name">Paragraph Secondary Color</label>
                                    <div class="mb-3">
                                       
                                        <input type="color" class="form-control color-style" placeholder="Background Secondary Color"
                                            value="<?php echo $value['paracolor']; ?>" name="paracolor">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                <label class="form-label" for="bs-validation-name">Title Color</label>
                                    <div class="mb-3">
                                        <input type="color" class="form-control color-style" placeholder="Background Secondary Color"
                                            value="<?php echo $value['tcolor']; ?>" name="tcolor">
                                    </div>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-md-6">
                                    <label class="form-label" for="bs-validation-name">Email</label>
                                        <div class="mb-3">
                                            
                                            <button type="button" name="add" id="add"  required class="btn btn-success btn-xs">+</button>
                                            <table class="table table-bordered" id="dynamic_field">
                                                <?php foreach ($edit_details1 as $value2) { ?>
                                                <tr>
                                                    <input type="hidden" class="form-control" id="id" name="ide" value="<?php echo $value2['id']; ?>">
                                                    <td><input type="email" id="imgb"  name="package_name[]" multiple value="<?php echo $value2['email']; ?>"  placeholder="Email" class="form-control name_list" /></td>
                                                    <td><button type="button" onclick="deleteImage('<?php echo $value2['id']; ?>')" class="btn btn-danger  btn-xs btn_remove3">X</button></td>
                                                </tr>
                                                <?php } ?>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    <label class="form-label" for="bs-validation-name">Contacts</label>
                                        <div class="mb-3">
                                           
                                            <td><button type="button" name="add1" id="add1" required class="btn btn-success btn-xs">+</button></td>
                                            <table class="table table-bordered" id="dynamic_field1">
                                                <?php foreach ($edit_details2 as $value3) { ?>
                                                <tr>
                                                    <input type="hidden" class="form-control" id="id" name="idc" value="<?php echo $value3['id']; ?>">
                                                    <td><input type="text" required name="package_name1[]" multiple value="<?php echo $value3['contact']; ?>" id="con" placeholder="Contact" class="form-control name_list" pattern="[789][0-9]{9}" title="Enter Valid Contact Number"/></td>
                                                    <td><button type="button" onclick="deleteContact('<?php echo $value3['id']; ?>')" class="btn btn-danger  btn-xs btn_remove3">X</button></td>
                                                </tr>
                                                <?php } ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-end">
                                        <button type="submit" id="edit-setting-btn" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
                <?php endforeach; ?>
                
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="https://cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/additional-methods.js"></script>
<script>
    function preview() {
        var fileInput = document.getElementById('file');
        var filePath = fileInput.value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.webp|\.png)$/i;
        if (!allowedExtensions.exec(filePath)) {
            alert('Please upload file having extensions .jpeg/.jpg/.webp/ only.');
            fileInput.value = '';
            return false;
        } else {
            //Image preview
            imgb.src = URL.createObjectURL(event.target.files[0]);
        }
    }
    
</script>
<script>
    function preview1() {
        var fileInput = document.getElementById('file1');
        var filePath = fileInput.value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.webp|\.png)$/i;
        if (!allowedExtensions.exec(filePath)) {
            alert('Please upload file having extensions .jpeg/.jpg/.webp/ only.');
            fileInput.value = '';
            return false;
        } else {
            //Image preview
            imgbb.src = URL.createObjectURL(event.target.files[0]);
        }
    }
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var i = 1;
    
        $('#add').click(function () {
            i++;
            $('#dynamic_field').append('<tr id="row' + i + '" class="dynamic-added"><td style="border-width: 0;"><input type="email" style="border-width: 1px;" name="package_name[]" multiple placeholder="Email" class="form-control name_list" required /></td><td style="border-width: 0;"><button type="button" name="remove" id="' + i + '" class="btn btn-danger  btn-xs btn_remove">X</button></td></tr>');
        });
    
        $(document).on('click', '.btn_remove', function () {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });
    
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var i1 = 1;
    
        $('#add1').click(function () {
            i1++;
            $('#dynamic_field1').append('<tr class="row1" id="row1' + i1 + '" class="dynamic-added111"><td style="border-width: 0;"><input type="text" style="border-width: 1px;" name="package_name1[]" multiple placeholder="Contact" class="form-control name_list" required pattern="[789][0-9]{9}" title="Enter Valid Contact Number"/></td><td style="border-width: 0;"><button type="button" name="remove1" id="' + i1 + '" class="btn btn-danger btn-xs btn_remove2">X</button></td></tr>');
        });
    
        $(document).on('click', '.btn_remove2', function () {
            var button_id = $(this).attr("id");
            $('#row1' + button_id + '').remove();
        });
    
    });
    $(document).ready(function () {
    
    $('.name_list').each(function() {  // <- multiple fields at once needs '.each()'
    $(this).rules('add', {
        required: true, 
     digits: true
    });
    });
    })
</script>