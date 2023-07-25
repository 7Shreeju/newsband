<!-- Content -->
<?php foreach ($edit_details as $value) : ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row mb-4">
        <!-- Browser Default -->
        <div class="col-md mb-4 mb-md-0">
            <div class="card">
                <h5 class="card-header"> Edit E-Paper</h5>
                <div class="card-body">
                    <?php if($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <?php echo $this->session->flashdata('success'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                        <div class="form_error">
                            <?php echo validation_errors(); ?>
                        </div>
                    </div>
                    <?php }elseif($this->session->flashdata('warning')){ ?> 
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <?php echo $this->session->flashdata('warning'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                        <div class="form_error">
                            <?php echo validation_errors(); ?>
                        </div>
                    </div>
                    <?php }?>
                    
                    <form id="myform2" action="<?php echo base_url(); ?>edit-pro" method="post" enctype="multipart/form-data" >
                       
                       <div class="row">
                          <div class="col-md-6">
                             <div class="mb-3">
                                <label class="form-label" for="bs-validation-name">Title</label>
                                <input type="text" class="form-control" value="<?php echo $value['name']; ?>" name="name" placeholder="Enter Title">
                             </div>
                          </div>
                          <div class="col-md-6">
                             <div class="mb-3">
                                <label class="form-label" for="bs-validation-upload-file">Upload Pdf</label>
                                <input type="file" class="form-control" name="pdf" id="pdf"  onchange="pdf()"  accept="application/pdf">
                                <?php
                                   if ($value['pdf'] != '') {
                                       ?>
                                <a  href="<?php echo $value['pdf_url']; ?>" target="_blank" >Download</a>
                                <?php
                                   }
                                   ?>
                             </div>
                          </div>
                       </div>
                       <div class="row">
                            <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="bs-validation-name" >Date</label>
                                        <input type="date" class="form-control" value="<?php echo $value['date']; ?>" placeholder="YYYY-MM-DD" name="date" id="flatpickr-date" > 

                                    </div>
                        </div>
                            <div class="col-md-6">
                              <div class="mb-3">
                                 <label class="form-label" for="bs-validation-upload-file">Featured Image</label>
                                 <span style="color:red;font-size:12px">(Extension: JPG, JPEG, jpg, jpeg, webp) Note:Dimension Size 510*632px</span>
                                 <input type="file" onchange="preview()" id="file"  class="form-control" name="featured_image">
                              </div>
                              <div class="mb-3">
                                 <?php if ($value['featured_image'] != NULL) { ?>
                                 <img style="width: 100px" src="<?php echo base_url() ?>uploads/product/<?php echo $value['featured_image']; ?>" id="imgb">
                                 <?php }
                                    ?>
                              </div>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $value['id']; ?>">
                                <div class="card-footer p-0 text-end">
                                   <a href="<?php echo base_url();?>product-list" class="btn btn-secondary">Back</a>
                                    <button type="submit" id="updatpro-btn" class="btn btn-primary mr-1" type="submit">Update</button>
                                    
                                </div>
                            </div>
                        </div>
                    </form>
                
                
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="https://cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/additional-methods.js"></script>
<script>
    jQuery.validator.addMethod('ckrequired', function (value, element, params) {
        var idname = jQuery(element).attr('id');
        var messageLength = jQuery.trim(CKEDITOR.instances[idname].getData());
        return !params || messageLength.length !== 0;
    }, "Details field is required");
    $("#myform2").validate({
        ignore: [],
    
        rules: {
    
            name: {
                required: true,
    
            },
    
            briefinfo: {
                required: true,
    
            },
            description1: {
                ckrequired: true
            },
            date:{
                required: true,
            },
            
        },
        messages: {
            name: {
                required: "Name can not be empty"
    
            },
    
            briefinfo: {
                required: "Brief Intro Can Not be Empty."
    
            },
            category_id: {
                required: "Category Can Not be Empty."
    
            },
        }
    });
    
</script>
<script src="https://cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description1', {
        height: 200,
    
        filebrowserUploadUrl: "<?php echo site_url('upload_ckeditor'); ?>"
    });
    
</script>
<script>
    function preview() {
        var fileInput = document.getElementById('file');
        var filePath = fileInput.value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.webp)$/i;
        if (!allowedExtensions.exec(filePath)) {
            alert('Please upload file having extensions .jpeg/.jpg/.webp/ only.');
            fileInput.value = '';
            return false;
        } else {
            //Image preview
            $('.button').removeClass("hidden");
            imgb.src = URL.createObjectURL(event.target.files[0]);
        }
    }
    
</script>
<script>
    function preview1() {
        var fileInput = document.getElementById('file1');
        var filePath = fileInput.value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.webp)$/i;
        if (!allowedExtensions.exec(filePath)) {
            alert('Please upload file having extensions .jpeg/.jpg/.webp/ only.');
            fileInput.value = '';
            return false;
        } else {
            //Image preview
            $('.button').removeClass("hidden");
            imgbb.src = URL.createObjectURL(event.target.files[0]);
        }
    }
    
</script>
<script>
    function pdf(input) {
        debugger;
        var validExtensions = ['pdf', 'PDF'];
        //   var validExtensions = ['jpg','png','jpeg','JPG','JPEG','PNG']; //array of valid extensions
        var fileName = input.files[0].name;
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt, validExtensions) == -1) {
            input.type = ''
            input.type = 'file'
            $('#pdf').attr('src', "");
            alert("Only these file types are accepted : " + validExtensions.join(', '));
        } else
        {
            if (input.files && input.files[0]) {
                var filerdr = new FileReader();
                filerdr.onload = function (e) {
                    $('#pdf').attr('src', e.target.result);
                }
                filerdr.readAsDataURL(input.files[0]);
            }
        }
    }
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('select[name="category_id"]').on('change', function () {
            var stateID = $(this).val();
            if (stateID) {
                $.ajax({
                    url: '<?php echo base_url(); ?>myformAjax/' + stateID,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="subcategory_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="subcategory_id"]').append('<option value="">Select Sub Category</option>');
                            $('select[name="subcategory_id"]').append('<option value="' + value.id + '">' + value.subcategory + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="subcategory_id"]').empty();
            }
        });
    });
</script>