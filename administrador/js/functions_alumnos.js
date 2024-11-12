$('#tableAlumnos').DataTable();
var tableAlumnos;

document.addEventListener('DOMContentLoaded',function(){
    tableAlumnos =$('#tableAlumnos').DataTable({
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "../js/es-ES.json",
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
            {"data": "documento"},
            {"data": "nombre_apoderado"},
            {"data": "fecha_nac"},
            {"data": "fecha_registro"},
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
                "filename": "Lista_Alumnos_XLSX",
                "title": "Lista de Alumnos",
            },
            {
                "extend":"pdf",
                "text": '<i class="fa-solid fa-file-pdf"></i>',
                "titleAttr": "Exportar a pdf",
                "className": "btn btn-danger",
                "exportOptions": {
                    "columns": ':not(:eq(0))'
                },
                "filename": "Lista_Alumnos_PDF",
                "title": "Lista de Alumnos",   
                "customize": function (doc) {
                    doc.styles.title = {
                        fontSize: 20,  
                        bold: true,
                        alignment: 'center'
                    };   
                    doc.content[1].table.widths = ['3%', '17%', '7%', '13%', '16%', '16%', '9%', '9%', '10%'];
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
                    .prepend('<h3>Lista de Alumnos</h3>')
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
    var formAlumno = document.querySelector('#formAlumno');
    if (formAlumno) {
        formAlumno.onsubmit =function(e){
            e.preventDefault();
            
            var idalumno =document.querySelector('#idalumno').value;
            var nombre = document.querySelector('#nombre').value;
            var edad = document.querySelector('#edad').value;
            var direccion = document.querySelector('#direccion').value;
            var documento = document.querySelector('#documento').value;
            var apoderado = document.querySelector('#listApoderado').value;
            var fecha_nac = document.querySelector('#fecha_nac').value;
            var fecha_reg = document.querySelector('#fecha_reg').value;
            var estado = document.querySelector('#listEstado').value;
            
            if(nombre == '' || edad == '' || direccion == '' || documento == '' || apoderado == '' || fecha_nac == ''){
                Swal.fire({
                    icon: "error",
                    title: "Atención",
                    text: "Todos los campos son necesarios",
                    confirmButtonColor: "#00695C",
                });
                return false;
            }

            if (edad < 4 || edad > 14 || isNaN(edad)) {
                Swal.fire({
                  icon: "error",
                  title: "Atención",
                  text: "Por favor, ingrese una edad válida entre 5 y 12 años.",
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

window.addEventListener('load',function(){
    if(document.querySelector('#listApoderado')){
        showApoderado();
    }
},false);

function showApoderado(){
    var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url = 'models/options/options-apoderado.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status ==200){
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor){
                data += '<option value="'+valor.apoderado_id+'">'+valor.nombre_apoderado+'</option>'
            });
            document.querySelector('#listApoderado').innerHTML = data;
        }
    };
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
                    document.querySelector('#documento').value = data.data.documento;
                    document.querySelector('#listApoderado').value = data.data.apoderado_id;
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