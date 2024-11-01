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

        var nombre = document.querySelector('#nombre').value;
        var usuario = document.querySelector('#usuario').value;
        var clave = document.querySelector('#clave').value;
        var rol = document.querySelector('#listRol').value;
        var estado = document.querySelector('#listEstado').value;
        
        if(nombre == '' || usuario == '' || clave == '' ){
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
                    $('#modalUsuario').modal('hide');
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
                        title: "Usuario",
                        text: data.msg,
                        confirmButtonColor: "#00695C",
                    });
                }
            }
        }
    }
})

function openModal(){
    $('#modalusuario').modal('show');
}