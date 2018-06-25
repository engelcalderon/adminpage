$("#loginForm").submit( function(e) {
    e.preventDefault();

    $.ajax({
        type: 'POST',
        url: "../authentication/submitLogin",
        data: {
            email: $("#loginEmail").val(),
            password:$("#loginPassword").val()
        },
        beforeSend: function(response) {
            console.log("loading");
        },
        success: function(response) {
            response = JSON.parse(response);
            
            if (response.status == "success") {
                window.location.href = "<?php echo URL; ?>dashboard"
            }
            else if (response.status == "error") {
                $("#loginErrorBox").show();
                $("#loginErrorMessage").text(response.message);
            }
        },
        error: function(response) {

        }
    });
});
$(document).ready(function () {
    console.log('here');
});

// Añadir nuevos clientes formulario
$("#registroCliente_provincia").click(function(e) {
    console.log("here");
});