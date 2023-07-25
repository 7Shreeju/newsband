//front  Request callback

$('.add-contact').on('submit', function (event) {

    event.preventDefault();
    $.ajax({

        url: 'add-contact',
        method: "post",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $('#addcon-btn').html('SUBMIT');
            $("#addcon-btn").attr("disabled", true);
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
                if (data.email_error != '') {
                    $('#email_error').html(data.email_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#email_error').html('');
                }

                if (data.mobile_error != '') {
                    $('#mobile_error').html(data.mobile_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#mobile_error').html('');
                }
                $('#addcon-btn').html('SUBMIT');
                $("#addcon-btn").attr("disabled", false);
            }
            if (data.success) {
               
                        window.location.href = "thank-you";


                   

            }
        }
    });
});

$('.add-contactus').on('submit', function (event) {


    event.preventDefault();
    $.ajax({

        url: 'add-contactus',
        method: "post",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $('#addconus-btn').html('SUBMIT NOW');
            $("#addconus-btn").attr("disabled", true);
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
                if (data.email_error != '') {
                    $('#email_error').html(data.email_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#email_error').html('');
                }

                if (data.mobile_error != '') {
                    $('#mobile_error').html(data.mobile_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#mobile_error').html('');
                }
                $('#addconus-btn').html('SUBMIT NOW');
                $("#addconus-btn").attr("disabled", false);

            }
            if (data.success) {

              
                        window.location.href = "thank-you";


                   
            }
        }
    });
});
$('.request-callback').on('submit', function (event) {
    event.preventDefault();
    $.ajax({
        url: "request-callback",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $('#addreq-btn').html('Processing...');
            $("#addreq-btn").attr("disabled", true);
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

                if (data.contact_error != '') {
                    $('#contact_error').html(data.contact_error);
                    $(".invalid-feedback").css("display", "block");
                } else {

                    $('#contact_error').html('');
                }

                if (data.message_error != '') {
                    $('#message_error').html(data.message_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#message_error').html('');
                }
                $('#addreq-btn').html('Submit');
                $("#addreq-btn").attr("disabled", false);
            }

            if (data.success) {
                $('#addreq-btn').html('Done');
                $("#addreq-btn").attr("disabled", true);
                swal('Success',
                        data.success,
                        'success').then(function () {
                    window.location.reload();
                });
            }
        }
    });
});

$(function () {
    $('.reset-userpassword').validate({
        rules: {
            password: {
                required: true,
                minlength: 8,
                maxlength: 32
            },
            c_password: {
                required: true,

                minlength: 8,
                maxlength: 32
            }
        },
        messages: {
            password: {
                required: 'Password can not be empty',
            },
            c_password: {
                required: 'Confirm Password can not be empty',
            }

        },
        submitHandler: function (form) {
            var thisupdateemail = $("#thisupdateemail").val();
            var password = $("#password").val();
            var c_password = $("#c_password").val();

            $.ajax({
                url: "update-userpassword",
                method: "POST",
                dataType: "json",
                data: {thisupdateemail: thisupdateemail, password: password, c_password: c_password},
                beforeSend: function () {
                    $('#resetuser-btn').html('Processing...');
                    $("#resetuser-btn").attr("disabled", true);
                },
                success: function (data) {
                    console.log(data);
                    if (data.error == true)
                    {
                        swal('error',
                                data.msg,
                                'error').then(function () {
                            window.location.reload();
                        });



                    }
                    if (data.error == false)
                    {
                        swal('Success',
                                data.msg,
                                'success').then(function () {

                        });

                    }

                }
            });


        }
    });
});
(jQuery);

$('.subscribtion').on('submit', function (event) {
    var url = $('#url').val();
    var url1 = $('#url1').val();
    event.preventDefault();
    $.ajax({
        url: url,
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $('#subscribe-btn').html('<i class="fa fa-paper-plane-o"></i>');
            $("#subscribe-btn").attr("disabled", true);
        },
        success: function (data) {
            console.log(data);
            var data = jQuery.parseJSON(data);
            if (data.error) {
                if (data.emailnesletter_error != '') {
                    $('#emailnesletter_error').html(data.emailnesletter_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#emailnesletter_error').html('');
                }


                $('#subscribe-btn').html('<i class="fa fa-paper-plane-o"></i>');
                $("#subscribe-btn").attr("disabled", false);
            }

            if (data.success) {

               
                        window.location.href = url1;


            }
        }
    });
});



$('.service-enqury').on('submit', function (event) {
    var url = $('#ser_url').val();
        var th_url = $('#th_url').val();

    event.preventDefault();
    $.ajax({
        url: url,
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $('#enq-btn').html('SUBMIT NOW');
            $("#enq-btn").attr("disabled", true);
        },
        success: function (data) {
            console.log(data);
            var data = jQuery.parseJSON(data);
            if (data.error) {
                if (data.email_error != '') {
                    $('#email_error').html(data.email_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#email_error').html('');
                }

                if (data.name_error != '') {
                    $('#name_error').html(data.name_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#name_error').html('');
                }
                
                if (data.mobile_error != '') {
                    $('#mobile_error').html(data.mobile_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#mobile_error').html('');
                }
                $('#enq-btn').html('SUBMIT NOW');
                $("#enq-btn").attr("disabled", false);
            }

            if (data.success) {
              
                        window.location.href = th_url;

            }
        }
    });
});




$('.add-comment').on('submit', function (event) {
    event.preventDefault();
    $.ajax({
        url: "insert-comment",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $('#comment-btn').html('Processing...');
            $("#comment-btn").attr("disabled", true);
        },
        success: function (data) {
            console.log(data);
            var data = jQuery.parseJSON(data);
            if (data.error) {

                if (data.email_error != '') {
                    $('#email_error').html(data.email_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#email_error').html('');
                }

                if (data.comment_error != '') {
                    $('#comment_error').html(data.comment_error);
                    $(".invalid-feedback").css("display", "block");
                } else {
                    $('#comment_error').html('');
                }


                $('#comment-btn').html('Submit');
                $("#comment-btn").attr("disabled", false);
            }

            if (data.success) {
                $('#comment-btn').html('Done');
                $("#comment-btn").attr("disabled", true);
                swal('Success',
                        data.success,
                        'success').then(function () {
                    window.location.reload();
                });
            }
        }
    });
});

  