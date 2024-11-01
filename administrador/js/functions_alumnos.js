$('#tableAlumnos').DataTable();
var tableAlumnos;

document.addEventListener('DOMContentLoaded',function(){
    tableAlumnos =$('#tableAlumnos').DataTable({
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json"    
        },
        "ajax":{
            "url": "./models/alumnos/table_alumnos.php",
            "dataSrc": ""
        },
        "columns":[
            {"data": "acciones"},
            {"data": "alumno_id"},
            {"data": "nombre_alumno"},
            {"data": "edad"},
            {"data": "direccion"},
            {"data": "cedula"},
            {"data": "telefono"},
            {"data": "correo"},
            {"data": "fecha_nac"},
            {"data": "fecha_registro"},
            {"data": "estado"}
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0,"asc"]]
    });
    var formAlumno = document.querySelector('#formAlumno');
    if (formAlumno) {
        formAlumno.onsubmit =function(e){
            e.preventDefault();
            
            var idalumno =document.querySelector('#idalumno').value;
            var nombre = document.querySelector('#nombre').value;
            var edad = document.querySelector('#edad').value;
            var direccion = document.querySelector('#direccion').value;
            var cedula = document.querySelector('#cedula').value;
            var telefono = document.querySelector('#telefono').value;
            var correo = document.querySelector('#correo').value;
            var fecha_nac = document.querySelector('#fecha_nac').value;
            var fecha_reg = document.querySelector('#fecha_reg').value;
            var estado = document.querySelector('#listEstado').value;
            
            if(nombre == '' || edad == '' || direccion == '' || cedula == '' || telefono == '' || correo == '' || fecha_nac == ''){
                Swal.fire({
                    icon: "error",
                    title: "Atención",
                    text: "Todos los campos son necesarios",
                    confirmButtonColor: "#00695C",
                });
                return false;
            }

            var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
            var url = 'models/alumnos/ajax-alumnos.php';
            var form = new FormData(formAlumno);
            request.open('POST',url,true);
            request.send(form);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status ==200){
                    var data = JSON.parse(request.responseText);
                    if(data.status){
                        $('#modalAlumno').modal('hide');
                        formAlumno.reset();
                        Swal.fire({
                            icon: "success",
                            title: "Usuario",
                            text: data.msg,
                            confirmButtonColor: "#00695C",
                        });
                        tableAlumnos.ajax.reload();
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

function openModalAlumno(){
    document.querySelector('#idalumno').value='';
    document.querySelector('#tituloModal').innerHTML='Nuevo Alumno';
    document.querySelector('#action').innerHTML='Guardar';
    document.querySelector('#formAlumno').reset();
    $('#modalAlumno').modal('show');
}

function editarAlumno(id){
    var idalumno = id;
    document.querySelector('#tituloModal').innerHTML='Actualizar Alumno';
    document.querySelector('#action').innerHTML='Actualizar';

    var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/alumnos/edit-alumnos.php?idalumno='+idalumno;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status ==200){
                var data = JSON.parse(request.responseText);
                if(data.status){
                    document.querySelector('#idalumno').value = data.data.alumno_id;
                    document.querySelector('#nombre').value = data.data.nombre_alumno;
                    document.querySelector('#edad').value = data.data.edad;
                    document.querySelector('#direccion').value = data.data.direccion;
                    document.querySelector('#cedula').value = data.data.cedula;
                    document.querySelector('#telefono').value = data.data.telefono;
                    document.querySelector('#correo').value = data.data.correo;
                    document.querySelector('#fecha_nac').value = data.data.fecha_nac;
                    document.querySelector('#fecha_reg').value = data.data.fecha_registro;
                    document.querySelector('#listEstado').value = data.data.estado;
                    $('#modalAlumno').modal('show');
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

function eliminarAlumno(id){
    var idalumno = id;
    Swal.fire({
        title: "Eliminar Alumno",
        text: "Realmente desea eliminar el alumno?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#00695C",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "No, cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
            var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/alumnos/delet-alumnos.php';
            request.open('POST',url,true);
            var strData="idalumno="+idalumno;
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
                        tableAlumnos.ajax.reload();
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