<style>
    .hidden {
        display: none;
    }
</style>

<?php foreach ($edit_details as $value) : ?>


    <div class="container-xxl flex-grow-1 container-p-y">



        <div class="row mb-4">

            <!-- Browser Default -->

            <div class="col-md mb-4 mb-md-0">

                <div class="card">
                    <h5 class="card-header">Update Package Pricing </h5>

                    <div class="card-body">

                        <form class="update-pdf" method="post" enctype="multipart/form-data" >

                            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $value['id']; ?>">
                            <div class="row">    
                                <div class="col-md-12">
                                <label class="form-label" for="bs-validation-upload-file">Monthly:</label>
                                    <input type="text" id="name"value="<?php echo $value['month']?>" class="form-control" name="month">
                                     <div class="invalid-feedback" id="name1_error"> </div>

                                </div>
                                <div class="col-md-12">
                                <label class="form-label" for="bs-validation-upload-file">Half-yearly:</label>
                                    <input type="text" id="name"value="<?php echo $value['half']?>" class="form-control" name="half">
                                     <div class="invalid-feedback" id="name2_error"> </div>

                                </div>
                                <div class="col-md-12">
                                <label class="form-label" for="bs-validation-upload-file">Yearly:</label>
                                    <input type="text" id="name"value="<?php echo $value['year']?>" class="form-control" name="year">
                                     <div class="invalid-feedback" id="name3_error"> </div>

                                </div>
                                
                                
                            </div>
                            </br>
                          
                            <div class="row">    
                               
                                        <div class="col-12 text-end">
                                            
                                         
                                            <button type="submit" id="updatpdf-btn"  class="btn btn-primary">Update</button>
                                            
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

    function preview1() {
        var fileInput = document.getElementById('file1');
        var filePath = fileInput.value;
        var allowedExtensions = /(\.pdf)$/i;
        if (!allowedExtensions.exec(filePath)) {
            alert('Please upload file having extensions .pdf/ only.');
            fileInput.value = '';
            return false;
        }
    }

</script>
