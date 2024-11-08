$('#tableActividades').DataTable();
var tableActividades;

document.addEventListener('DOMContentLoaded',function(){
    tableActividades =$('#tableActividades').DataTable({
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "../js/es-ES.json"    
        },
        "ajax":{
            "url": "./models/actividades/table_actividades.php",
            "dataSrc": ""
        },
        "columns":[
            {"data": "acciones"},
            {"data": "actividad_id"},
            {"data": "nombre_actividad"},
            {"data": "estado"}
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0,"asc"]]
    });
    var formActividad = document.querySelector('#formActividad');
    if (formActividad) {
        formActividad.onsubmit =function(e){
            e.preventDefault();
            
            var idactividad =document.querySelector('#idactividad').value;
            var nombre = document.querySelector('#nombre').value;
            var estado = document.querySelector('#listEstado').value;
            
            if(nombre == ''){
                Swal.fire({
                    icon: "error",
                    title: "Atención",
                    text: "Todos los campos son necesarios",
                    confirmButtonColor: "#00695C",
                });
                return false;
            }

            var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
            var url = 'models/actividades/ajax-actividades.php';
            var form = new FormData(formActividad);
            request.open('POST',url,true);
            request.send(form);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status ==200){
                    var data = JSON.parse(request.responseText);
                    if(data.status){
                        $('#modalActividad').modal('hide');
                        formActividad.reset();
                        Swal.fire({
                            icon: "success",
                            title: "Usuario",
                            text: data.msg,
                            confirmButtonColor: "#00695C",
                        });
                        tableActividades.ajax.reload();
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

function openModalActividad(){
    document.querySelector('#idactividad').value='';
    document.querySelector('#tituloModal').innerHTML='Nueva Actividad';
    document.querySelector('#action').innerHTML='Guardar';
    document.querySelector('#formActividad').reset();
    $('#modalActividad').modal('show');
}

function editarActividad(id){
    var idactividad = id;
    document.querySelector('#tituloModal').innerHTML='Actualizar Actividad';
    document.querySelector('#action').innerHTML='Actualizar';

    var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/actividades/edit-actividades.php?idactividad='+idactividad;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status ==200){
                var data = JSON.parse(request.responseText);
                if(data.status){
                    document.querySelector('#idactividad').value = data.data.actividad_id;
                    document.querySelector('#nombre').value = data.data.nombre_actividad;
                    document.querySelector('#listEstado').value = data.data.estado;
                    $('#modalActividad').modal('show');
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

function eliminarActividad(id){
    var idactividad = id;
    Swal.fire({
        title: "Eliminar Actividad",
        text: "Realmente desea eliminar la actividad?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#00695C",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "No, cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
            var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/actividades/delet-actividades.php';
            request.open('POST',url,true);
            var strData="idactividad="+idactividad;
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
                        tableActividades.ajax.reload();
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