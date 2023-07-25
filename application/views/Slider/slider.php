

<?php foreach ($edit_details as $value) : ?>


    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mb-4">
            <!-- Browser Default -->
            <div class="col-md mb-4 mb-md-0">
                <div class="card"> <h5 class="card-header">  <?php echo $page_name; ?>
                    </h5>

                    <div class="card-body">
                        <form class="update-slider" method="post" enctype="multipart/form-data" >

                            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $value['id']; ?>">

                           
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="bs-validation-name">Question</label>
                                        <input type="text" name="question" value="<?php echo $value['question']; ?>" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="bs-validation-name">Response 1:</label>
                                        <textarea name="resp1" value="" class="form-control"><?php echo $value['resp1']; ?></textarea>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="bs-validation-name">Name 1</label>
                                        <input type="text" name="name1" value="<?php echo $value['name1']; ?>" class="form-control">

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="bs-validation-name">Image 1</label>
                                        <input type="file" class="form-control" name="slider1_img" id="file" onchange="preview()">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <?php if ($value['slider1_img'] != NULL) { ?>
                                            <img style="width: 100px" src="<?php echo base_url() ?>uploads/slider1/<?php echo $value['slider1_img']; ?>" id="imgb" alt="Silder 1">
                                             <button type="button" class="btn btn-xs deletegalim" data-id="<?php echo $value['id']; ?>" data-info="<?php echo 'img1';  ?>"><i class="fa fa-window-close"></i></button>
                                        <?php }
                                        ?>

                                    </div>  
                                </div>
                            </div>
                            
                          
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="bs-validation-name">Response 2:</label>
                                        <input type="text" name="resp2" value="<?php echo $value['resp2']; ?>" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="bs-validation-name">Name</label>
                                        <input type="text" name="name2" value="<?php echo $value['name2']; ?>" class="form-control">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="bs-validation-name">Image 2</label>
                                        <input type="file" class="form-control" name="slider2_img" id="file1" onchange="preview1()">
                                    </div>
                                </div>
                                <div class="col-md-6">


                                    <div class="mb-3">
                                        <?php if ($value['slider2_img'] != NULL) { ?>
                                            <img style="width: 100px" src="<?php echo base_url() ?>uploads/slider2/<?php echo $value['slider2_img']; ?>" id="imgbb" alt="Silder 2">
                                           <button type="button" class="btn btn-xs deletegalim" data-id="<?php echo $value['id']; ?>" data-info="<?php echo 'img2';  ?>" ><i class="fa fa-window-close"></i></button>                                       
 <?php }
                                        ?>

                                    </div>  
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-12 text-end">
                                    <button type="submit" id="updatslider-btn"  class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>
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

    function preview2() {
        var fileInput = document.getElementById('file2');
        var filePath = fileInput.value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.webp)$/i;
        if (!allowedExtensions.exec(filePath)) {
            alert('Please upload file having extensions .jpeg/.jpg/.webp/ only.');
            fileInput.value = '';
            return false;
        } else {
            //Image preview
            $('.button').removeClass("hidden");
            imgbbb.src = URL.createObjectURL(event.target.files[0]);
        }
    }
</script>
