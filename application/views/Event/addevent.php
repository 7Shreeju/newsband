

<?php foreach ($edit_details as $value) : ?>
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row mb-4">
            <!-- Browser Default -->
            <div class="col-md mb-4 mb-md-0">
                <div class="card">
                    <h5 class="card-header">  Edit Home Page Slider
                    </h5>
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
                        <form id="myform2"  action="<?php echo base_url(); ?>editeventupdate" method="post"  enctype="multipart/form-data" >
                            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $value['id']; ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Article 1:</label>
                                        <select class="form-control"  name="article1" >
                                            <option value="">Select Article</option>
                                            <?php foreach ($article as $value3) : ?>
                                                <option value="<?php echo $value3['id']; ?>" <?php echo $value3['id'] == $value['article1'] ? 'selected' : ''; ?>> <?php echo $value3['title']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>



                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Article 2:</label>
                                        <select class="form-control"  name="article2" >
                                            <option value="">Select Article</option>
                                            <?php foreach ($article as $value3) : ?>
                                                <option value="<?php echo $value3['id']; ?>" <?php echo $value3['id'] == $value['article2'] ? 'selected' : ''; ?>> <?php echo $value3['title']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Article 3:</label>
                                        <select class="form-control"  name="article3" >
                                            <option value="">Select Article</option>
                                            <?php foreach ($article as $value3) : ?>
                                                <option value="<?php echo $value3['id']; ?>" <?php echo $value3['id'] == $value['article3'] ? 'selected' : ''; ?>> <?php echo $value3['title']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                               <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Article 4:</label>
                                        <select class="form-control"  name="article4" >
                                            <option value="">Select Article</option>
                                            <?php foreach ($article as $value3) : ?>
                                                <option value="<?php echo $value3['id']; ?>" <?php echo $value3['id'] == $value['article4'] ? 'selected' : ''; ?>> <?php echo $value3['title']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>  
                               
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Article 5:</label>
                                        <select class="form-control"  name="article5" >
                                            <option value="">Select Article</option>
                                            <?php foreach ($article as $value3) : ?>
                                                <option value="<?php echo $value3['id']; ?>" <?php echo $value3['id'] == $value['article5'] ? 'selected' : ''; ?>> <?php echo $value3['title']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-end">
                                        
                                        
                                        <button type="submit"  class="btn btn-primary">Update</button>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
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




<!--<script src="<?php echo base_url(); ?>template/custom/js/blog.js?v=5"></script>-->


<script>




    $("#myform2").validate({
        ignore: [],

        rules: {

            article1: {
                required: true,

            },
            article2: {
                required: true,

            },
             article3: {
                    required: true,

                },
                article4: {
                    required: true,
                    
                },

            article5: {
                required: true,

            },

           


        },
   });




</script>




<script>

    function validateForm() {
        var message = document.forms["myform"]["description"].value;


        textbox_data = CKEDITOR.instances['description'].getData();

        if (textbox_data === '')
        {
            alert('Description Can not be blank');
            return(false);

