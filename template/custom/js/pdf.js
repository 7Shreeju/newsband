$('.add-pdf').on('submit', function(event) {
    event.preventDefault();
    $.ajax({
        url: "add-pdf",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('#addpdf-btn').html('Processing...');
            $("#addpdf-btn").attr("disabled", true);
        },
        success: function(data) {
            console.log(data);
            var data = jQuery.parseJSON(data);
            if (data.error) {
                if (data.pdf_error != '') {
                    $('#pdf_error').html(data.pdf_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#pdf_error').html('');
                }
                if (data.name_error != '') {
                    $('#name_error').html(data.name_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#name_error').html('');
                }

                $('#addpdf-btn').html('Submit');
                $("#addpdf-btn").attr("disabled", false);
            }
            if (data.success) {

                $.toast({
                    heading: 'Success',
                    text: data.success,
                    icon: 'success',
                    loader: true,
                    position: 'top-right',
                    afterHidden: function () {
                        window.location.href="pdf-list";
        
        
                       }
                   
                    })

               

            }
        }
    });
});



$('.update-pdf').on('submit', function(event) {
    event.preventDefault();
    $.ajax({
        url: "editpdf",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('#updatpdf-btn').html('Processing...');
            $("#updatpdf-btn").attr("disabled", true);
        },
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
            if(data.error){
                if (data.name1_error != '') {
                    $('#name1_error').html(data.name1_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#name1_error').html('');
                }
                if (data.name2_error != '') {
                    $('#name2_error').html(data.name2_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#name2_error').html('');
                }
                if (data.name3_error != '') {
                    $('#name3_error').html(data.name3_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#name3_error').html('');
                }
                $('#updatpdf-btn').html('Update');
                $("#updatpdf-btn").attr("disabled", false);
            }
        }
    });
});


    $(document).on('click', '.delete-pdf', function (event) {
        event.preventDefault();
        debugger;
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
                url: "delete-pdf",
                type: "POST",
                dataType: "json",
                data: { 'id': id },
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
            }) : t.dismiss === Swal.DismissReason.cancel 
       
    })



});

    
    $(document).on('click', '.status-pdf', function () {
       
    var id = $(this).attr("data-id");
    var status_id = $(this).attr("data-status");



  
            $.ajax({
                url: "status-pdf",
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
                                window.location.href="pdf-list";
                
                
                               }
                           
                            })
                       
                    }
                }
           
           
            
           
    })

});

$("#pdf button").click(function (ev) {
    ev.preventDefault()
   
    if ($(this).attr("value") == "Delete") {  
      
       let form = document.getElementById('pdf');
        let formData = new FormData(form);
        Swal.fire({
            title: "Are you sure?",
            text:"Once deleted, you will not be able to recover",
           
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
            url: "delete_allpdf",
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
        let form = document.getElementById('pdf');
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
            url: "status_allpdf",
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
                url: "status_allpdfdde",
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
