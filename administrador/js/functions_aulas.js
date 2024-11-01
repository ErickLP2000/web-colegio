$('#tableAulas').DataTable();
var tableAulas;

document.addEventListener('DOMContentLoaded',function(){
    tableAulas =$('#tableAulas').DataTable({
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json"    
        },
        "ajax":{
            "url": "./models/aulas/table_aulas.php",
            "dataSrc": ""
        },
        "columns":[
            {"data": "acciones"},
            {"data": "aula_id"},
            {"data": "nombre_aula"},
            {"data": "estado"}
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0,"asc"]]
    });
    var formAula = document.querySelector('#formAula');
    if (formAula) {
        formAula.onsubmit =function(e){
            e.preventDefault();
            
            var idaula =document.querySelector('#idaula').value;
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
            var url = 'models/aulas/ajax-aulas.php';
            var form = new FormData(formAula);
            request.open('POST',url,true);
            request.send(form);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status ==200){
                    var data = JSON.parse(request.responseText);
                    if(data.status){
                        $('#modalAula').modal('hide');
                        formAula.reset();
                        Swal.fire({
                            icon: "success",
                            title: "Usuario",
                            text: data.msg,
                            confirmButtonColor: "#00695C",
                        });
                        tableAulas.ajax.reload();
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

function openModalAula(){
    document.querySelector('#idaula').value='';
    document.querySelector('#tituloModal').innerHTML='Nuevo Aula';
    document.querySelector('#action').innerHTML='Guardar';
    document.querySelector('#formAula').reset();
    $('#modalAula').modal('show');
}

function editarAula(id){
    var idaula = id;
    document.querySelector('#tituloModal').innerHTML='Actualizar Aula';
    document.querySelector('#action').innerHTML='Actualizar';

    var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/aulas/edit-aulas.php?idaula='+idaula;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status ==200){
                var data = JSON.parse(request.responseText);
                if(data.status){
                    document.querySelector('#idaula').value = data.data.aula_id;
                    document.querySelector('#nombre').value = data.data.nombre_aula;
                    document.querySelector('#listEstado').value = data.data.estado;
                    $('#modalAula').modal('show');
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

function eliminarAula(id){
    var idaula = id;
    Swal.fire({
        title: "Eliminar Aula",
        text: "Realmente desea eliminar el aula?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#00695C",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "No, cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
            var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/aulas/delet-aulas.php';
            request.open('POST',url,true);
            var strData="idaula="+idaula;
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
                        tableAulas.ajax.reload();
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