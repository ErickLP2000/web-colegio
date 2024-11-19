document.addEventListener('DOMContentLoaded',function(){
    var formContenido = document.querySelector('#formContenido');
    if (formContenido) {
        formContenido.onsubmit =function(e){
            e.preventDefault();
            
            var idcontenido =document.querySelector('#idcontenido').value;
            var nombre = document.querySelector('#nombre').value;
            var descripcion = document.querySelector('#descripcion').value;
            var material = document.querySelector('#file').value;
            
            if(nombre == '' || descripcion ==''){
                Swal.fire({
                    icon: "error",
                    title: "Atención",
                    text: "Todos los campos son necesarios",
                    confirmButtonColor: "#00695C",
                });
                return false;
            }

            var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
            var url = 'models/contenidos/ajax-contenidos.php';
            var form = new FormData(formContenido);
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
                                formContenido.reset(); // Resetea el formulario
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

function openModalContenido(){
    document.querySelector('#idcontenido').value='';
    document.querySelector('#tituloModal').innerHTML='Nuevo Contenido';
    document.querySelector('#action').innerHTML='Guardar';
    document.querySelector('#formContenido').reset();
    $('#modalContenido').modal('show');
}

function editarContenido(id){
    var idcontenido = id;
    document.querySelector('#tituloModal').innerHTML='Actualizar Contenido';
    document.querySelector('#action').innerHTML='Actualizar';

    var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/contenidos/edit-contenidos.php?idcontenido='+idcontenido;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status ==200){
                var data = JSON.parse(request.responseText);
                if(data.status){
                    document.querySelector('#idcontenido').value = data.data.contenido_id;
                    document.querySelector('#nombre').value = data.data.nombre_contenido;
                    document.querySelector('#descripcion').value = data.data.descripcion;
                    $('#modalContenido').modal('show');
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

function eliminarContenido(id){
    var idcontenido = id;
    Swal.fire({
        title: "Eliminar Contenido",
        text: "Realmente desea eliminar el contenido?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#00695C",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "No, cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
            var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/contenidos/delet-contenidos.php';
            request.open('POST',url,true);
            var strData="idcontenido="+idcontenido;
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