$('#tablePeriodos').DataTable();
var tablePeriodos;

document.addEventListener('DOMContentLoaded',function(){
    tablePeriodos =$('#tablePeriodos').DataTable({
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json"    
        },
        "ajax":{
            "url": "./models/periodos/table_periodos.php",
            "dataSrc": ""
        },
        "columns":[
            {"data": "acciones"},
            {"data": "periodo_id"},
            {"data": "nombre_periodo"},
            {"data": "estado"}
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0,"asc"]]
    });
    var formPeriodo = document.querySelector('#formPeriodo');
    if (formPeriodo) {
        formPeriodo.onsubmit =function(e){
            e.preventDefault();
            
            var idperiodo =document.querySelector('#idperiodo').value;
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
            var url = 'models/periodos/ajax-periodos.php';
            var form = new FormData(formPeriodo);
            request.open('POST',url,true);
            request.send(form);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status ==200){
                    var data = JSON.parse(request.responseText);
                    if(data.status){
                        $('#modalPeriodo').modal('hide');
                        formPeriodo.reset();
                        Swal.fire({
                            icon: "success",
                            title: "Usuario",
                            text: data.msg,
                            confirmButtonColor: "#00695C",
                        });
                        tablePeriodos.ajax.reload();
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

function openModalPeriodo(){
    document.querySelector('#idperiodo').value='';
    document.querySelector('#tituloModal').innerHTML='Nuevo Periodo';
    document.querySelector('#action').innerHTML='Guardar';
    document.querySelector('#formPeriodo').reset();
    $('#modalPeriodo').modal('show');
}

function editarPeriodo(id){
    var idperiodo = id;
    document.querySelector('#tituloModal').innerHTML='Actualizar Periodo';
    document.querySelector('#action').innerHTML='Actualizar';

    var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/periodos/edit-periodos.php?idperiodo='+idperiodo;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status ==200){
                var data = JSON.parse(request.responseText);
                if(data.status){
                    document.querySelector('#idperiodo').value = data.data.periodo_id;
                    document.querySelector('#nombre').value = data.data.nombre_periodo;
                    document.querySelector('#listEstado').value = data.data.estado;
                    $('#modalPeriodo').modal('show');
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

function eliminarPeriodo(id){
    var idperiodo = id;
    Swal.fire({
        title: "Eliminar Periodo",
        text: "Realmente desea eliminar el periodo?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#00695C",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "No, cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
            var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/periodo/delet-periodos.php';
            request.open('POST',url,true);
            var strData="idperiodo="+idperiodo;
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
                        tablePeriodos.ajax.reload();
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