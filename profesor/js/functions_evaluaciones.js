document.addEventListener('DOMContentLoaded',function(){
    var formEvaluacion = document.querySelector('#formEvaluacion');
    if (formEvaluacion) {
        formEvaluacion.onsubmit =function(e){
            e.preventDefault();
            
            var idevaluacion =document.querySelector('#idevaluacion').value;
            var idcontenido =document.querySelector('#idcontenido').value;
            var nombre = document.querySelector('#nombre').value;
            var descripcion = document.querySelector('#descripcion').value;
            var fecha = document.querySelector('#fecha').value;
            var valor = document.querySelector('#valor').value;
            
            if(nombre == '' || descripcion =='' || fecha =='' || valor ==''){
                Swal.fire({
                    icon: "error",
                    title: "Atención",
                    text: "Todos los campos son necesarios",
                    confirmButtonColor: "#00695C",
                });
                return false;
            }

            var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
            var url = 'models/evaluaciones/ajax-evaluaciones.php';
            var form = new FormData(formEvaluacion);
            request.open('POST',url,true);
            request.send(form);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    Swal.fire({
                        icon: "success",
                        title: "Usuario",
                        text: data.msg,
                        confirmButtonColor: "#00695C",
                    }).then((result) => { // Usamos .then para manejar la respuesta
                        if (result.isConfirmed) { // Verificamos si se confirmó el SweetAlert
                            if (data.status) {
                                $('#modalContenido').modal('hide');
                                formEvaluacion.reset(); // Resetea el formulario
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

function openModalEvaluacion(){
    document.querySelector('#idevaluacion').value='';
    document.querySelector('#tituloModal').innerHTML='Nueva Evaluacion';
    document.querySelector('#action').innerHTML='Guardar';
    document.querySelector('#formEvaluacion').reset();
    $('#modalEvaluacion').modal('show');
}

function editarEvaluacion(id){
    var idevaluacion = id;
    document.querySelector('#tituloModal').innerHTML='Actualizar Evaluación';
    document.querySelector('#action').innerHTML='Actualizar';

    var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/evaluaciones/edit-evaluaciones.php?idevaluacion='+idevaluacion;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status ==200){
                var data = JSON.parse(request.responseText);
                if(data.status){
                    document.querySelector('#idevaluacion').value = data.data.evaluacion_id;
                    document.querySelector('#nombre').value = data.data.nombre_evaluacion;
                    document.querySelector('#descripcion').value = data.data.descripcion;
                    document.querySelector('#fecha').value = data.data.fecha;
                    document.querySelector('#valor').value = data.data.porcentaje;
                    $('#modalEvaluacion').modal('show');
                }else{
                    Swal.fire({
                        icon: "error",
                        title: "Usuario",
                        text: data.msg,
                        confirmButtonColor: "#00695C",
                    });
                }
            }
        }
}

function eliminarEvaluacion(id){
    var idevaluacion = id;
    Swal.fire({
        title: "Eliminar Evaluación",
        text: "Realmente desea eliminar la evaluación?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#00695C",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "No, cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
            var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/evaluaciones/delet-evaluaciones.php';
            request.open('POST',url,true);
            var strData="idevaluacion="+idevaluacion;
            request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status ==200){
                    var data = JSON.parse(request.responseText);
                    if (data.status) {
                        Swal.fire({
                            title: "Eliminado",
                            text: data.msg,
                            icon: "success",
                            confirmButtonColor: "#00695C"
                        }).then(() => { // Usamos then correctamente aquí
                            location.reload();  
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Atención",
                            text: data.msg,
                            confirmButtonColor: "#00695C",
                        });
                    }
                }
            }
        }
    });
}