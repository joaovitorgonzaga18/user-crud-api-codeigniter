
$(document).ready(function () {
    $('#form-new-user').submit(function (e) {

        e.preventDefault();

        $("body").LoadingOverlay("show")

        const dados = {};

        $.each($(this).serializeArray(), function (_, campo) {
            dados[campo.name] = campo.value;
        });

        // console.log(dados)

        $.ajax({
            type: 'POST',
            contentType: "application/json",
            dataType: "json",
            url: "/users/create",
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
            },
            data: JSON.stringify(dados),
            success: function (response) {

                // console.log(response)

                window.location = "/main"
            },
            error: function (response) {

                // console.log(response)

                var data = response.responseJSON

                $("#message-alert").removeClass("d-none")

                $("#message-alert").html("")
                $.each(data.messages, function (_, messages) {
                    $("#message-alert").append(messages + '<br>')
                });

                $("body").LoadingOverlay("hide")

            }
        })

    });
});

$(document).ready(function () {
    $('#form-update-user').submit(function (e) {

        e.preventDefault();

        $("body").LoadingOverlay("show")

        const dados = {};

        $.each($(this).serializeArray(), function (_, campo) {
            dados[campo.name] = campo.value;
        });

        // console.log(dados)

        $.ajax({
            type: 'PUT',
            contentType: "application/json",
            dataType: "json",
            url: "/users/update/" + dados.user_id,
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
            },
            data: JSON.stringify(dados),
            success: function (response) {

                // console.log(response)

                window.location = "/main"
            },
            error: function (response) {

                // console.log(response)

                var data = response.responseJSON

                $("#message-alert").removeClass("d-none")

                $("#message-alert").html("")
                $.each(data.messages, function (_, messages) {
                    $("#message-alert").append(messages + '<br>')
                });

                $("body").LoadingOverlay("hide")

            }
        })

    });
});

function loadUser(user_id) {

    $("body").LoadingOverlay("show")

    $.ajax({
        type: 'GET',
        contentType: "application/json",
        dataType: "json",
        url: "/users/" + user_id,
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
        },
        success: function (response) {

            var inputs = ($("#form-update-user").find(':input'))
            var data = response.data

            $.each(inputs, function (_, input) {
                $(input).prop('disabled', false)

                if (input.id == 'name')
                    $(input).val(data.name)
                if (input.id == 'user_id')
                    $(input).val(data.id)
                if (input.id == 'email')
                    $(input).val(data.email)
                if (input.id == 'access_level')
                    $(input).val(data.access_level)
            });

            $("body").LoadingOverlay("hide")

        },
        error: function (response) {

            var data = response.responseJSON

            $("#message-alert").removeClass("d-none")

            $("#message-alert").html("")
            $.each(data.messages, function (_, messages) {
                $("#message-alert").append(messages + '<br>')
            });

            $("body").LoadingOverlay("hide")

        }
    })

}

function deleteUser(user_id) {

    if (confirm('Are you sure you want to delete this user? (ID = ' + user_id + ')')) {

        $("body").LoadingOverlay("show")

        $.ajax({
            type: 'DELETE',
            contentType: "application/json",
            dataType: "json",
            url: "/users/delete/" + user_id,
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
            },
            success: function (response) {

                // console.log(response)

                window.location = "/main"
            },
            error: function (response) {

                // console.log(response)

                var data = response.responseJSON

                $("#message-alert").removeClass("d-none")

                $("#message-alert").html("")
                $.each(data.messages, function (_, messages) {
                    $("#message-alert").append(messages + '<br>')
                });

                $("body").LoadingOverlay("hide")

            }
        })
    }
}

function logout() {

    $("body").LoadingOverlay("show")

    $.ajax({
        type: 'GET',
        contentType: "application/json",
        dataType: "json",
        url: "/logout",
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
        },
        success: function (response) {

            // console.log(response)

            localStorage.clear()
            window.location = "/"

        },
        error: function (response) {

            // console.log(response)

            var data = response.responseJSON

            $("#message-alert").removeClass("d-none")

            $("#message-alert").html("Logout: ")
            $.each(data.messages, function (_, messages) {
                $("#message-alert").append(messages + '<br>')
            });

            $("body").LoadingOverlay("hide")

        }
    })
}