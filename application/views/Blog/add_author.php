<!-- Content -->

<script>



  function show(input) {

        debugger;

       var validExtensions = ['jpg','jpeg','JPG','JPEG','WEBP','webp']; 

     //   var validExtensions = ['jpg','png','jpeg','JPG','JPEG','PNG']; //array of valid extensions

        var fileName = input.files[0].name;

        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);

        if ($.inArray(fileNameExt, validExtensions) == -1) {

            input.type = ''

            input.type = 'file'

            $('#user_img').attr('src',"");

            alert("Only these file types are accepted : "+validExtensions.join(', '));

        }

        else

        {

        if (input.files && input.files[0]) {

            var filerdr = new FileReader();

            filerdr.onload = function (e) {

                $('#user_img').attr('src', e.target.result);

            }

            filerdr.readAsDataURL(input.files[0]);

        }

        }

    }

</script>



<script>



  function show1(input) {

        debugger;

      var validExtensions = ['jpg','jpeg','JPG','JPEG','WEBP','webp']; 

     //   var validExtensions = ['jpg','png','jpeg','JPG','JPEG','PNG']; //array of valid extensions

        var fileName = input.files[0].name;

        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);

        if ($.inArray(fileNameExt, validExtensions) == -1) {

            input.type = ''

            input.type = 'file'

            $('#user_img1').attr('src',"");

            alert("Only these file types are accepted : "+validExtensions.join(', '));

        }

        else

        {

        if (input.files && input.files[0]) {

            var filerdr = new FileReader();

            filerdr.onload = function (e) {

                $('#user_img1').attr('src', e.target.result);

            }

            filerdr.readAsDataURL(input.files[0]);

        }

        }

    }

</script>

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row mb-4">
        <!-- Browser Default -->
        <div class="col-md mb-4 mb-md-0">
            <div class="card">
                <h5 class="card-header">  <?php echo $page_name; ?>
                </h5>
                <div class="card-body">
                    <form class="add-authorr" method="post" enctype="multipart/form-data" >



                     

                        <div class="row">

                            <div class="col-md-6">

                                <div class="mb-3">

                                    <label class="form-label" for="bs-validation-name">Name</label>

                                    <input type="text" class="form-control" placeholder="Name" name="name"> 

                                    <div class="invalid-feedback" id="name_error"> </div>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="mb-3">

                                    <label class="form-label" for="bs-validation-name"> Image</label>

                                    <input type="file" class="form-control"  name="image" id="user_img"  onchange="show(this)">

                                    <div class="invalid-feedback" id="img_error"> </div>

                                </div>



                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="mb-3">

                                <label class="form-label" for="bs-validation-name">Description</label>

                                    <textarea class="form-control" name="shortinfo" placeholder="Description" ></textarea>

                                    <div class="invalid-feedback" id="bio_error"> </div>

                                </div>

                            </div>
                        </div>

                          





                        

                   
                        <div class="row">
                                <div class="col-12">
                                    <div class="text-end">
                                        
                                        <a class="btn btn-secondary"   href="<?php echo base_url(); ?>author-list">Back</a>
                                        <button type="submit" id="addauthorr-btn"  class="btn btn-primary">Add</button>
                                    </div>
                                </div>
                            </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>

<script>

    CKEDITOR.replace('editor1', {

        height: 200,



        filebrowserUploadUrl: "<?php echo site_url('upload_ckeditor'); ?>"

    });



</script>