<style>

    .my-color-box {
        width: 30%;
        padding: 0;
        border-radius: 0;
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row mb-4">
        <div class="col-md mb-4 mb-md-0">
            <div class="card">
                <h5 class="card-header">Admin Panel Setting Page</h5>

                <div class="card-body">
                    <form class="edit-setting" method="post">
                        <?php foreach ($user_details as $value) : ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label" for="bs-validation-name">Admin Panel Logo</label>
                                    <span style="color:red;font-size:12px">(Extension: JPG, JPEG, jpg, jpeg) Note:Dimension Size 150*65px</span>
                                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $value['id']; ?>">
                                    <div class="mb-3">
                                        <div class="form-group ">


                                            <input type="file" onchange="preview()" class="form-control" id="file" name="logo">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <?php if ($value['logo_url'] != NULL) { ?>
                                            <img   src="<?php echo base_url(); ?>uploads/img/<?php echo $value['logo']; ?>" style="width: 100px;" id="thumb">
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="bs-validation-name">Admin Panel Fav icon</label>
                                    <span style="color:red;font-size:12px">(Extension: JPG, JPEG, jpg, jpeg) Note:Dimension Size 150*65px</span>
                                    <div class="mb-3">

                                        <input type="file" onchange="preview1()" class="form-control" id="file1" name="favicon">
                                    </div>
                                    <div class="mb-3">
                                        <?php if ($value['fav_url'] != NULL) { ?>
                                            <img  src="<?php echo base_url(); ?>uploads/img/<?php echo $value['favicon']; ?>" id="thumb1" style="width: 100px;">
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                                <!--                                <h6>Social Links</h6>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label>Facebook</label>
                                                                            <input type="text" placeholder="https://www.facebook.com/" class="form-control" value="<?php echo $value['fb']; ?>" name="fb">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label>Instagram</label>
                                                                            <input type="text"  class="form-control"  placeholder="https://www.instagram.com/"  value="<?php echo $value['insta']; ?>" name="insta">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label>Twitter</label>
                                                                            <input type="text"  class="form-control" placeholder="https://twitter.com/" value="<?php echo $value['twitter']; ?>" name="twitter">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label>Whatsapp</label>
                                                                            <input type="text"  class="form-control" placeholder="https://www.whatsapp.com/" value="<?php echo $value['wp']; ?>" name="wp">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label>LinkedIn</label>
                                                                            <input type="text"  class="form-control" placeholder="https://in.linkedin.com/" value="<?php echo $value['link']; ?>" name="link">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label>Youtube</label>
                                                                            <input type="text"  class="form-control" placeholder="https://www.youtube.com/" value="<?php echo $value['yt']; ?>" name="yt">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <h6>Common SEO</h6>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label>Meta Title</label>
                                                                            <input type="text"  class="form-control" placeholder="Meta Title" value="<?php echo $value['metatitle']; ?>" name="metatitle">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label>Meta Description</label>
                                                                            <input type="text"  class="form-control" placeholder="Meta Description" value="<?php echo $value['metades']; ?>" name="metades">
                                                                        </div>
                                                                    </div>
                                                                </div>-->
                                <h6>Color Settings</h6>
                                <div class="row color-box-div">
                                    <div class="col-md-4">
                                        <label class="form-label" for="bs-validation-name">Background Primary Color</label>
                                        <div class="mb-3">

                                            <input type="color" class="form-control color-style my-color-box" placeholder="Background Primary Color"
                                                   value="<?php echo $value['bpcolor']; ?>" name="bpcolor">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="bs-validation-name">Background Secondary Color</label>
                                        <div class="mb-3">

                                            <input type="color" class="form-control color-style my-color-box" placeholder="Background Secondary Color"
                                                   value="<?php echo $value['bscolor']; ?>" name="bscolor">
                                        </div>
                                    </div>


                                </div>

                                <hr>

                                <h6>SMTP Email Settings</h6>
                                <div class="row color-box-div">
                                    <div class="col-md-6">
                                        <label class="form-label" for="bs-validation-name">Host Name</label>
                                        <div class="mb-3">

                                            <input type="text" class="form-control" placeholder="SMTP Host Name"
                                                   value="<?php echo $value['smtp_host']; ?>" name="smtp_host">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="bs-validation-name">Port</label>
                                        <div class="mb-3">

                                            <input type="text" class="form-control" placeholder="SMTP Port"
                                                   value="<?php echo $value['smtp_port']; ?>" name="smtp_port">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="bs-validation-name">User Name</label>
                                        <div class="mb-3">

                                            <input type="text" class="form-control" placeholder="User Name"
                                                   value="<?php echo $value['smtp_user']; ?>" name="smtp_user">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="bs-validation-name">Password</label>
                                        <div class="mb-3">

                                            <input type="text" class="form-control" placeholder="SMTP Password"
                                                   value="<?php echo $value['smtp_pass']; ?>" name="smtp_pass">
                                        </div>
                                    </div>

                                </div>
                                <div class="row p-0">
                                    <div class="col-12 text-end">
                                        <button type="submit" id="edit-setting-btn" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
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