$(document).ready(function() {
    // Maneja el envío del formulario del profesor
    $('#profesorForm').on('submit', function(event) {
        event.preventDefault(); // Prevenir el comportamiento predeterminado
        if (validarCampos('usuarioProfesor', 'passProfesor', 'messageProfesor')) {
            loginProfesor();
        }
    });

    // Maneja el envío del formulario del administrador
    $('#adminForm').on('submit', function(event) {
        event.preventDefault();
        if (validarCampos('usuario', 'pass', 'messageUsuario')) {
            loginUsuario();
        }
    });

    // Maneja el envío del formulario del apoderado
    $('#apoderadoForm').on('submit', function (event) {
        event.preventDefault(); // Previene el comportamiento predeterminado
        if (validarCampos('usuarioApoderado', 'passApoderado', 'messageApoderado')) {
            loginApoderado(); // Llama a la función específica para apoderados
        }
    });
});

function validarCampos(inputUsuarioId, inputPasswordId, messageId) {
    const usuario = $(`#${inputUsuarioId}`).val().trim();
    const password = $(`#${inputPasswordId}`).val().trim();

    if (usuario === '' || password === '') {
        $(`#${messageId}`).html("Por favor, completa todos los campos.").addClass("text-danger");
        return false; // Detener el envío
    }

    $(`#${messageId}`).html(""); // Limpiar mensajes previos
    return true; // Permitir el envío
}

function loginProfesor() {
    if (!validarCampos('usuarioProfesor', 'passProfesor', 'messageProfesor')) return;

    const loginProfesor = $('#usuarioProfesor').val();
    const passProfesor = $('#passProfesor').val();

    $.ajax({
        url: './includes/loginProfesor.php',
        method: 'POST',
        data: { loginProfesor, passProfesor },
        success: function(data) {
            $('#messageProfesor').html(data);
            if (data.indexOf('Redirecting') >= 0) {
                window.location = 'profesor/';
            }
        },
        error: function() {
            $('#messageProfesor').html("Error al conectar con el servidor.");
        }
    });
}

function loginUsuario() {
    if (!validarCampos('usuario', 'pass', 'messageUsuario')) return;

    const login = $('#usuario').val();
    const pass = $('#pass').val();

    $.ajax({
        url: './includes/loginUsuario.php',
        method: 'POST',
        data: { login, pass },
        success: function(data) {
            $('#messageUsuario').html(data);
            if (data.indexOf('Redirecting') >= 0) {
                window.location = 'administrador/';
            }
        },
        error: function() {
            $('#messageUsuario').html("Error al conectar con el servidor.");
        }
    });
}

function loginApoderado() {
    if (!validarCampos('usuarioApoderado', 'passApoderado', 'messageApoderado')) return;

    const loginApoderado = $('#usuarioApoderado').val().trim();
    const passApoderado = $('#passApoderado').val().trim();

    $.ajax({
        url: './includes/loginApoderado.php', // Archivo PHP específico para apoderados
        method: 'POST',
        data: { loginApoderado, passApoderado },
        success: function (data) {
            $('#messageApoderado').html(data);
            if (data.indexOf('Redirigiendo') >= 0) {
                window.location = 'apoderado/';
            }
        },
        error: function () {
            $('#messageApoderado').html("Error al conectar con el servidor.").addClass("text-danger");
        }
    });
}
