$('#tableusuario').DataTable();
var tableusuarios;

document.addEventListener('DOMContentLoaded',function(){
    tableusuarios =$('#tableusuario').DataTable({
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json"    
        },
        "ajax":{
            "url": "./models/usuarios/table_usuarios.php",
            "dataSrc": ""
        },
        "columns":[
            {"data": "acciones"},
            {"data": "usuario_id"},
            {"data": "nombre"},
            {"data": "usuario"},
            {"data": "nombre_rol"},
            {"data": "estado"}
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0,"asc"]]
    });
    var formUsuario = document.querySelector('#formUsuario');
    formUsuario.onsubmit =function(e){
        e.preventDefault();
        
        var idusuario =document.querySelector('#idusuario').value;
        var nombre = document.querySelector('#nombre').value;
        var usuario = document.querySelector('#usuario').value;
        var clave = document.querySelector('#clave').value;
        var rol = document.querySelector('#listRol').value;
        var estado = document.querySelector('#listEstado').value;
        
        if(nombre == '' || usuario == ''){
            Swal.fire({
                icon: "error",
                title: "Atención",
                text: "Todos los campos son necesarios",
                confirmButtonColor: "#00695C",
            });
            return false;
        }

        var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = 'models/usuarios/ajax-usuarios.php';
        var form = new FormData(formUsuario);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status ==200){
                var data = JSON.parse(request.responseText);
                if(data.status){
                    $('#modalusuario').modal('hide');
                    formUsuario.reset();
                    Swal.fire({
                        icon: "success",
                        title: "Usuario",
                        text: data.msg,
                        confirmButtonColor: "#00695C",
                    });
                    tableusuarios.ajax.reload();
                }else{
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
})
function openModal(){
    document.querySelector('#idusuario').value='';
    document.querySelector('#tituloModal').innerHTML='Nuevo Usuario';
    document.querySelector('#action').innerHTML='Guardar';
    document.querySelector('#formUsuario').reset();
    $('#modalusuario').modal('show');
}

function editarUsuario(id){
    var idusuario = id;
    document.querySelector('#tituloModal').innerHTML='Actualizar Usuario';
    document.querySelector('#action').innerHTML='Actualizar';

    var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/usuarios/edit-usuarios.php?idusuario='+idusuario;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status ==200){
                var data = JSON.parse(request.responseText);
                if(data.status){
                    document.querySelector('#idusuario').value=data.data.usuario_id;
                    document.querySelector('#nombre').value=data.data.nombre;
                    document.querySelector('#usuario').value=data.data.usuario;
                    document.querySelector('#listRol').value=data.data.rol;
                    document.querySelector('#listEstado').value=data.data.estado;
                    $('#modalusuario').modal('show');
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

function eliminarUsuario(id){
    var idusuario = id;
    Swal.fire({
        title: "Eliminar Usuario",
        text: "Realmente desea eliminar usuario?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#00695C",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "No, cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
            var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/usuarios/delet-usuarios.php';
            request.open('POST',url,true);
            var strData="idusuario="+idusuario;
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
                        tableusuarios.ajax.reload();
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