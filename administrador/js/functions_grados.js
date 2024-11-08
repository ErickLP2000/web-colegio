$('#tableGrados').DataTable();
var tableGrados;

document.addEventListener('DOMContentLoaded',function(){
    tableGrados =$('#tableGrados').DataTable({
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "../js/es-ES.json"    
        },
        "ajax":{
            "url": "./models/grados/table_grados.php",
            "dataSrc": ""
        },
        "columns":[
            {"data": "acciones"},
            {"data": "grado_id"},
            {"data": "nombre_grado"},
            {"data": "estado"}
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0,"asc"]]
    });
    var formGrado = document.querySelector('#formGrado');
    if (formGrado) {
        formGrado.onsubmit =function(e){
            e.preventDefault();
            
            var idgrado =document.querySelector('#idgrado').value;
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
            var url = 'models/grados/ajax-grados.php';
            var form = new FormData(formGrado);
            request.open('POST',url,true);
            request.send(form);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status ==200){
                    var data = JSON.parse(request.responseText);
                    if(data.status){
                        $('#modalGrado').modal('hide');
                        formGrado.reset();
                        Swal.fire({
                            icon: "success",
                            title: "Usuario",
                            text: data.msg,
                            confirmButtonColor: "#00695C",
                        });
                        tableGrados.ajax.reload();
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

function openModalGrado(){
    document.querySelector('#idgrado').value='';
    document.querySelector('#tituloModal').innerHTML='Nuevo Grado';
    document.querySelector('#action').innerHTML='Guardar';
    document.querySelector('#formGrado').reset();
    $('#modalGrado').modal('show');
}

function editarGrado(id){
    var idgrado = id;
    document.querySelector('#tituloModal').innerHTML='Actualizar Grado';
    document.querySelector('#action').innerHTML='Actualizar';

    var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/grados/edit-grados.php?idgrado='+idgrado;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status ==200){
                var data = JSON.parse(request.responseText);
                if(data.status){
                    document.querySelector('#idgrado').value = data.data.grado_id;
                    document.querySelector('#nombre').value = data.data.nombre_grado;
                    document.querySelector('#listEstado').value = data.data.estado;
                    $('#modalGrado').modal('show');
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

function eliminarGrado(id){
    var idgrado = id;
    Swal.fire({
        title: "Eliminar Grado",
        text: "Realmente desea eliminar el grado?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#00695C",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "No, cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
            var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/grados/delet-grados.php';
            request.open('POST',url,true);
            var strData="idgrado="+idgrado;
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
                        tableGrados.ajax.reload();
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