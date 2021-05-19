$(document).ready(function () {
    $(".register-btn").on("click", function (e) {
        e.preventDefault();
        var data = $("#registration-form").serialize();

        $.ajax({
            type: "post",
            url: "/register",
            data: data,
            dataType: false,
            beforeSend: function () {
                $(".register-btn").html(
                    '<i class="fa fa-spinner" aria-hidden="true"></i>'
                );
            },
            success: function (response) {
                $(".error-show").html();
                if (response.status == "error") {
                    $(".register-btn").html("REGISTER");
                    $(".error-show")
                        .html(response.message)
                        .css({ display: "block" });
                }
                if (response.status == "form-val-err") {
                    $(".register-btn").html("REGISTER");

                    errors = response.errors;

                    errorsHtml = "";

                    $.each(errors, function (key, value) {
                        errorsHtml += "<li>" + value[0] + "</li>";
                    });

                    console.log(errorsHtml);
                    $(".error-show").html(errorsHtml);
                }
                if (response.status == "success") {
                    $(".register-btn").html("REGISTER");
                    location.href = "/email/veri";
                } else {
                    $(".register-btn").html("REGISTER");
                    $(".error-show")
                        .html(response.message)
                        .css({ display: "block" });
                }
            },
        });
    });

    $(".login-btn").on("click", function (e) {
        e.preventDefault();
        data = $("#login-form").serialize();
        console.log(data);
        $.ajax({
            type: "post",
            url: "/login",
            data: data,
            beforeSend: function () {
                $(".login-btn").html(
                    '<i class="fa fa-spinner" aria-hidden="true"></i>'
                );
            },

            success: function (response) {
                if (response.area == "not-verified") {
                    location.href = "/email/veri";
                } else if (response.area == "user") {
                    location.href = "/";
                } else if (response.status == "error") {
                    $(".error-show")
                        .html(response.message)
                        .css("display", "block");
                    $(".login-btn").html("Login");
                } else {
                    $(".error-show")
                        .html("something went wrong")
                        .css("display", "block");
                    $(".login-btn").html("Login");
                }
            },
        });
    });

    //resend email verification

    $("#resend").on("click", function (e) {
        e.preventDefault();
        data = $("#resend-form").serialize();
        $.ajax({
            type: "post",
            url: "/email/verification-notification",
            data: data,
            success: function (response) {
                console.log(response);
            },
        });
    });
});

//forgot password

$("#forgot_password").on("click", function (e) {
    e.preventDefault();
    data = $("#forgot-form").serialize();

    $.ajax({
        type: "post",
        url: "/forgot-password",
        data: data,
        beforeSend: function () {
            $("#forgot_password").attr("value", "Sending...");
        },

        success: function (response) {
            if (response.status == "error") {
                $("#forgot_password").attr("value", "Send Verification Email");
                $(".error-show").css("display", "block").html(response.message);
            } else if ((response.status = "success")) {
                $(".error-show")
                    .css({ display: "block", color: "green" })
                    .html(response.messages);
                $("#forgot_password").attr("value", "Send Verification Email");

                $("#forgot-form").trigger("reset");
            }
        },
    });
});

//reset password page ajax request

$("#reset_password").on("submit", function (e) {
    e.preventDefault();
    data = $("#reset_password").serialize();
    $.ajax({
        type: "post",
        url: "/reset-password",
        data: data,
        beforeSend: function () {
            $("#reset_password_button").html("Loading...");
        },

        success: function (response) {
            $("#reset_password_button").html("reset password");
            if (response.status == "error") {
                $(".error-show").html(response.message).css("display", "block");
            } else if (response.status == "success") {
                window.location.href = "/login";
            }
        },
        error: function (response) {
            $("#reset_password_button").html("reset password");
            error = response.responseJSON.errors;
            errors = Object.values(error);
            $(".error-show").html("");

            $(".error-show").css("display", "block");
            for (i = 0; i < errors.length; i++) {
                $(".error-show").append(errors[i][0] + "<br>");
            }
        },
    });
});
