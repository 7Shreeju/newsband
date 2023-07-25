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



<?php foreach ($edit_details as $value) : ?>



<div class="container-xxl flex-grow-1 container-p-y">





    <h4 class="fw-bold py-3 mb-4">

       Edit Author

    </h4>

    <div class="row mb-4">

        <!-- Browser Default -->

        <div class="col-md mb-4 mb-md-0">

            <div class="card">

                <div class="card-body">

                    <form class="update-auth" method="post" enctype="multipart/form-data" >



                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $value['id']; ?>">



                        <div class="row">

                            <div class="col-md-6">

                                <div class="mb-3">

                                    <label class="form-label" for="bs-validation-name">Name</label>

                                    <input type="text" class="form-control" placeholder="Name" value="<?php echo $value['name']; ?>" name="name"> 

                                    <div class="invalid-feedback" id="nameauthor_error"> </div>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="mb-3">

                                    <label class="form-label" for="bs-validation-name"> Image</label>

                                    <input type="file" class="form-control"  name="image" id="user_img"  onchange="show(this)">



                                    <div class="mb-3">
                                        </br>
                            <img style="width: 100px" src="<?php echo $value['image_url']; ?>"> 



                            </div>



                                </div>



                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="mb-3">

                                <label class="form-label" for="bs-validation-name">Description</label>

                                    <textarea class="form-control" name="shortinfo" placeholder="Description" ><?php echo $value['shortinfo']; ?> </textarea>

                                    <div class="invalid-feedback" id="bio1_error"> </div>

                                </div>

                            </div>
                        </div>
                           
                             
                    <div class="row">
                                <div class="col-12">
                                    <div class="text-end">
                                        <a class="btn btn-secondary" href="../author-list" class="btn btn-primary">Back</a>
                                         <button type="submit" id="updataut-btn"  class="btn btn-primary">Update</button>
                                        
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

<script src="https://cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>

<script>

    CKEDITOR.replace('editor1', {

        height: 200,



        filebrowserUploadUrl: "<?php echo site_url('upload_ckeditor'); ?>"

    });



</script>