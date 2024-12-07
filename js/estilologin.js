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
