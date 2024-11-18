$('#tableusuario').DataTable();
var tableusuarios;

document.addEventListener('DOMContentLoaded',function(){
    tableusuarios =$('#tableusuario').DataTable({
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "../js/es-ES.json"    
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
        "dom": 'lBfrtip',
        "buttons": [
            {
                "extend":"copy",
                "text": "Copiar",
                "titleAttr": "Copiar",
                "className": "btn btn-secondary",
                "exportOptions": {
                    "columns": ':not(:eq(0))'
                }
            },
            {
                "extend":"excel",
                "text": '<i class="fa-solid fa-file-excel"></i>',
                "titleAttr": "Exportar a excel",
                "className": "btn btn-success",
                "exportOptions": {
                    "columns": ':not(:eq(0))'
                },
                "filename": "Lista_Usuarios_XLSX",
                "title": "Lista de Usuarios",
            },
            
            {
                "extend":"pdf",
                "text": '<i class="fa-solid fa-file-pdf"></i>',
                "titleAttr": "Exportar a pdf",
                "className": "btn btn-danger",
                "exportOptions": {
                    "columns": ':not(:eq(0))'
                },
                "filename": "Lista_Usuarios_PDF",
                "title": "Lista de Usuarios",   
                "customize": function (doc) {
                    doc.styles.title = {
                        fontSize: 20,  
                        bold: true,
                        alignment: 'center'
                    };   
                    doc.content[1].table.widths = [ '6%', '52%', '15%', '15%', '12%' ];
                    doc.styles.tableHeader.fontSize = 12;
                    doc.pageMargins = [ 20, 40, 20, 30 ];
                    doc.defaultStyle.fontSize = 10;
                }
            },

            {
                "extend":"print",
                "text": '<i class="fa-solid fa-print"></i>',
                "titleAttr": "Imprimir",
                "className": "btn btn-info",
                "exportOptions": {
                    "columns": ':not(:eq(0))'
                },
                "customize": function (win) {
                $(win.document.body)
                    .css('font-size', '10pt')
                    .prepend('<h3>Lista de Usuarios</h3>')
                }
            },
            {
                "extend":"colvis",
                "text": "Filtrar Columnas"
            }
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0,"asc"]]
    });
    // Manejo del ícono para mostrar/ocultar la contraseña
    const togglePassword = document.getElementById("togglePassword");
    const passwordField = document.getElementById("clave");

    // Mostrar contraseña mientras se mantiene presionado el ícono
    togglePassword.addEventListener("mousedown", function () {
        passwordField.type = "text"; // Cambia a texto visible
    });

    // Ocultar contraseña al soltar el ícono
    togglePassword.addEventListener("mouseup", function () {
        passwordField.type = "password"; // Regresa a modo oculto
    });

    // Por si el usuario arrastra el cursor fuera del ícono mientras presiona
    togglePassword.addEventListener("mouseleave", function () {
        passwordField.type = "password"; // Regresa a modo oculto
    });

    $('#modalusuario').on('show.bs.modal', function (e) {
        // Limpiar el campo de la contraseña al abrir el modal para editar otro usuario
        document.querySelector('#clave').value = '';
        document.querySelector('#clave').type = 'password'; // Asegúrate de que el campo de contraseña sea oculto por defecto
    });

    var formUsuario = document.querySelector('#formUsuario');
    if(formUsuario){
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

            var nombreRegex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]*$/;
            if (!nombreRegex.test(nombre)) {
                Swal.fire({
                    icon: "error",
                    title: "Atención",
                    text: "El nombre solo puede contener letras y espacios.",
                    confirmButtonColor: "#00695C",
                });
                return false;
            }

            if (clave && clave !== '') {
                var contraRegex = /^(?=.*[a-záéíóúñ])(?=.*[A-ZÁÉÍÓÚÑÑ])(?=.*\d).{6,}$/;
                if (!contraRegex.test(clave)) {
                    Swal.fire({
                        icon: "error",
                        title: "Atención",
                        text: "La contraseña debe tener una letra mayúscula, una minúscula y un número.",
                        confirmButtonColor: "#00695C",
                    });
                    return false;
                }
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
        };
    }
});



function openModalUsuario(){
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