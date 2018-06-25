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
                window.location.href = "../dashboard"
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

// Añadir nuevos clientes formulario
provinciasLoaded = false;
$("#buttonNuevoCliente").click(function(e) {
    if (!provinciasLoaded) {
        $.ajax({
            type: 'GET',
            url: 'https://ubicaciones.paginasweb.cr/provincias.json',
            dataType: 'json',
            success: function(response) {
                var html = "";
                for(key in response) {
                    html += "<option value="+key+">" + response[key] + "</option>";
                }
                $("#registroCliente_provincia").append(html);
                provinciasLoaded = true;
            }
        });
    }
});

function getCantones(provinciaID) {
     $("#registroCliente_distrito").html('<option value="0" selected="selected">Seleccione una opción</option>');

    if (provinciaID == 0)  {
        $("#registroCliente_canton").html('<option value="0" selected="selected">Seleccione una opción</option>');
        return;
    }  
    $.ajax({
        type: 'GET',
        url: 'https://ubicaciones.paginasweb.cr/provincia/'+provinciaID+'/cantones.json',
        dataType: 'json',
        success: function(response) {
            var html = '<option value="0" selected="selected">Seleccione una opción</option>';
            for(key in response) {
                html += "<option value="+key+">" + response[key] + "</option>";
            }
            $("#registroCliente_canton").html(html);
        }
    });
    
}

function getDistritos(cantonID) {
    if (cantonID == 0)
    {
        $("#registroCliente_distrito").html('<option value="0" selected="selected">Seleccione una opción</option>');
        return;
    }
    $.ajax({
        type: 'GET',
        url: 'https://ubicaciones.paginasweb.cr/provincia/1/canton/'+cantonID+'/distritos.json',
        dataType: 'json',
        success: function(response) {
            var html = '<option value="0" selected="selected">Seleccione una opción</option>';
            for(key in response) {
                html += "<option value="+key+">" + response[key] + "</option>";
            }
            $("#registroCliente_distrito").html(html);
        }
    });
}

$("#nuevoClientForm").submit(function(e) {
    e.preventDefault();

    $.ajax({
        type: 'POST',
        url: "./../dashboard/clientes/submitCliente",
        data: {
            tipoID: $("#registroCliente_tipoID").val(),
            ID: $("#registroCliente_identificacion").val(),
            nombre: $("#registroCliente_nombre").val(),
            nfantasia: $("#registroCliente_nombrefantasia").val(),
            telefono: $("#registroCliente_telefono").val(),
            email: $("#registroCliente_email").val(),
            provincia:$("#registroCliente_provincia option:selected").text(),
            canton: $("#registroCliente_canton option:selected").text(),
            distrito: $("#registroCliente_distrito option:selected").text(),
            barrio: $("#registroCliente_barrio").val(),
            direccion: $("#registroCliente_direccion").val(),
        },
        beforeSend: function(response) {
            $("#buttonNewClientSaveChanges").text("Guardando...");
        },
        success: function(response) {
            response = JSON.parse(response);
            
            var html = "";

            if (response.status == "success") {
                html += `
                <tr>
                    <td>`+response.client["identificacion"]+`</td>
                    <td>`+response.client["tipoID"]+`</td>
                    <td>`+response.client["nombre"]+`</td>
                    <td>`+response.client["nombre_fantasia"]+`</td>
                    <td>`+response.client["telefono"]+`</td>
                    <td>`+response.client["email"]+`</td>
                    <td>`+response.client["provincia"]+`</td>
                    <td>`+response.client["canton"]+`</td>
                    <td>`+response.client["distrito"]+`</td>
                    <td>`+response.client["barrio"]+`</td>
                    <td>`+response.client["direccion"]+`</td>
                </tr>
                `;
                $("#buttonNewClientSaveChanges").text("Listo");
                $("#modal-default").modal('hide');
                $("#clientsTableBody").append(html);
            }
            else if (response.status == "error") {
                $("#buttonNewClientSaveChanges").text("Guardar cambios");
                // $("#loginErrorBox").show();
                // $("#loginErrorMessage").text(response.message);
            }
        },
        error: function(response) {
            $("#buttonNewClientSaveChanges").text("Guardar cambios");
            alert(response);
        }
    });
});