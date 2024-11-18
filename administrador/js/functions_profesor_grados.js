$('#tableProfesorGrados').DataTable();
var tableProfesorGrados;

document.addEventListener('DOMContentLoaded',function(){
    tableProfesorGrados =$('#tableProfesorGrados').DataTable({
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "../js/es-ES.json"    
        },
        "ajax":{
            "url": "./models/profesor-grado/table_profesor_grados.php",
            "dataSrc": ""
        },
        "columns":[
            {"data": "acciones"},
            {"data": "pg_id"},
            {"data": "nombre"},
            {"data": "nombre_materia"},            
            {"data": "nombre_grado"},
            {"data": "nombre_aula"},
            {"data": "nombre_periodo"},
            {"data": "estadopg"}
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
                "filename": "Lista_Profesor_Grado_XLSX",
                "title": "Lista de Profesor Grado",
            },
            
            {
                "extend":"pdf",
                "text": '<i class="fa-solid fa-file-pdf"></i>',
                "titleAttr": "Exportar a pdf",
                "className": "btn btn-danger",
                "exportOptions": {
                    "columns": ':not(:eq(0))'
                },
                "filename": "Lista_Profesor_Grado_PDF",
                "title": "Lista de Profesor Grado",   
                "customize": function (doc) {
                    doc.styles.title = {
                        fontSize: 20,  
                        bold: true,
                        alignment: 'center'
                    };   
                    doc.content[1].table.widths = ['3%', '32%', '18%', '18%', '8%', '12%', '9%'];
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
                    .prepend('<h3>Lista de Profesor Grado</h3>')
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
    var formProfesorGrado = document.querySelector('#formProfesorGrado');
    if (formProfesorGrado) {
        formProfesorGrado.onsubmit =function(e){
            e.preventDefault();
            
            var idprofesorgrado =document.querySelector('#idprofesorgrado').value;
            var nombre = document.querySelector('#listProfesor').value;
            var materia = document.querySelector('#listMateria').value;
            var grado = document.querySelector('#listGrado').value;
            var aula = document.querySelector('#listAula').value;
            var periodo = document.querySelector('#listPeriodo').value;
            var estado = document.querySelector('#listEstado').value;
            
            if(nombre == '' || materia == '' || grado == '' || aula == '' || periodo == '' || estado == ''){
                Swal.fire({
                    icon: "error",
                    title: "Atención",
                    text: "Todos los campos son necesarios",
                    confirmButtonColor: "#00695C",
                });
                return false;
            }

            var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
            var url = 'models/profesor-grado/ajax-profesor-grados.php';
            var form = new FormData(formProfesorGrado);
            request.open('POST',url,true);
            request.send(form);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status ==200){
                    var data = JSON.parse(request.responseText);
                    if(data.status){
                        $('#modalProfesorGrado').modal('hide');
                        formProfesorGrado.reset();
                        Swal.fire({
                            icon: "success",
                            title: "Usuario",
                            text: data.msg,
                            confirmButtonColor: "#00695C",
                        });
                        tableProfesorGrados.ajax.reload();
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

function openModalProfesorGrado(){
    document.querySelector('#idprofesorgrado').value='';
    document.querySelector('#tituloModal').innerHTML='Nuevo Profesor Grado';
    document.querySelector('#action').innerHTML='Guardar';
    document.querySelector('#formProfesorGrado').reset();
    $('#modalProfesorGrado').modal('show');
}

window.addEventListener('load',function(){
    if(document.querySelector('#listProfesor')){
        showProfesor();
    }
    if(document.querySelector('#listMateria')){
        showMateria();
    }
    if(document.querySelector('#listGrado')){
        showGrado();
    }
    if(document.querySelector('#listAula')){
        showAula();
    }
    if(document.querySelector('#listPeriodo')){
        showPeriodo();
    }
},false);

function showProfesor(){
    var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url = 'models/options/options-profesor.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status ==200){
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor){
                data += '<option value="'+valor.profesor_id+'">'+valor.nombre+'</option>'
            });
            document.querySelector('#listProfesor').innerHTML = data;
        }
    };
}

function showMateria(){
    var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url = 'models/options/options-materia.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status ==200){
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor){
                data += '<option value="'+valor.materia_id+'">'+valor.nombre_materia+'</option>'
            });
            document.querySelector('#listMateria').innerHTML = data;
        }
    };
}

function showGrado(){
    var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url = 'models/options/options-grado.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status ==200){
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor){
                data += '<option value="'+valor.grado_id+'">'+valor.nombre_grado+'</option>'
            });
            document.querySelector('#listGrado').innerHTML = data;
        }
    };
}

function showAula(){
    var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url = 'models/options/options-aula.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status ==200){
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor){
                data += '<option value="'+valor.aula_id+'">'+valor.nombre_aula+'</option>'
            });
            document.querySelector('#listAula').innerHTML = data;
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

function editarProfesorGrado(id){
    var idprofesorgrado = id;
    document.querySelector('#tituloModal').innerHTML='Actualizar Profesor Grado';
    document.querySelector('#action').innerHTML='Actualizar';

    var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/profesor-grado/edit-profesor-grados.php?idprofesorgrado='+idprofesorgrado;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status ==200){
                var data = JSON.parse(request.responseText);
                if(data.status){
                    document.querySelector('#idprofesorgrado').value = data.data.pg_id;
                    document.querySelector('#listProfesor').value = data.data.profesor_id;
                    document.querySelector('#listGrado').value = data.data.grado_id;
                    document.querySelector('#listAula').value = data.data.aula_id;
                    document.querySelector('#listPeriodo').value = data.data.periodo_id;
                    document.querySelector('#listEstado').value = data.data.estadopg;
                    $('#modalProfesorGrado').modal('show');
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

function eliminarProfesorGrado(id){
    var idprofesorgrado = id;
    Swal.fire({
        title: "Eliminar Profesor Grado",
        text: "Realmente desea eliminar el profesor grado?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#00695C",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "No, cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
            var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/profesor-grado/delet-profesor-grados.php';
            request.open('POST',url,true);
            var strData="idprofesorgrado="+idprofesorgrado;
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
                        tableProfesorGrados.ajax.reload();
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