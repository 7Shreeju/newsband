$(document).ready(function() {
    var submit = $("#sta").show();
     var submit1 = $("#status").hide();
        $cbs = $('input[name="checkbox_value[]"]').click(function() {
            if($cbs.is(":checked")){
                $("#status").show();
                $("#delete_all").show();
                $("#sta").hide();
            }else{
                $("#sta").show();
                  $("#delete_all").hide();
                $("#status").hide();
            }
          
           
        });
      });

   
    $('#insert-statseo').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: "insert-statseo",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('#add-statseo').html('Processing...');
                $("#add-statseo").attr("disabled", true);
            },
            success: function(data) {
                console.log(data);
                var data = jQuery.parseJSON(data);
                if (data.error) {
    
                    if (data.pagename_error != '') {
                        $('#pagename_error').html(data.pagename_error);
                        $(".invalid-feedback").css("display", "block");
                    } else {
                        $('#pagename_error').html('');
                    }
    
                    if (data.metatitle_error != '') {
                        $('#metatitle_error').html(data.metatitle_error);
                        $(".invalid-feedback").css("display", "block");
                    } else {
                        $('#metatitle_error').html('');
                    }
                    if (data.metadesc_error != '') {
                        $('#metadesc_error').html(data.metadesc_error);
                        $(".invalid-feedback").css("display", "block");
                    } else {
                        $('#metadesc_error').html('');
                    }
                    if (data.canonical_error != '') {
                        $('#canonical_error').html(data.canonical_error);
                        $(".invalid-feedback").css("display", "block");
                    } else {
                        $('#canonical_error').html('');
                    }
                    if (data.schemacode_error != '') {
                        $('#schemacode_error').html(data.schemacode_error);
                        $(".invalid-feedback").css("display", "block");
                    } else {
                        $('#schemacode_error').html('');
                    }
                      $('#add-statseo').html('Submit');
                    $("#add-statseo").attr("disabled", false);
    
                }
                if (data.success) {
    
                    $.toast({
                        heading: 'Success',
                        text:data.success,
                        icon: 'success',
                        loader: true,
                        position: 'top-right',
                        afterHidden: function () {
                            window.location.href = "static-list";
                        }
                       
                        })
    
                }
            }
        });
    });
    $(document).on('click', '.delete-page', function (event) {
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
                        url: "delete-page",
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
    $('#update-statseo').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: "edit",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('#add-statseo').html('Processing...');
                $("#add-statseo").attr("disabled", true);
            },
            success: function(data) {
                console.log(data);
                var data = jQuery.parseJSON(data);
                if (data.error) {
    
                    if (data.pagename1_error != '') {
                        $('#pagename1_error').html(data.pagename1_error);
                        $(".invalid-feedback").css("display", "block");
                    } else {
                        $('#pagename1_error').html('');
                    }
    
                    if (data.metatitle1_error != '') {
                        $('#metatitle1_error').html(data.metatitle1_error);
                        $(".invalid-feedback").css("display", "block");
                    } else {
                        $('#metatitle1_error').html('');
                    }
                    if (data.metadesc1_error != '') {
                        $('#metadesc1_error').html(data.metadesc1_error);
                        $(".invalid-feedback").css("display", "block");
                    } else {
                        $('#metadesc1_error').html('');
                    }
                    if (data.canonical1_error != '') {
                        $('#canonical1_error').html(data.canonical1_error);
                        $(".invalid-feedback").css("display", "block");
                    } else {
                        $('#canonical1_error').html('');
                    }
                    if (data.schemacode1_error != '') {
                        $('#schemacode1_error').html(data.schemacode1_error);
                        $(".invalid-feedback").css("display", "block");
                    } else {
                        $('#schemacode1_error').html('');
                    }
                    $('#add-statseo').html('Update');
                    $("#add-statseo").attr("disabled", false);
    
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
                       
                       
                        })
                     $('#add-statseo').html('Update');
                    $("#add-statseo").attr("disabled", false);
    
                }
            }
        });
    });

    $('.add-role').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
            url: "add-role",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $('#addrole-btn').html('Processing...');
                $("#addrole-btn").attr("disabled", true);
            },
            success: function (data) {
                console.log(data);
                var data = jQuery.parseJSON(data);
                if (data.error) {
                    if (data.role1_error != '') {
                        $('#role1_error').html(data.role1_error);
                        $(".invalid-feedback").css("display", "block");
                    } else {
                        $('#role1_error').html('');
                    }
    
                    $('#addrole-btn').html('Submit');
                    $("#addrole-btn").attr("disabled", false);
    
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
    
    $('.fetch-role').on('click', function (event) {
        event.preventDefault();
        var wrap_html = "";
        var id = $(this).attr("data-id");
        console.log(id);
        $.ajax({
            url: "retrive-role",
            type: "POST",
            dataType: "json",
            data: {'id': id},
            success: function (data) {
                console.log(data);
                $('#cat_name').val(data.role);
                $('#id').val(data.id);
            }
        });
    });
    
    $('.update-role').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
            url: "edit-role",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $('#updatrole-btn').html('Processing...');
                $("#updatrole-btn").attr("disabled", true);
            },
            success: function (data) {
                console.log(data);
                var data = jQuery.parseJSON(data);
                if (data.error) {
                    if (data.role_error != '') {
                        $('#role_error').html(data.role_error);
                        $(".invalid-feedback").css("display", "block");
                    } else {
                        $('#role_error').html('');
                    }
                    $('#updatrole-btn').html('Submit');
                    $("#updatrole-btn").attr("disabled", false);
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
                    $('#updatrole-btn').html('Submit');
                    $("#updatrole-btn").attr("disabled", false);
                   }
            }
        });
    });
    $(document).on('click', '.delete-role', function (event) {
    
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
                        url: "delete-role",
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
    
       function deleteContact(id) {
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
                        url: "deletecontact",
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
                                       $('#con_' + id).remove();
                                        window.location.reload();
                                    }
    
                                })
    
    
                            }
                        }
                    }) : t.dismiss === Swal.DismissReason.cancel 
    
    
        })

    }
        function deleteImage(id) {
     
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
                        url: "deleteem",
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
                                       $('#imgb_' + id).remove();
                                        window.location.reload();
                                    }
    
                                })
    
    
                            }
                        }
                    }) : t.dismiss === Swal.DismissReason.cancel 
    
    
        })
    }
