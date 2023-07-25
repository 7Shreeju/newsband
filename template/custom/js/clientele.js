

$('.add-clientele').on('submit', function (event) {
    event.preventDefault();


    $.ajax({
        url: "insert-clientele",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $('#addclient-btn').html('Processing...');
            $("#addclient-btn").attr("disabled", true);
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


                if (data.clientimg_error != '') {
                    $('#clientimg_error').html(data.clientimg_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#clientimg_error').html('');
                }

                $('#addclient-btn').html('Add');
                $("#addclient-btn").attr("disabled", false);
            }

            if (data.success) {


                $.toast({
                    heading: 'success',
                    text: data.success,
                    icon: 'success',
                    loader: true,
                    position: 'top-right',
                    afterHidden: function () {
                        window.location.href = "client-list";
                    }

                })



            }
        }
    });
});

$('.update-client').on('submit', function (event) {

    event.preventDefault();
    $.ajax({
        url: "editclient",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $('#updatc-btn').html('Processing...');
            $("#updatc-btn").attr("disabled", true);
        },
        success: function (data) {
            console.log(data);
            var data = jQuery.parseJSON(data);
            if (data.error) {

                if (data.name1_error != '') {
                    $('#name1_error').html(data.name1_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#name1_error').html('');
                }

                $('#updatc-btn').html('Submit');
                $("#updatc-btn").attr("disabled", false);

            }
            if (data.success) {
                $.toast({
                    heading: 'success',
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

                $('#updatc-btn').html('Submit');
                $("#updatc-btn").attr("disabled", false);
             }
        }
    });
});


$(document).on('click', '.delete-client', function (event) {
    event.preventDefault();
    var id = $(this).attr("data-id");

    Swal.fire({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover",
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
                    url: "delete-client",
                    type: "POST",
                    dataType: "json",
                    data: {'id': id},
                    success: function (data) {
                        if (data.success) {

                            $.toast({
                                heading: 'Deleted',
                                text: "Your Record has been deleted",
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


$(document).on('click', '.status-client', function () {
   
    var id = $(this).attr("data-id");
    var status_id = $(this).attr("data-status");


   
                $.ajax({
                    url: "status-client",
                    type: "POST",
                    dataType: "json",
                    data: {'id': id, 'status_id': status_id},
                    success: function (data) {
                        if (data.success) {

                            $.toast({
                                heading: 'UPDATED',
                                text: "Your status of this record has been changed",
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
$("#ctlist button").click(function (ev) {
    ev.preventDefault()

    if ($(this).attr("value") == "Delete") {
        // var form_data = new FormData(document.getElementById("myform"));
        let form = document.getElementById('ctlist');
        let formData = new FormData(form);
        Swal.fire({
            title: "Are you sure?",
            text: "YOnce deleted, you will not be able to recover",

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
                        url: "delete_allclentele",
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
                                    heading: 'Delete',
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
        let form = document.getElementById('ctlist');
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
                    url: "status_allclentele",
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
                    url: "status_allclentelede",
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
