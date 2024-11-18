$('#tableProfesores').DataTable();
var tableProfesores;

document.addEventListener('DOMContentLoaded',function(){
    tableProfesores =$('#tableProfesores').DataTable({
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "../js/es-ES.json"    
        },
        "ajax":{
            "url": "./models/profesores/table_profesores.php",
            "dataSrc": ""
        },
        "columns":[
            {"data": "acciones"},
            {"data": "profesor_id"},
            {"data": "nombre"},
            {"data": "direccion"},
            {"data": "cedula"},
            {"data": "telefono"},
            {"data": "correo"},
            {"data": "nivel_est"},
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
                "filename": "Lista_Profesores_XLSX",
                "title": "Lista de Profesores",
            },
            {
                "extend":"pdf",
                "text": '<i class="fa-solid fa-file-pdf"></i>',
                "titleAttr": "Exportar a pdf",
                "className": "btn btn-danger",
                "exportOptions": {
                    "columns": ':not(:eq(0))'
                },
                "filename": "Lista_Profesores_PDF",
                "title": "Lista de Profesores",   
                "customize": function (doc) {
                    doc.styles.title = {
                        fontSize: 20,  
                        bold: true,
                        alignment: 'center'
                    };   
                    doc.content[1].table.widths = [ '3%', '19%', '13%', '15%', '13%', '18%', '9%', '10%' ];
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
                    .prepend('<h3>Lista de Profesores</h3>')
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
    var formProfesor = document.querySelector('#formProfesor');
    if (formProfesor) {
        formProfesor.onsubmit =function(e){
            e.preventDefault();
            
            var idprofesor =document.querySelector('#idprofesor').value;
            var nombre = document.querySelector('#nombre').value;
            var direccion = document.querySelector('#direccion').value;
            var cedula = document.querySelector('#cedula').value;
            var clave = document.querySelector('#clave').value;
            var telefono = document.querySelector('#telefono').value;
            var correo = document.querySelector('#correo').value;
            var nivel_est = document.querySelector('#nivel_est').value;
            var estado = document.querySelector('#listEstado').value;
            
            if(nombre == '' || direccion == '' || cedula == '' || telefono == '' || correo == '' || nivel_est == ''){
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

            if (!/^[A-Za-z0-9Ññ]{7,12}$/.test(cedula)) {
                Swal.fire({
                    icon: "error",
                    title: "Atención",
                    text: "El documento debe tener entre 7 y 12 caracteres.",
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

            if (!/^\d{7,15}$/.test(telefono)) {
                Swal.fire({
                    icon: "error",
                    title: "Atención",
                    text: "El teléfono debe tener entre 7 y 15 dígitos.",
                    confirmButtonColor: "#00695C",
                });
                return false;
            }

            var correoRegex = /^[a-zA-Z0-9Ññ._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!correoRegex.test(correo)) {
                Swal.fire({
                    icon: "error",
                    title: "Atención",
                    text: "El correo electrónico no es válido",
                    confirmButtonColor: "#00695C",
                });
                return false;
            }

            

            var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
            var url = 'models/profesores/ajax-profesores.php';
            var form = new FormData(formProfesor);
            request.open('POST',url,true);
            request.send(form);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status ==200){
                    var data = JSON.parse(request.responseText);
                    if(data.status){
                        $('#modalProfesor').modal('hide');
                        formProfesor.reset();
                        Swal.fire({
                            icon: "success",
                            title: "Usuario",
                            text: data.msg,
                            confirmButtonColor: "#00695C",
                        });
                        tableProfesores.ajax.reload();
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

function openModalProfesor(){
    document.querySelector('#idprofesor').value='';
    document.querySelector('#tituloModal').innerHTML='Nuevo Profesor';
    document.querySelector('#action').innerHTML='Guardar';
    document.querySelector('#formProfesor').reset();
    $('#modalProfesor').modal('show');
}

function editarProfesor(id){
    var idprofesor = id;
    document.querySelector('#tituloModal').innerHTML='Actualizar Profesor';
    document.querySelector('#action').innerHTML='Actualizar';

    var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/profesores/edit-profesores.php?idprofesor='+idprofesor;
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
         if(request.readyState == 4 && request.status ==200){
            var data = JSON.parse(request.responseText);
            if(data.status){
                document.querySelector('#idprofesor').value = data.data.profesor_id;
                document.querySelector('#nombre').value = data.data.nombre;
                document.querySelector('#direccion').value = data.data.direccion;
                document.querySelector('#cedula').value = data.data.cedula;
                document.querySelector('#telefono').value = data.data.telefono;
                document.querySelector('#correo').value = data.data.correo;
                document.querySelector('#nivel_est').value = data.data.nivel_est;
                document.querySelector('#listEstado').value = data.data.estado;
                $('#modalProfesor').modal('show');
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

function eliminarProfesor(id){
    var idprofesor = id;
    Swal.fire({
        title: "Eliminar Profesor",
        text: "Realmente desea eliminar el profesor?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#00695C",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "No, cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
            var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/profesores/delet-profesores.php';
            request.open('POST',url,true);
            var strData="idprofesor="+idprofesor;
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
                        tableProfesores.ajax.reload();
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