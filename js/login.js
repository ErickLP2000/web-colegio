// Lógica de alternancia de vistas
document.getElementById('switchView').addEventListener('click', () => {
    const adminView = document.getElementById('adminView');
    const profesorView = document.getElementById('profesorView');
    const imageSection = document.getElementById('imageSection');
    const formSection = document.getElementById('formSection');
    const profesorImage = document.querySelector('.profesor-image');
    const adminImage = document.querySelector('.admin-image');

    // Alternar las vistas
    if (profesorView.classList.contains('active-view')) {
        profesorView.classList.remove('active-view');
        adminView.classList.add('active-view');
        
        // Cambiar posiciones
        imageSection.style.transform = 'translateX(+100%)';
        formSection.style.transform = 'translateX(-100%)';
        
        // Mostrar imagen de Administrador y ocultar imagen de Profesor
        adminImage.style.display = 'block';
        profesorImage.style.display = 'none';
    } else {
        adminView.classList.remove('active-view');
        profesorView.classList.add('active-view');

        // Restaurar posiciones
        imageSection.style.transform = 'translateX(0)';
        formSection.style.transform = 'translateX(0)';
        
        // Mostrar imagen de Profesor y ocultar imagen de Administrador
        profesorImage.style.display = 'block';
        adminImage.style.display = 'none';
    }
});


$(document).ready(function(){
    $('#loginUsuario').on('click',function(){
        loginUsuario();
    });
    $('#loginProfesor').on('click',function(){
        loginProfesor();
    });
})

function loginUsuario(){
    var login = $('#usuario').val();
    var pass = $('#pass').val();

    $.ajax({
        url: './includes/loginUsuario.php',
        method: 'POST',
        data: {
            login:login,
            pass:pass
        },
        success: function(data) {
            $('#messageUsuario').html(data);
            if(data.indexOf('Redirecting') >= 0){
                window.location = 'administrador/';
            }
        }
    })
}
function loginProfesor(){
    var loginProfesor = $('#usuarioProfesor').val();
    var passProfesor = $('#passProfesor').val();

    $.ajax({
        url: './includes/loginProfesor.php',
        method: 'POST',
        data: {
            loginProfesor:loginProfesor,
            passProfesor:passProfesor
        },
        success: function(data) {
            $('#messageProfesor').html(data);
            if(data.indexOf('Redirecting') >= 0){
                window.location = 'profesor/';
            }
        }
    })
}
