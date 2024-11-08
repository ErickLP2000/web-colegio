$('#tableMaterias').DataTable();
var tableMaterias;

document.addEventListener('DOMContentLoaded',function(){
    tableMaterias =$('#tableMaterias').DataTable({
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "../js/es-ES.json"    
        },
        "ajax":{
            "url": "./models/materias/table_materias.php",
            "dataSrc": ""
        },
        "columns":[
            {"data": "acciones"},
            {"data": "materia_id"},
            {"data": "nombre_materia"},
            {"data": "estado"}
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0,"asc"]]
    });
    var formMateria = document.querySelector('#formMateria');
    if (formMateria) {
        formMateria.onsubmit =function(e){
            e.preventDefault();
            
            var idmateria =document.querySelector('#idmateria').value;
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
            var url = 'models/materias/ajax-materias.php';
            var form = new FormData(formMateria);
            request.open('POST',url,true);
            request.send(form);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status ==200){
                    var data = JSON.parse(request.responseText);
                    if(data.status){
                        $('#modalMateria').modal('hide');
                        formMateria.reset();
                        Swal.fire({
                            icon: "success",
                            title: "Usuario",
                            text: data.msg,
                            confirmButtonColor: "#00695C",
                        });
                        tableMaterias.ajax.reload();
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

function openModalMateria(){
    document.querySelector('#idmateria').value='';
    document.querySelector('#tituloModal').innerHTML='Nueva Materia';
    document.querySelector('#action').innerHTML='Guardar';
    document.querySelector('#formMateria').reset();
    $('#modalMateria').modal('show');
}

function editarMateria(id){
    var idmateria = id;
    document.querySelector('#tituloModal').innerHTML='Actualizar Materia';
    document.querySelector('#action').innerHTML='Actualizar';

    var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/materias/edit-materias.php?idmateria='+idmateria;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status ==200){
                var data = JSON.parse(request.responseText);
                if(data.status){
                    document.querySelector('#idmateria').value = data.data.materia_id;
                    document.querySelector('#nombre').value = data.data.nombre_materia;
                    document.querySelector('#listEstado').value = data.data.estado;
                    $('#modalMateria').modal('show');
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

function eliminarMateria(id){
    var idmateria = id;
    Swal.fire({
        title: "Eliminar Materia",
        text: "Realmente desea eliminar la materia?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#00695C",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "No, cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
            var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/materias/delet-materias.php';
            request.open('POST',url,true);
            var strData="idmateria="+idmateria;
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
                        tableMaterias.ajax.reload();
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