$('.add-testimonial').on('submit', function(event) {
    event.preventDefault();
    $.ajax({
        url: "insert-testimonials",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('#addtes-btn').html('Processing...');
            $("#addtes-btn").attr("disabled", true);
        },
        success: function(data) {
            console.log(data);
            var data = jQuery.parseJSON(data);
            if (data.error) {

                if (data.name_error != '') {
                    $('#name_error').html(data.name_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#name_error').html('');
                }

                if (data.shortinfo_error != '') {
                    $('#shortinfo_error').html(data.shortinfo_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#shortinfo_error').html('');
                }

                $('#addtes-btn').html('Submit');
                $("#addtes-btn").attr("disabled", false);

            }
            if (data.success) {

                $.toast({
                    heading: 'Success',
                    text:data.success,
                    icon: 'success',
                    loader: true,
                    position: 'top-right',
                    afterHidden: function () {
                        window.location.href = "testimonial_list";
                    }
                   
                    })

            }
        }
    });
});



$('.fetch-test').on('click', function(event) {

    event.preventDefault();

    var wrap_html = "";

    var id = $(this).attr("data-id");

    console.log(id);

    $.ajax({

        url: "retrive-test",

        type: "POST",

        dataType: "json",

        data: { 'id': id },

        success: function(data) {

            console.log(data.shortinfo);

            $('#name').val(data.name);

            $('#designation').val(data.designation);

            $('#shortinfo').html(data.shortinfo);

            $('#id').val(data.id);

        }

    });

});

$('.update-testimonial').on('submit', function(event) {
    event.preventDefault();
    $.ajax({
        url: "edittestimonial",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('#updatetest-btn').html('Submit');
            // $("#updatetest-btn").attr("disabled", true);
        },
        success: function(data) {
            console.log(data);
            var data = jQuery.parseJSON(data);
            if (data.error) {
                if (data.nametest_error != '') {
                    $('#nametest_error').html(data.nametest_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#nametest_error').html('');
                }

                

                if (data.shortinfotest_error != '') {
                    $('#shortinfotest_error').html(data.shortinfotest_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#shortinfotest_error').html('');
                }


            }
            if (data.success) {

                $.toast({
                    heading: 'Success',
                    text:data.success,
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
                    text:data.warning,
                    icon: 'warning',
                    loader: true,
                    position: 'top-right',
                    afterHidden: function () {
                       
                    }
                   
                    })


            }
        }
    });
});


    $(document).on('click', '.delete-testimonial', function (event) {
        event.preventDefault();
    var id = $(this).attr("data-id");



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
                url: "delete-testimonial",
                type: "POST",
                dataType: "json",
                data: { 'id': id },
                success: function(data) {
                    if (data.success) {
                        
                        $.toast({
                            heading: 'Deleted',
                            text:data.success,
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

    $(document).on('click', '.addp', function (event) {
        event.preventDefault();
    
    var id = $(this).attr("data-id");
    $.ajax({
        url: "addp",
        type: "POST",
        dataType: "json",
        data: { 'id': id },
        success: function(data) {
            console.log(data);
        
            if (data.success) {
                $.toast({
                    heading: 'Success',
                    text: data.success,
                    icon: 'success',
                    loader: true,
                    position: 'top-right',
                    afterHidden: function () {
                        window.location.href = "add1-privilege";
    
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
                        window.location.href = "users";
    
                    }
                   
                    })

              
            }
        }
    });
});



    $(document).on('click', '.status-testimonial', function () {
       
    var id = $(this).attr("data-id");
    var status_id = $(this).attr("data-status");
  $.ajax({
                url: "status-testimonial",
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


//need to use onclick button function for jquery validation 

$("#myform button").click(function (ev) {
    ev.preventDefault()
    
    if ($(this).attr("value") == "Delete") {  
       // var form_data = new FormData(document.getElementById("myform"));
       let form = document.getElementById('myform');
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
            url: "delete_all",
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
        let form = document.getElementById('myform');
        let formData = new FormData(form);
        Swal.fire({
            title: "Are you sure?",
      
            icon: "warning",
            showCancelButton: true,
            showDenyButton: true,
            confirmButtonText: "Yes, change it to Active",
            denyButtonText: "Yes, change it to DeActive",
            customClass: {
                confirmButton: "btn btn-success ",
                denyButton: "btn btn-danger ",
                cancelButton: "btn btn-info",
            },
            buttonsStyling: !1
        }).then((result) =>{
            if(result.isConfirmed){
        $.ajax({
            url: "status_all",
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
                url: "status_allde",
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
  //for all pages
function toggle_check(){
     var checkboxes = document.getElementsByName('checkbox_value[]');
     var button = document.getElementById('toggle');                                                                               
     if(button.value == 'Select All'){
        for(var i in checkboxes){
            checkboxes[i].checked='FALSE';
        }
        button.value ='Deselect';
        $("#status").show();
        $("#sta").hide();
        $("#delete_all").show();
        
     }
      else{
          for(var i in checkboxes){
            checkboxes[i].checked='';
              }
          button.value = 'Select All';
          $("#status").hide();
          $("#sta").show();
          $("#delete_all").hide();
      }
 }


 ///sub admin crud  
//  $('.subadmin').on('submit', function(event) {
//     event.preventDefault();
//     $.ajax({
//         url: "insert-subadmin",
//         method: "POST",
//         data: new FormData(this),
//         contentType: false,
//         cache: false,
//         processData: false,
//         beforeSend: function() {
//             $('#add-subadmin').html('add');
//             $("#add-subadmin").attr("disabled", true);
//         },
//         success: function(data) {
//             console.log(data);
//             var data = jQuery.parseJSON(data);
//             if (data.error) {
//                 if (data.name_error != '') {
//                     $('#name_error').html(data.name_error);
//                     $(".invalid-feedback").css("display", "block");
//                 } else {
//                     $('#name_error').html('');
//                 }
//                 if (data.password_error != '') {
//                     $('#password_error').html(data.password_error);
//                     $(".invalid-feedback").css("display", "block");
//                 } else {
//                     $('#password_error').html('');
//                 }
//                 if (data.email_error != '') {
//                     $('#email_error').html(data.email_error);
//                     $(".invalid-feedback").css("display", "block");
//                 } else {
//                     $('#email_error').html('');
//                 }
                

//                 if (data.role_error != '') {
//                     $('#role_error').html(data.role_error);
//                     $(".invalid-feedback").css("display", "block");
//                 } else {
//                     $('#role_error').html('');
//                 }
//                 $('#add-subadmin').html('Add');
//                 $("#add-subadmin").attr("disabled", false);

//             }
//             if (data.success) {
//                 Swal.fire({
//                     position: "Success",
//                     icon: "success",
//                     title: data.success,
//                     showConfirmButton: !1,
//                     timer: 1500,
//                     customClass: {
//                         confirmButton: "btn btn-primary"
//                     },
//                     buttonsStyling: !1
//                 }).then(function() {
//                     window.location.href= "users";


//                 });

//             }
//         }
//     });
// });
(function($) {
    "use strict";
    var value = $("#password").val();

    $.validator.addMethod("checklower", function(value) {
        return /[a-z]/.test(value);
    });
    $.validator.addMethod("checkupper", function(value) {
        return /[A-Z]/.test(value);
    });
    $.validator.addMethod("checkdigit", function(value) {
        return /[0-9]/.test(value);
    });
    $.validator.addMethod("checkchar", function(value) {
        return /[!@#$%&*]/.test(value);
    });
    jQuery.validator.addMethod("noSpace", function(value, element) {
        return value.indexOf(" ") < 0 && value != "";
    }, "No space please and don't leave it empty");


$(function() {
   
    $("#subadmin-form").validate({
        rules: {
            email: {
                required: true,
                noSpace: true,
                email: true
            },
            name:{
                required: true,
            },
            role:{
                required: true,  
            },
            password: {
                required: true,
                noSpace: true,
                minlength: 8,
                maxlength: 32,
                checklower: true,
                checkupper: true,
                checkchar: true,
                checkdigit: true
            }
        },
        messages: {
            password: {
                required: 'Password can not be empty.',
                checklower: "Need atleast One Lowercase Alphabet",
                checkupper: "Need atleast One Uppercase Alphabet",
                checkdigit: "Need atleast One Digit",
                checkchar: "Need atleast One Special Character"
            },
            email: {
                required: 'Email can not be empty.',
                email: 'Please enter a valid email address.'
            },
            role:{
                required: 'Role can not be empty.',
                
            },
            name:{
                required: 'Name can not be empty.',
                
            }

        },
        submitHandler: function(form) {
            console.log(form);
            var name = $("#name").val();
            var password = $("#password").val();
            var email = $("#email").val();
            var role = $("#role").val();
            $.ajax({
                url: "insert-subadmin",
                method: "POST",
                dataType: "json",
                data: { role: role, password: password, email: email, name: name },
                beforeSend: function() {
                    $('#add-subadmin').html('Processing...');
                    $("#add-subadmin").attr("disabled", true);
                },
                success: function(data) {
                    console.log(data);
                    if (data.error) {

                        $.toast({
                            heading: 'error',
                            text: "Sub Admin already exist.",
                            icon: 'error',
                            loader: true,
                            position: 'top-right',
                            afterHidden: function () {
                                window.location.reload();
                
                            }
                           
                            })

                       


                    }
                    if (data.success) {

                        $.toast({
                            heading: 'Success',
                            text: data.success,
                            icon: 'success',
                            loader: true,
                            position: 'top-right',
                            afterHidden: function () {
                                window.location.href= "subadminlist";
                
                            }
                           
                            })

                      

                    }
                   
                }
            });


        }
    });
});

//edit
$(function() {

    $("#update-subadmin").validate({
      
        rules: {
            email: {
                required: true,
                noSpace: true,
                email: true
            },
            name:{
                required: true,
            },
            role:{
                required: true,  
            },
            password: {
                required: true,
                noSpace: true,
                minlength: 8,
                maxlength: 32,
                checklower: true,
                checkupper: true,
                checkchar: true,
                checkdigit: true
            }
        },
        messages: {
            password: {
                required: 'Password can not be empty.',
                checklower: "Need atleast One Lowercase Alphabet",
                checkupper: "Need atleast One Uppercase Alphabet",
                checkdigit: "Need atleast One Digit",
                checkchar: "Need atleast One Special Character"
            },
            email: {
                required: 'Email can not be empty.',
                email: 'Please enter a valid email address.'
            },
            role:{
                required: 'Role can not be empty.',
                
            },
            name:{
                required: 'Name can not be empty.',
                
            }

        },
       
        submitHandler: function(form) {
            
            console.log(form);
            var name = $("#name").val();
            var password = $("#password").val();
            var email = $("#email").val();
            var role = $("#role").val();
            var id = $("#subid").val();
            $.ajax({
                url: "../update-subadmin",
                method: "POST",
                dataType: "json",
                data: { role: role, password: password, email: email, name: name, id:id},
                beforeSend: function() {
                    $('#edit-subadmin').html('Processing...');
                    $("#edit-subadmin").attr("disabled", true);
                },
                success: function(data) {
                    console.log(data);
                    if (data.error) {

                        $.toast({
                            heading: 'error',
                            text: data.error,
                            icon: 'error',
                            loader: true,
                            position: 'top-right',
                            afterHidden: function () {
                                $('#edit-subadmin').html('Update');
                                $("#edit-subadmin").attr("disabled", false);
                
                            }
                           
                            })

                       


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


        }
    });
});

})(jQuery);
//privilege


$('.edit-privilege').on('submit', function(event) {
    event.preventDefault();
    $.ajax({
        url: "../update-privilege",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('#edit-pri').html('Processing...');
            $("#edit-pri").attr("disabled", true);
        },
        success: function(data) {
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
                    text:data.error,
                    icon: 'error',
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

$(document).on('click', '.status-subadmin', function () {
      
    var id = $(this).attr("data-id");
    var status_id = $(this).attr("data-status");



   
            $.ajax({
                url: "status-subadmin",
                type: "POST",
                dataType: "json",
                data: { 'id': id, 'status_id': status_id },
                success: function(data) {
                    if (data.success) {
                        $.toast({
                            heading: 'UPDATED',
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
 
$('.deleteim').on('click', function(event) {
    event.preventDefault();
  
    var id = $(this).attr("data-id");
   
    Swal.fire({
            // title: 'Are you sure you want to delete this image ?',
            // icon: 'warning',
            // buttons: ["No", "Yes!"],
           // dangerMode: true,
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
                url: "../unlink",
                type: "POST",
                dataType: "json",
                data: {'id': id},
                
                success: function(data) {
                    if(data.success){
                   
                        $.toast({
                            heading: 'Success',
                            text: 'The image has been removed from the folder',
                            icon: 'success',
                            loader: true,
                            position: 'top-right',
                            afterHidden: function () {
                                $('#imgb_' + id).remove();
                                window.location.reload();
                            }
                           
                            })

                 
                }
            }
            }) : t.dismiss === Swal.DismissReason.cancel 
            
           
        })

    });

    

    $(document).on('click', '.delete-subadmin', function (event) {
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
                url: "delete-subadmin",
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

$('.privilege').on('submit', function(event) {
   
    event.preventDefault();
    $.ajax({
        url: "add-privilege",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
       processData: false,
        beforeSend: function() {
            $('#add-pri').html('Processing...');
            $("#add-pri").attr("disabled", true);
        },
        success: function(data) {
            var data = jQuery.parseJSON(data);
            if (data.success) {

                $.toast({
                    heading: 'Success',
                    text: data.success,
                    icon: 'success',
                    loader: true,
                    position: 'top-right',
                    afterHidden: function () {
                        window.location.href = "users";
        
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
                        window.location.href = "users";
        
                    }
                   
                    })

             

            }
        }
    });
});

$('.check').on('click', function() {
    
    
    var id = $(this).attr("data-id");
    var status_id = $(this).attr("data-status");



  
            $.ajax({
                url: "status-testimonial",
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

// $('.check-de').on('click', function(event) {
   
//     event.preventDefault();
//     var id = $(this).attr("data-id");
//     var status_id = $(this).attr("data-status");



//     Swal.fire({
//         title: "Are you sure?",
       
//         icon: "warning",
//         showCancelButton: !0,
//         confirmButtonText: "Yes, Delete it!",
//         customClass: {
//             confirmButton: "btn btn-primary me-3",
//             cancelButton: "btn btn-label-secondary"
//         },
//         buttonsStyling: !1
//     }).then(function(t) {
//         t.value ?
//             $.ajax({
//                 url: "status-testimonial",
//                 type: "POST",
//                 dataType: "json",
//                 data: { 'id': id, 'status_id': status_id },
//                 success: function(data) {
//                     if (data.success) {
//                         Swal.fire({
//                             icon: "success",
//                             title: "UPDATED",
//                             text: "Your Status has been changed.",
//                             customClass: {
//                                 confirmButton: "btn btn-success"
//                             }
//                         }).then(function() {
//                             window.location.reload();

//                         });
//                     }
//                 }
//             }) : t.dismiss === Swal.DismissReason.cancel && Swal.fire({
//                 title: "Cancelled",
//                 text: "Your status of this record has not changed yet",
//                 icon: "error",
//                 customClass: {
//                     confirmButton: "btn btn-success"
//                 }
//             })
//     })

// });
//priview and delete 

document.addEventListener("click", (evt) => {
    const flyoutEl = document.getElementById("search");
    let targetEl = evt.target;       
    do {
      if(targetEl == flyoutEl) {
        $.ajax({
         url: "suggest",
          method: "POST",
          dataType: "JSON",
           success: function(data) {
           console.log(data);
            $('#exampleList').html(data);
           }
         });
        }
      // Go up the DOM
      targetEl = targetEl.parentNode;
    } while (targetEl);
    // This is a click outside.      
    $('#exampleList').html('');
});

$('.update-settings').on('submit', function(event) {
    event.preventDefault();
    $.ajax({
        url: "update-settings",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('#updatcon-btn').html('Processing...');
            $("#updatcon-btn").attr("disabled", true);
        },
        success: function(data) {
            console.log(data);
            var data = jQuery.parseJSON(data);
            // if (data.error) {
            //     $('#updatcon-btn').html('Submit');
            //     $("#updatcon-btn").attr("disabled", false);
            // }
            if (data.success) {
                $.toast({
                    heading: 'Updated',
                    text:  data.success,
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

$("#test button").click(function (ev) {
    ev.preventDefault()

    if ($(this).attr("value") == "Delete") {

        let form = document.getElementById('test');
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
        }).then(function (t) {
            t.value ?
                    $.ajax({
                        url: "delete_alltest",
                        method: "POST",
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData: false,

                        success: function (data) {
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
        let form = document.getElementById('test');
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
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "status_alltest",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,

                    success: function (data) {
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
                    url: "status_alltestde",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,

                    success: function (data) {
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
            } else {

               
            }
        });
    }
});
