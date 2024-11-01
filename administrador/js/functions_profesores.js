$('#tableProfesores').DataTable();
var tableProfesores;

document.addEventListener('DOMContentLoaded',function(){
    tableProfesores =$('#tableProfesores').DataTable({
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json"    
        },
        "ajax":{
            "url": "./models/profesores/table_profesores.php",
            "dataSrc": ""
        },
        "columns":[
            {"data": "acciones"},
            {"data": "profesor_id"},
            {"data": "nombre"},
            {"data": "direccion"},
            {"data": "cedula"},
            {"data": "telefono"},
            {"data": "correo"},
            {"data": "nivel_est"},
            {"data": "estado"}
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0,"asc"]]
    });
    var formProfesor = document.querySelector('#formProfesor');
    if (formProfesor) {
        formProfesor.onsubmit =function(e){
            e.preventDefault();
            
            var idprofesor =document.querySelector('#idprofesor').value;
            var nombre = document.querySelector('#nombre').value;
            var direccion = document.querySelector('#direccion').value;
            var cedula = document.querySelector('#cedula').value;
            var clave = document.querySelector('#clave').value;
            var telefono = document.querySelector('#telefono').value;
            var correo = document.querySelector('#correo').value;
            var nivel_est = document.querySelector('#nivel_est').value;
            var estado = document.querySelector('#listEstado').value;
            
            if(nombre == '' || direccion == '' || cedula == '' || telefono == '' || correo == '' || nivel_est == ''){
                Swal.fire({
                    icon: "error",
                    title: "Atención",
                    text: "Todos los campos son necesarios",
                    confirmButtonColor: "#00695C",
                });
                return false;
            }

            var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
            var url = 'models/profesores/ajax-profesores.php';
            var form = new FormData(formProfesor);
            request.open('POST',url,true);
            request.send(form);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status ==200){
                    var data = JSON.parse(request.responseText);
                    if(data.status){
                        $('#modalProfesor').modal('hide');
                        formProfesor.reset();
                        Swal.fire({
                            icon: "success",
                            title: "Usuario",
                            text: data.msg,
                            confirmButtonColor: "#00695C",
                        });
                        tableProfesores.ajax.reload();
                    }else{
                        Swal.fire({
                            icon: "error",
                            title: "Atención",
                            text: data.msg,
                            confirmButtonColor: "#00695C",
                        });
                    }
                }
            };
        }
    }
});

function openModalProfesor(){
    document.querySelector('#idprofesor').value='';
    document.querySelector('#tituloModal').innerHTML='Nuevo Profesor';
    document.querySelector('#action').innerHTML='Guardar';
    document.querySelector('#formProfesor').reset();
    $('#modalProfesor').modal('show');
}

function editarProfesor(id){
    var idprofesor = id;
    document.querySelector('#tituloModal').innerHTML='Actualizar Profesor';
    document.querySelector('#action').innerHTML='Actualizar';

    var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/profesores/edit-profesores.php?idprofesor='+idprofesor;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status ==200){
                var data = JSON.parse(request.responseText);
                if(data.status){
                    document.querySelector('#idprofesor').value = data.data.profesor_id;
                    document.querySelector('#nombre').value = data.data.nombre;
                    document.querySelector('#direccion').value = data.data.direccion;
                    document.querySelector('#cedula').value = data.data.cedula;
                    document.querySelector('#telefono').value = data.data.telefono;
                    document.querySelector('#correo').value = data.data.correo;
                    document.querySelector('#nivel_est').value = data.data.nivel_est;
                    document.querySelector('#listEstado').value = data.data.estado;
                    $('#modalProfesor').modal('show');
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

function eliminarProfesor(id){
    var idprofesor = id;
    Swal.fire({
        title: "Eliminar Profesor",
        text: "Realmente desea eliminar el profesor?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#00695C",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "No, cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
            var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/profesores/delet-profesores.php';
            request.open('POST',url,true);
            var strData="idprofesor="+idprofesor;
            request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status ==200){
                    var data = JSON.parse(request.responseText);
                    if(data.status){
                        Swal.fire({
                            title: "Eliminado",
                            text: data.msg,
                            icon: "success",
                            confirmButtonColor: "#00695C"
                        });
                        tableProfesores.ajax.reload();
                    }else{
                        Swal.fire({
                            icon: "error",
                            title: "Atencion",
                            text: data.msg,
                            confirmButtonColor: "#00695C",
                        });
                    }
                }
            }
        }
    });
}