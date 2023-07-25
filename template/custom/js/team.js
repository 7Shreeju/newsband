$('.add-team').on('submit', function (event) {
    event.preventDefault();
    $.ajax({
        url: "insert-teams",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $('#addteam-btn').html('Processing...');
            $("#addteam-btn").attr("disabled", true);
        },
        success: function (data) {
            console.log(data);
            var data = jQuery.parseJSON(data);
            if (data.error) {

                if (data.name_error != '') {
                    $('#name_error').html(data.name_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#name_error').html('');
                }

                if (data.image_error != '') {
                    $('#image_error').html(data.image_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#image_error').html('');
                }
                if (data.designation_error != '') {
                    $('#designation_error').html(data.designation_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#designation_error').html('');
                }
                $('#addteam-btn').html('Submit');
                $("#addteam-btn").attr("disabled", false);

            }
            if (data.success) {

                $.toast({
                    heading: 'Success',
                    text: data.success,
                    icon: 'success',
                    loader: true,
                    position: 'top-right',
                    afterHidden: function () {
                        window.location.href = "team_list";
                    }

                })

            }
        }
    });
});



$('.fetch-team').on('click', function (event) {

    event.preventDefault();

    var wrap_html = "";

    var id = $(this).attr("data-id");

    console.log(id);

    $.ajax({

        url: "retrive-team",

        type: "POST",

        dataType: "json",

        data: {'id': id},

        success: function (data) {

            console.log(data.briefintro);

            $('#name').val(data.name);

            $('#designation').val(data.designation);

            $('#briefintro').html(data.briefintro);

            $('#id').val(data.id);

        }

    });

});

$('.update-team').on('submit', function (event) {
    event.preventDefault();
    $.ajax({
        url: "editteam",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $('#updateteam-btn').html('Submit');
            $("#updateteam-btn").attr("disabled", true);
        },
        success: function (data) {
            console.log(data);
            var data = jQuery.parseJSON(data);
            if (data.error) {
//                if (data.shortinfoteam_error != '') {
//                    $('#shortinfoteam_error').html(data.shortinfoteam_error);
//                    $(".invalid-feedback").css("display", "block");
//                } else {
//                    $('#shortinfoteam_error').html('');
//                }
                if (data.desoteam_error != '') {
                    $('#desoteam_error').html(data.desoteam_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#desoteam_error').html('');
                }
                if (data.nameteam_error != '') {
                    $('#nameteam_error').html(data.nameteam_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#nameteam_error').html('');
                }

                  $('#updateteam-btn').html('Submit');
            $("#updateteam-btn").attr("disabled", false); 

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
            if (data.warning) {

                $.toast({
                    heading: 'Warning',
                    text: data.warning,
                    icon: 'warning',
                    loader: true,
                    position: 'top-right',
                    afterHidden: function () {
                        
                   }

                })
                $('#updateteam-btn').html('Submit');
            $("#updateteam-btn").attr("disabled", false); 
               }
        }
    });
});


$(document).on('click', '.delete-team', function (event) {
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
    }).then(function (t) {
        t.value ?
                $.ajax({
                    url: "delete-team",
                    type: "POST",
                    dataType: "json",
                    data: {'id': id},
                    success: function (data) {
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




$(document).on('click', '.status-team', function () {

    var id = $(this).attr("data-id");
    var status_id = $(this).attr("data-status");



   
                $.ajax({
                    url: "status-team",
                    type: "POST",
                    dataType: "json",
                    data: {'id': id, 'status_id': status_id},
                    success: function (data) {
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


$("#team button").click(function (ev) {
    ev.preventDefault()
   
    if ($(this).attr("value") == "Delete") {  
      
       let form = document.getElementById('team');
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
            url: "delete_allteam",
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
        let form = document.getElementById('team');
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
            url: "status_allteam",
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
        }) 
      } else if (result.isDenied) {
            $.ajax({
                url: "status_allteamde",
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
        })
    }else{
       
        
       }
     });
    }
  });
  
  
  
  