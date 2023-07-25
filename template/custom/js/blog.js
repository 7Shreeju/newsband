
//author

$('.add-authorr').on('submit', function(event) {
    event.preventDefault();
    $.ajax({
       url: "insert-author",
        method: "POST",
       data: new FormData(this),
       contentType: false,
        cache: false,
         processData: false,
       beforeSend: function() {
          $('#addauthorr-btn').html('Processing...');
            $("#addauthorr-btn").attr("disabled", true);
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
                

                 $('#addauthorr-btn').html('Submit');
                 $("#addauthorr-btn").attr("disabled", false);
             }

             if (data.success) {

$.toast({
                                heading: 'Success',
                                text: data.success,
                                icon: 'success',
                                loader: true,
                                position: 'top-right',
                                afterHidden: function () {
                                  window.location.href = "author-list";

                                }

                            })
                

             }
         }
     });
 });



 $('.update-auth').on('submit', function(event) {
     event.preventDefault();
     $.ajax({
         url: "editauthor",
         method: "POST",
         data: new FormData(this),
         contentType: false,
         cache: false,
         processData: false,
         beforeSend: function() {
             $('#updataut-btn').html('Processing...');
             $("#updataut-btn").attr("disabled", true);
         },
         success: function(data) {
             console.log(data);
             var data = jQuery.parseJSON(data);
             if (data.error) {
                 if (data.nameauthor_error != '') {
                     $('#nameauthor_error').html(data.nameauthor_error);
                     $(".invalid-feedback").css("display", "block");
                 } else {
                     $('#nameauthor_error').html('');
                 }
                 $('#updataut-btn').html('Submit');
                 $("#updataut-btn").attr("disabled", false);
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

 $('.delete-author').on('click', function(event) {
     event.preventDefault();
     var id = $(this).attr("data-id");


     Swal.fire({
             title: "Are you sure?",
             text: "You won't be able to revert this!",
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
                     url: "delete-author",
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
 $('.status-author').on('click', function() {
    
     var id = $(this).attr("data-id");
     var status_id = $(this).attr("data-status");


     
       
             $.ajax({
                 url: "status-author",
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
$("#blog_cat button").click(function (ev) {
    ev.preventDefault()
   
    if ($(this).attr("value") == "Delete") {  
      
       let form = document.getElementById('blog_cat');
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
            url: "delete_allblogcat",
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
        let form = document.getElementById('blog_cat');
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
            url: "status_allblogcat",
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
                url: "status_allblogcatde",
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
  
  
  
  
  
  $("#blog button").click(function (ev) {
    ev.preventDefault()
   
    if ($(this).attr("value") == "Delete") {  
      
       let form = document.getElementById('blog');
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
            url: "delete_allblog",
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
        let form = document.getElementById('blog');
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
            url: "status_allblog",
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
                url: "status_allblogde",
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
  
  
  
  
  
  
  
$('.add-blogcategory').on('submit', function (event) {
    event.preventDefault();
    $.ajax({
        url: "add-blogcategory",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $('#addblog-btn').html('Processing...');
            $("#addblog-btn").attr("disabled", true);
        },
        success: function (data) {
            console.log(data);
            var data = jQuery.parseJSON(data);
            if (data.error) {
                if (data.categoryname_error != '') {
                    $('#categoryname_error').html(data.categoryname_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#categoryname_error').html('');
                }

                $('#addblog-btn').html('Submit');
                $("#addblog-btn").attr("disabled", false);

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

$('.fetch-blogcategory').on('click', function (event) {
    event.preventDefault();
    var wrap_html = "";
    var id = $(this).attr("data-id");
    console.log(id);
    $.ajax({
        url: "retrive-blogcategory",
        type: "POST",
        dataType: "json",
        data: {'id': id},
        success: function (data) {
            console.log(data);
            $('#cat_name').val(data.category_name);
                        $('#iamge').html('<img style="width: 100px" src="' + data.image_url + '">');

            $('#id').val(data.id);
        }
    });
});

$('.update-blogcategory').on('submit', function (event) {
    event.preventDefault();
    $.ajax({
        url: "edit-blogcategory",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $('#updatblog-btn').html('Processing...');
            $("#updatblog-btn").attr("disabled", true);
        },
        success: function (data) {
            console.log(data);
            var data = jQuery.parseJSON(data);
            if (data.error) {
                if (data.category_error != '') {
                    $('#category_error').html(data.category_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#category_error').html('');
                }
                $('#updatblog-btn').html('Submit');
                $("#updatblog-btn").attr("disabled", false);
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
                        window.location.reload();

                    }

                })
                $('#updatblog-btn').html('Submit');
                $("#updatblog-btn").attr("disabled", false);
            }
        }
    });
});
$(document).on('click', '.delete-blogcategory', function (event) {

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
                    url: "delete-blogcategory",
                    type: "POST",
                    dataType: "json",
                    data: {'id': id},
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
                }) : t.dismiss 
    })

});
$(document).on('click', '.status-blogcategory', function () {

    
    var id = $(this).attr("data-id");
    var status_id = $(this).attr("data-status");



  
                $.ajax({
                    url: "status-blogcategory",
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



//blog list


$('.add-blog').on('submit', function (event) {
    event.preventDefault();
    $.ajax({
        url: "insert-blog",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $('#addblog-btn').html('Processing...');
            $("#addblog-btn").attr("disabled", true);
        },
        success: function (data) {
            console.log(data);
            var data = jQuery.parseJSON(data);
            if (data.error) {
                if (data.category_error != '') {
                    $('#category_error').html(data.category_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#category_error').html('');
                }

                if (data.name_error != '') {
                    $('#name_error').html(data.name_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#name_error').html('');
                }

                if (data.blogtitle_error != '') {
                    $('#blogtitle_error').html(data.blogtitle_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#blogtitle_error').html('');
                }

                if (data.date_error != '') {
                    $('#date_error').html(data.date_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#date_error').html('');
                }

                if (data.shortdescription_error != '') {
                    $('#shortdescription_error').html(data.shortdescription_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#shortdescription_error').html('');
                }

                 if (data.description_error != '') {
                     $('#description_error').html(data.description_error);
                     $(".invalid-feedback").css("display", "block");
                 } else {
                     $('#description_error').html('');
                 }

                if (data.main_error != '') {
                    $('#main_error').html(data.main_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#main_error').html('');
                }


                if (data.fea_error != '') {
                    $('#fea_error').html(data.fea_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#fea_error').html('');
                }

                /*
                 if (data.featured_image_error != '') {
                 $('#featured_image_error').html(data.featured_image_error);
                 $(".invalid-feedback").css("display", "block");
                 } else {
                 $('#featured_image_error').html('');
                 }
                 
                 if (data.main_image_error != '') {
                 $('#main_image_error').html(data.main_image_error);
                 $(".invalid-feedback").css("display", "block");
                 } else {
                 $('#main_image_error').html('');
                 }*/

                $('#addblog-btn').html('Submit');
                $("#addblog-btn").attr("disabled", false);
            }

            if (data.success) {


                Swal.fire({
                    position: "Success",
                    icon: "success",
                    title: data.success,
                    showConfirmButton: !1,
                    timer: 1500,
                    customClass: {
                        confirmButton: "btn btn-primary"
                    },
                    buttonsStyling: !1
                }).then(function () {
                    window.location.href = "blog-list";


                });

                 swal('Success',
                         data.success,
                         'success').then(function () {
                             window.location.href = "article-list";
                 });
            }
        }
    });
});



$('.fetch-blog').on('click', function (event) {
    event.preventDefault();
    var wrap_html = "";
    var id = $(this).attr("data-id");
    console.log(id);
    $.ajax({
        url: "retrive-blog",
        type: "POST",
        dataType: "json",
        data: {'id': id},
        success: function (data) {
            console.log(data);
            $('#payment_name').val(data.name);
            $('#days').val(data.days);

            $('#id').val(data.id);
        }
    });
});

$('.update-blog').on('submit', function (event) {
    event.preventDefault();
    $.ajax({
        url: "editblog",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $('#updatpay-btn').html('Processing...');
            $("#updatpay-btn").attr("disabled", true);
        },
        success: function (data) {
            console.log(data);
            var data = jQuery.parseJSON(data);
            if (data.error) {
                if (data.category11_error != '') {
                    $('#category11_error').html(data.category11_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#category11_error').html('');
                }

                if (data.name11_error != '') {
                    $('#name11_error').html(data.name11_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#name11_error').html('');
                }

                if (data.blogtitle11_error != '') {
                    $('#blogtitle11_error').html(data.blogtitle11_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#blogtitle11_error').html('');
                }

                if (data.date11_error != '') {
                    $('#date11_error').html(data.date11_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#date11_error').html('');
                }

                if (data.shortdescription11_error != '') {
                    $('#shortdescription11_error').html(data.shortdescription11_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#shortdescription11_error').html('');
                }

                if (data.description11_error != '') {
                    $('#description11_error').html(data.description11_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#description11_error').html('');
                }

                if (data.main11_error != '') {
                    $('#main11_error').html(data.main11_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#main11_error').html('');
                }


                if (data.fea11_error != '') {
                    $('#fea11_error').html(data.fea11_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#fea11_error').html('');
                }

                $('#updatpay-btn').html('Submit');
                $("#updatpay-btn").attr("disabled", false);
            }
            if (data.success) {

                Swal.fire({
                    position: "Success",
                    icon: "success",
                    title: data.success,
                    showConfirmButton: !1,
                    timer: 1500,
                    customClass: {
                        confirmButton: "btn btn-primary"
                    },
                    buttonsStyling: !1
                }).then(function () {
                    window.location.href = "../article-list";


                });
            }
        }
    });
});
$(document).on('click', '.delete-blog', function () {

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
                    url: "delete-blog",
                    type: "POST",
                    dataType: "json",
                    data: {'id': id},
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
                }) : t.dismiss 

       
    })


});
$(document).on('click', '.status-blog', function () {

   
    var id = $(this).attr("data-id");
    var status_id = $(this).attr("data-status");



                $.ajax({
                    url: "status-blog",
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
$(document).on('click', '.feature-blog', function () {

   
    var id = $(this).attr("data-id");
    var status_id = $(this).attr("data-status");



                $.ajax({
                    url: "feature-blog",
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


});

$('.update-seo').on('submit', function (event) {

    event.preventDefault();
    $.ajax({
        url: "editseo",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $('#updatseo-btn').html('Processing...');
            $("#updatseo-btn").attr("disabled", true);
        },
        success: function (data) {
            console.log(data);
            var data = jQuery.parseJSON(data);
            if (data.error) {
                $.toast({
                    heading: 'Warning',
                    text: data.error,
                    icon: 'warning',
                    loader: true,
                    position: 'top-right',
                    afterHidden: function () {
                        window.location.reload();

                    }

                })
                $('#updatseo-btn').html('Submit');
                $("#updatseo-btn").attr("disabled", false);
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

$('.add-subcategory').on('submit', function(event) {
    event.preventDefault();
    $.ajax({
        url: "add-subcategory",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('#addsubcat-btn').html('Processing...');
            $("#addsubcat-btn").attr("disabled", true);
        },
        success: function(data) {
            console.log(data);
            var data = jQuery.parseJSON(data);
            if (data.error) {
                if (data.categorypro_error != '') {
                    $('#categorypro_error').html(data.categorypro_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#categorypro_error').html('');
                }

                if (data.subcategory_error != '') {
                    $('#subcategory_error').html(data.subcategory_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#subcategory_error').html('');
                }
                $('#addsubcat-btn').html('Submit');
                $("#addsubcat-btn").attr("disabled", false);
            }
            if (data.success) {

                $.toast({
                    heading: 'Success',
                    text: data.success,
                    icon: 'success',
                    loader: true,
                    position: 'top-right',
                    afterHidden: function () {
                      
                        window.location.href="subcategory-list";
        
        
                       }
                   
                    })

                


            }
        }
    });
});


$('.fetch-subcategory').on('click', function(event) {
    event.preventDefault();
    var wrap_html = "";
    var id = $(this).attr("data-id");
    console.log(id);
    $.ajax({
        url: "retrive-subcategory",
        type: "POST",
        dataType: "json",
        data: { 'id': id },
        success: function(data) {
            console.log(data);
            $('#e_category_id').val(data.category_id);
            $('#subcat_name').val(data.subcategory);
            $('#id').val(data.id);
        }
    });
});



    // City change
    $('#sel_city').change(function() {
 
        var category_id = $(this).val();

        // AJAX request
        $.ajax({
            url: 'getCityDepartment',
            method: 'post',
            data: { category_id: category_id },
            dataType: 'json',
            success: function(response) {

                // Remove options 
                $('#sel_user').find('option').not(':first').remove();
                $('#sel_depart').find('option').not(':first').remove();

                // Add options
                $.each(response, function(index, data) {
                    $('#sel_depart').append('<option value="' + data['id'] + '">' + data['subcategory'] + '</option>');
                });
            }
        });
    });

 


$('.update-subcategory').on('submit', function(event) {
    event.preventDefault();
    $.ajax({
        url: "edit-subcategory",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('#updatsub-btn').html('Processing...');
            $("#updatsub-btn").attr("disabled", true);
        },
        success: function(data) {
            console.log(data);
            var data = jQuery.parseJSON(data);
            if (data.error) {
                if (data.categoryproedit_error != '') {
                    $('#categoryproedit_error').html(data.categoryproedit_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#categoryproedit_error').html('');
                }


                if (data.subcategorycat_error != '') {
                    $('#subcategorycat_error').html(data.subcategorycat_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#subcategorycat_error').html('');
                }
                $('#updatsub-btn').html('Submit');
                $("#updatsub-btn").attr("disabled", false);
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
                $('#updatsub-btn').html('Submit');
                $("#updatsub-btn").attr("disabled", false);
              

            }
        }
    });
});


$(document).on('click', '.delete-subcategory', function (event) {

    event.preventDefault();
    var id = $(this).attr("data-id");
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
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
                url: "delete-subcategory",
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
            }) : t.dismiss === Swal.DismissReason.cancel && 
            $.toast({
                heading: 'Cancelled',
                text:  "Your imaginary file is safe",
                icon: 'warning',
                loader: true,
                position: 'top-right',
                
               
                })

    })



});

$(document).on('click', '.status-subcategory', function (event) {

    event.preventDefault();
    var id = $(this).attr("data-id");
    var status_id = $(this).attr("data-status");



    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: !0,
        confirmButtonText: "Yes, change it!",
        customClass: {
            confirmButton: "btn btn-primary me-3",
            cancelButton: "btn btn-label-secondary"
        },
        buttonsStyling: !1
    }).then(function(t) {
        t.value ?
            $.ajax({
                url: "status-subcategory",
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
            }) : t.dismiss === Swal.DismissReason.cancel && 
            
            $.toast({
                heading: 'Cancelled',
                text:   "Your imaginary status is safe",
                icon: 'warning',
                loader: true,
                position: 'top-right',
                
               
                })

           
    })

});