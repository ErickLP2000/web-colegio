document.addEventListener('DOMContentLoaded',function(){
    var formNota = document.querySelector('#formNota');
    if (formNota) {
        formNota.onsubmit =function(e){
            e.preventDefault();
            
            var ideventregada =document.querySelector('#ideventregada').value;
            var nota = document.querySelector('#nota').value;
            
            if(nota.trim() == ''){
                Swal.fire({
                    icon: "error",
                    title: "Atención",
                    text: "Todos los campos son necesarios",
                    confirmButtonColor: "#00695C",
                });
                return false;
            }

            // Validación del rango de la nota (0 a 20)
            if (nota < 0 || nota > 20) {
                Swal.fire({
                    icon: "error",
                    title: "Atención",
                    text: "La nota debe estar entre 0 y 20",
                    confirmButtonColor: "#00695C",
                });
                return false;
            }

            var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
            var url = 'models/notas/ajax-notas.php';
            var form = new FormData(formNota);
            request.open('POST',url,true);
            request.send(form);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    console.log(request.responseText);
                    var data = JSON.parse(request.responseText);
                    Swal.fire({
                        icon: "success",
                        title: "Crear Nota",
                        text: data.msg,
                        confirmButtonColor: "#00695C",
                    }).then((result) => { // Usamos .then para manejar la respuesta
                        if (result.isConfirmed) { // Verificamos si se confirmó el SweetAlert
                            if (data.status) {
                                $('#modalNota').modal('hide');
                                formNota.reset(); // Resetea el formulario
                                location.reload(); // Recarga la página
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Atención",
                                    text: data.msg,
                                    confirmButtonColor: "#00695C",
                                });
                            }
                        }
                    });
                }
            };
        }
    }
});

function modalNota(){
    $('#modalNota').modal('show');
}