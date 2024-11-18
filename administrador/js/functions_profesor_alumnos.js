$('#tableProfesorAlumnos').DataTable();
var tableProfesorAlumnos;

document.addEventListener('DOMContentLoaded',function(){
    tableProfesorAlumnos =$('#tableProfesorAlumnos').DataTable({
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "../js/es-ES.json"    
        },
        "ajax":{
            "url": "./models/profesor-alumno/table_profesor_alumnos.php",
            "dataSrc": ""
        },
        "columns":[
            {"data": "acciones"},
            {"data": "pa_id"},
            {"data": "nombre"},
            {"data": "nombre_alumno"},
            {"data": "nombre_materia"},            
            {"data": "nombre_grado"},
            {"data": "nombre_periodo"},
            {"data": "estadopa"}
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
                "filename": "Lista_Profesor_Alumno_XLSX",
                "title": "Lista de Profesor Alumno",
            },
            
            {
                "extend":"pdf",
                "text": '<i class="fa-solid fa-file-pdf"></i>',
                "titleAttr": "Exportar a pdf",
                "className": "btn btn-danger",
                "exportOptions": {
                    "columns": ':not(:eq(0))'
                },
                "filename": "Lista_Profesor_Alumno_PDF",
                "title": "Lista de Profesor Alumno",   
                "customize": function (doc) {
                    doc.styles.title = {
                        fontSize: 20,  
                        bold: true,
                        alignment: 'center'
                    };   
                    doc.content[1].table.widths = ['3%', '25%', '25%', '18%', '8%', '12%', '9%'];
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
                    .prepend('<h3>Lista de Profesor Alumno</h3>')
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
    var formProfesorAlumno = document.querySelector('#formProfesorAlumno');
    if (formProfesorAlumno) {
        formProfesorAlumno.onsubmit =function(e){
            e.preventDefault();
            
            var idprofesoralumno =document.querySelector('#idprofesoralumno').value;
            var profesor = document.querySelector('#listAProfesor').value;
            var alumno = document.querySelector('#listAlumno').value;
            var periodo = document.querySelector('#listPeriodo').value;
            var estado = document.querySelector('#listEstado').value;
            
            if(profesor == '' || alumno == '' || periodo == ''|| estado == ''){
                Swal.fire({
                    icon: "error",
                    title: "Atención",
                    text: "Todos los campos son necesarios",
                    confirmButtonColor: "#00695C",
                });
                return false;
            }

            var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
            var url = 'models/profesor-alumno/ajax-profesor-alumnos.php';
            var form = new FormData(formProfesorAlumno);
            request.open('POST',url,true);
            request.send(form);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status ==200){
                    var data = JSON.parse(request.responseText);
                    if(data.status){
                        $('#modalProfesorAlumno').modal('hide');
                        formProfesorAlumno.reset();
                        Swal.fire({
                            icon: "success",
                            title: "Usuario",
                            text: data.msg,
                            confirmButtonColor: "#00695C",
                        });
                        tableProfesorAlumnos.ajax.reload();
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

function openModalProfesorAlumno(){
    document.querySelector('#idprofesoralumno').value='';
    document.querySelector('#tituloModal').innerHTML='Nuevo Profesor Alumno';
    document.querySelector('#action').innerHTML='Guardar';
    document.querySelector('#formProfesorAlumno').reset();
    $('#modalProfesorAlumno').modal('show');
}

window.addEventListener('load',function(){
    if(document.querySelector('#listAProfesor')){
        showAProfesor();
    }
    if(document.querySelector('#listAlumno')){
        showAlumno();
    }
    if(document.querySelector('#listPeriodo')){
        showPeriodo();
    }
},false);

function showAProfesor(){
    var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url = 'models/options/options-aprofesor.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status ==200){
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor){
                data += '<option value="'+valor.pg_id+'">'+valor.nombre+', '+valor.nombre_grado+', '+valor.nombre_materia+', Aula:'+valor.nombre_aula+'</option>';
            });
            document.querySelector('#listAProfesor').innerHTML = data;
        }
    };
}

function showAlumno(){
    var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url = 'models/options/options-alumno.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status ==200){
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor){
                data += '<option value="'+valor.alumno_id+'">'+valor.nombre_alumno+'</option>'
            });
            document.querySelector('#listAlumno').innerHTML = data;
        }
    };
}

function showPeriodo(){
    var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url = 'models/options/options-periodo.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status ==200){
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor){
                data += '<option value="'+valor.periodo_id+'">'+valor.nombre_periodo+'</option>'
            });
            document.querySelector('#listPeriodo').innerHTML = data;
        }
    };
}

function editarProfesorAlumno(id){
    var idprofesoralumno = id;
    document.querySelector('#tituloModal').innerHTML='Actualizar Profesor Alumno';
    document.querySelector('#action').innerHTML='Actualizar';

    var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/profesor-alumno/edit-profesor-alumnos.php?idprofesoralumno='+idprofesoralumno;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status ==200){
                var data = JSON.parse(request.responseText);
                if(data.status){
                    document.querySelector('#idprofesoralumno').value = data.data.pa_id;
                    document.querySelector('#listAProfesor').value = data.data.pg_id;
                    document.querySelector('#listAlumno').value = data.data.alumno_id;
                    document.querySelector('#listPeriodo').value = data.data.periodo_id;
                    document.querySelector('#listEstado').value = data.data.estadopa;
                    $('#modalProfesorAlumno').modal('show');
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

function eliminarProfesorAlumno(id){
    var idprofesoralumno = id;
    Swal.fire({
        title: "Eliminar Profesor Alumno",
        text: "Realmente desea eliminar el profesor alumno?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#00695C",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "No, cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
            var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/profesor-alumno/delet-profesor-alumnos.php';
            request.open('POST',url,true);
            var strData="idprofesoralumno="+idprofesoralumno;
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
                        tableProfesorAlumnos.ajax.reload();
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