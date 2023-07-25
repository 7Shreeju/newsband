$('.add-link').on('submit', function(event) {
    event.preventDefault();
    $.ajax({
        url: "add-link",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('#addlink-btn').html('Processing...');
            $("#addlink-btn").attr("disabled", true);
        },
        success: function(data) {
            console.log(data);
            var data = jQuery.parseJSON(data);
            if (data.error) {
                if (data.title_error != '') {
                    $('#title_error').html(data.title_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#title_error').html('');
                }

                if (data.name_error != '') {
                    $('#name_error').html(data.name_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#name_error').html('');
                }
                $('#addlink-btn').html('Submit');
                $("#addlink-btn").attr("disabled", false);
            }

            if (data.success) {

                $.toast({
                    heading: 'Success',
                    text: data.success,
                    icon: 'success',
                    loader: true,
                    position: 'top-right',
                    afterHidden: function () {
                        window.location.reload();
        
        
                       }
                   
                    })
             

            }
        }
    });
});




    $(document).on('click', '.fetch-link', function (event) {
        event.preventDefault();
    var wrap_html = "";
    var id = $(this).attr("data-id");
    console.log(id);
    $.ajax({
        url: "retrive-link",
        type: "POST",
        dataType: "json",
        data: { 'id': id },
        success: function(data) {
            console.log(data);
            $('#blogtitle').val(data.blog_title);
            $('#link').val(data.link);

            $('#id').val(data.id);
        }
    });
});


$('.update-link').on('submit', function(event) {
    event.preventDefault();
    $.ajax({
        url: "edit-link",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('#updalink-btn').html('Processing...');
            $("#updalink-btn").attr("disabled", true);
        },
        success: function(data) {
            console.log(data);
            var data = jQuery.parseJSON(data);
            if (data.error) {
                if (data.title11_error != '') {
                    $('#title11_error').html(data.title11_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#title11_error').html('');
                }

                if (data.name11_error != '') {
                    $('#name11_error').html(data.name11_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#name11_error').html('');
                }

                $('#updalink-btn').html('Submit');
                $("#updalink-btn").attr("disabled", false);
            }
            if (data.success) {
                $.toast({
                    heading: 'Success',
                    text: data.success,
                    icon: 'success',
                    loader: true,
                    position: 'top-right',
                    afterHidden: function () {
                        window.location.reload();
        
        
                       }
                   
                    })
              


            }
        }
    });
});




    $(document).on('click', '.delete-link', function (event) {
        event.preventDefault();
    var id = $(this).attr("data-id");


    Swal.fire({
            title: "Are you sure?",
            text:"Once deleted, you will not be able to recover",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, delete it!",
            customClass: {
                confirmButton: "btn btn-primary me-3",
                cancelButton: "btn btn-label-secondary"
            },
            buttonsStyling: !1
        }).then(function(t) {
            t.value ?
                $.ajax({
                    url: "delete-link",
                    type: "POST",
                    dataType: "json",
                    data: { 'id': id },
                    success: function(data) {
                        if (data.success) {
                            $.toast({
                                heading: 'Deleted',
                                text: data.success,
                                icon: 'success',
                                loader: true,
                                position: 'top-right',
                                afterHidden: function () {
                                    window.location.reload();
                    
                    
                                   }
                               
                                })
                          
                        }
                    }
                }) : t.dismiss === Swal.DismissReason.cancel 
               
        })
      
});

$(document).on('click', '.status-link', function () {
      
    var id = $(this).attr("data-id");
    var status_id = $(this).attr("data-status");


   
            $.ajax({
                url: "status-link",
                type: "POST",
                dataType: "json",
                data: { 'id': id, 'status_id': status_id },
                success: function(data) {
                    if (data.success) {
                        $.toast({
                            heading: 'Success',
                            text: data.success,
                            icon: 'success',
                            loader: true,
                            position: 'top-right',
                            afterHidden: function () {
                                window.location.reload();
                
                
                               }
                           
                            })

                       
                    }
                }
          
    })

});


$("#links button").click(function (ev) {
    ev.preventDefault()
   
    if ($(this).attr("value") == "Delete") {  
      
       let form = document.getElementById('links');
        let formData = new FormData(form);
        Swal.fire({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover",
           
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, Delete it!",
            customClass: {
                confirmButton: "btn btn-primary me-3",
                cancelButton: "btn btn-label-secondary"
            },
            buttonsStyling: !1
        }).then(function(t) {
            t.value ?
        $.ajax({
            url: "delete_alllinks",
            method: "POST",
            data:  formData,
            contentType: false,
            cache: false,
            processData: false,
            
            success: function(data) {
                console.log(data);
                var data = jQuery.parseJSON(data);
               if (data.success) {
    
                $.toast({
                    heading: 'Success',
                    text: data.success,
                    icon: 'success',
                    loader: true,
                    position: 'top-right',
                    afterHidden: function () {
                        window.location.reload();
        
        
                       }
                   
                    })

                   
                    }
                    if (data.error) {
    
                        $.toast({
                            heading: 'Error',
                            text: data.error,
                            icon: 'error',
                            loader: true,
                            position: 'top-right',
                            afterHidden: function () {
                                window.location.reload();
                
                
                               }
                           
                            })

                      
                        }
            }
        }) : t.dismiss === Swal.DismissReason.cancel 

        });
   
   
    }
    if ($(this).attr("value") == "Status") {
        let form = document.getElementById('links');
        let formData = new FormData(form);
        Swal.fire({
            title: "Are you sure?",
      
            icon: "warning",
            showCancelButton: true,
            showDenyButton: true,
            confirmButtonText: "Activate",
            denyButtonText: "Deactivated",
            customClass: {
                confirmButton: "btn btn-success ",
                denyButton: "btn btn-danger ",
                cancelButton: "btn btn-info",
            },
            buttonsStyling: !1
        }).then((result) =>{
            if(result.isConfirmed){
        $.ajax({
            url: "status_alllinks",
            method: "POST",
            data:  formData,
            contentType: false,
            cache: false,
            processData: false,
            
            success: function(data) {
                console.log(data);
                var data = jQuery.parseJSON(data);
               if (data.success) {
    
                
                $.toast({
                    heading: 'Success',
                    text: data.success,
                    icon: 'success',
                    loader: true,
                    position: 'top-right',
                    afterHidden: function () {
                        window.location.reload();
        
        
                       }
                   
                    })

                  
                    }
                    if (data.error) {
    
                        $.toast({
                            heading: 'error',
                            text: data.error,
                            icon: 'error',
                            loader: true,
                            position: 'top-right',
                            afterHidden: function () {
                                window.location.reload();
                
                
                               }
                           
                            })

                       
                        }
            }
        }) 
      } else if (result.isDenied) {
            $.ajax({
                url: "status_alllinksdde",
                method: "POST",
                data:  formData,
                contentType: false,
                cache: false,
                processData: false,
                
                success: function(data) {
                    console.log(data);
                    var data = jQuery.parseJSON(data);
                   if (data.success) {
                    $.toast({
                        heading: 'Success',
                        text: data.success,
                        icon: 'success',
                        loader: true,
                        position: 'top-right',
                        afterHidden: function () {
                            window.location.reload();
            
            
                           }
                       
                        })

                      
                        }
                        if (data.error) {
                            $.toast({
                                heading: 'error',
                                text: data.error,
                                icon: 'error',
                                loader: true,
                                position: 'top-right',
                                afterHidden: function () {
                                    window.location.reload();
                    
                    
                                   }
                               
                                })
                            }
                }
        })
    }else{
       
       
     
       }
     });
    }
  });
