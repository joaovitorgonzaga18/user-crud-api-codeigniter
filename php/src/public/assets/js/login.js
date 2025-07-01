// console.log('teste console')
$(document).ready(function () {
    $('#login-form').submit(function (e) {

        e.preventDefault();

        $("body").LoadingOverlay("show")

        $.ajax({
            type: 'POST',
            contentType: "application/json",
            dataType: "json",
            url: "/login",
            data: JSON.stringify({
                'email': $("#email").val(),
                'password': $("#password").val(),
            }),
            success: function (response) {
                
                // console.log(response)

                localStorage.setItem('access_token', response.access_token)

                $("#message-alert").addClass("d-none")

                window.location = "/main"
            },
            error: function (response) {

                var data = response.responseJSON

                $("body").LoadingOverlay("hide")

                $("#message-alert").removeClass("d-none")
                $("#message-alert").html(data.messages.error)
            }
        })

    });
});