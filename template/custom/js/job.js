
$('.add-jobcategory').on('submit', function (event) {
    event.preventDefault();
    $.ajax({
        url: "add-jobcategory",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $('#addjob-btn').html('Processing...');
            $("#addjob-btn").attr("disabled", true);
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

                $('#addjob-btn').html('Submit');
                $("#addjob-btn").attr("disabled", false);

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

$('.fetch-jobcategory').on('click', function (event) {
    event.preventDefault();
    var wrap_html = "";
    var id = $(this).attr("data-id");
    console.log(id);
    $.ajax({
        url: "retrive-jobcategory",
        type: "POST",
        dataType: "json",
        data: {'id': id},
        success: function (data) {
            console.log(data);
            $('#cat_name').val(data.category_name);
            $('#id').val(data.id);
        }
    });
});

$('.update-jobcategory').on('submit', function (event) {
    event.preventDefault();
    $.ajax({
        url: "edit-jobcategory",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $('#updatjob-btn').html('Processing...');
            $("#updatjob-btn").attr("disabled", true);
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
                $('#updatjob-btn').html('Submit');
                $("#updatjob-btn").attr("disabled", false);
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
                $('#updatjob-btn').html('Submit');
                $("#updatjob-btn").attr("disabled", false);
               }
        }
    });
});
$(document).on('click', '.delete-jobcategory', function (event) {

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
    }).then(function (t) {
        t.value ?
                $.ajax({
                    url: "delete-jobcategory",
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
$(document).on('click', '.status-jobcategory', function () {

    
    var id = $(this).attr("data-id");
    var status_id = $(this).attr("data-status");



   
                $.ajax({
                    url: "status-jobcategory",
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



//job list


$('.add-job').on('submit', function (event) {
    event.preventDefault();
    $.ajax({
        url: "insert-job",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $('#addjob-btn').html('Processing...');
            $("#addjob-btn").attr("disabled", true);
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

                if (data.jobtitle_error != '') {
                    $('#jobtitle_error').html(data.jobtitle_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#jobtitle_error').html('');
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

                // if (data.description_error != '') {
                //     $('#description_error').html(data.description_error);
                //     $(".invalid-feedback").css("display", "block");
                // } else {
                //     $('#description_error').html('');
                // }

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

                $('#addjob-btn').html('Submit');
                $("#addjob-btn").attr("disabled", false);
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
                    window.location.href = "job-list";


                });

                // swal('Success',
                //         data.success,
                //         'success').then(function () {
                //             window.location.href = "job-list";
                // });
            }
        }
    });
});

$('.update-job').on('submit', function (event) {
    event.preventDefault();
    $.ajax({
        url: "editjob",
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

                if (data.jobtitle11_error != '') {
                    $('#jobtitle11_error').html(data.jobtitle11_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#jobtitle11_error').html('');
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
                    window.location.href = "../job-list";


                });
            }
        }
    });
});
$(document).on('click', '.delete-job', function (event) {

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
    }).then(function (t) {
        t.value ?
                $.ajax({
                    url: "delete-job",
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
$(document).on('click', '.status-job', function () {

    var id = $(this).attr("data-id");
    var status_id = $(this).attr("data-status");



                $.ajax({
                    url: "status-job",
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
$(document).on('click', '.feature-job', function () {

   
    var id = $(this).attr("data-id");
    var status_id = $(this).attr("data-status");



                $.ajax({
                    url: "feature-job",
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

$('.updatejob-seo').on('submit', function (event) {

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
                $('#updatseo-btn').html('Update');
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



$("#job_cat button").click(function (ev) {
    ev.preventDefault()

    if ($(this).attr("value") == "Delete") {

        let form = document.getElementById('job_cat');
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
        }).then(function (t) {
            t.value ?
                    $.ajax({
                        url: "delete_alljobcat",
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
        let form = document.getElementById('job_cat');
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
                    url: "status_alljobcat",
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
                    url: "status_alljobcatde",
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





$("#job button").click(function (ev) {
    ev.preventDefault()

    if ($(this).attr("value") == "Delete") {

        let form = document.getElementById('job');
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
        }).then(function (t) {
            t.value ?
                    $.ajax({
                        url: "delete_alljob",
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
        let form = document.getElementById('job');
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
                    url: "status_alljob",
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
                    url: "status_alljobde",
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

