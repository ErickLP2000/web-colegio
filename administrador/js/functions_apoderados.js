$('#tableApoderados').DataTable();
var tableApoderados;

document.addEventListener('DOMContentLoaded',function(){
    tableApoderados =$('#tableApoderados').DataTable({
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "../js/es-ES.json"    
        },
        "ajax":{
            "url": "./models/apoderados/table_apoderados.php",
            "dataSrc": ""
        },
        "columns":[
            {"data": "acciones"},
            {"data": "apoderado_id"},
            {"data": "nombre_apoderado"},
            {"data": "direccion"},
            {"data": "documento"},
            {"data": "telefono"},
            {"data": "correo"},
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
                "filename": "Lista_Apoderados_XLSX",
                "title": "Lista de Apoderados",
            },
            {
                "extend":"pdf",
                "text": '<i class="fa-solid fa-file-pdf"></i>',
                "titleAttr": "Exportar a pdf",
                "className": "btn btn-danger",
                "exportOptions": {
                    "columns": ':not(:eq(0))'
                },
                "filename": "Lista_Apoderados_PDF",
                "title": "Lista de Apoderados",   
                "customize": function (doc) {
                    doc.styles.title = {
                        fontSize: 20,  
                        bold: true,
                        alignment: 'center'
                    };   
                    doc.content[1].table.widths = [ '3%', '25%', '13%', '15%', '12%', '22%', '10%'];
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
                    .prepend('<h3>Lista de Apoderados</h3>')
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
    var formApoderado = document.querySelector('#formApoderado');
    if (formApoderado) {
        formApoderado.onsubmit =function(e){
            e.preventDefault();
            
            var idapoderado =document.querySelector('#idapoderado').value;
            var nombre = document.querySelector('#nombre').value;
            var direccion = document.querySelector('#direccion').value;
            var documento = document.querySelector('#documento').value;
            var clave = document.querySelector('#clave').value;
            var telefono = document.querySelector('#telefono').value;
            var correo = document.querySelector('#correo').value;
            var estado = document.querySelector('#listEstado').value;
            
            if(nombre == '' || direccion == '' || documento == '' || telefono == '' || correo == ''){
                Swal.fire({
                    icon: "error",
                    title: "Atención",
                    text: "Todos los campos son necesarios",
                    confirmButtonColor: "#00695C",
                });
                return false;
            }

            if (!/^\d+$/.test(telefono)) {
                Swal.fire({
                    icon: "error",
                    title: "Atención",
                    text: "El telefono no es válido",
                    confirmButtonColor: "#00695C",
                });
                return false;
            }

            var correoRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!correoRegex.test(correo)) {
                Swal.fire({
                    icon: "error",
                    title: "Atención",
                    text: "El correo electrónico no es válido",
                    confirmButtonColor: "#00695C",
                });
                return false;
            }

            const telefonoInt = BigInt(telefono);
            const maxBigInt = 9223372036854775807n;
            if (telefonoInt < 0 || telefonoInt > maxBigInt) {
                Swal.fire({
                    icon: "error",
                    title: "Atención",
                    text: "El teléfono supera el máximo permitido",
                    confirmButtonColor: "#00695C",
                });
                return false;
            }

            var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
            var url = 'models/apoderados/ajax-apoderados.php';
            var form = new FormData(formApoderado);
            request.open('POST',url,true);
            request.send(form);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status ==200){
                    var data = JSON.parse(request.responseText);
                    if(data.status){
                        $('#modalApoderado').modal('hide');
                        formApoderado.reset();
                        Swal.fire({
                            icon: "success",
                            title: "Usuario",
                            text: data.msg,
                            confirmButtonColor: "#00695C",
                        });
                        tableApoderados.ajax.reload();
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

function openModalApoderado(){
    document.querySelector('#idapoderado').value='';
    document.querySelector('#tituloModal').innerHTML='Nuevo Apoderado';
    document.querySelector('#action').innerHTML='Guardar';
    document.querySelector('#formApoderado').reset();
    $('#modalApoderado').modal('show');
}

function editarApoderado(id){
    var idapoderado = id;
    document.querySelector('#tituloModal').innerHTML='Actualizar Apoderado';
    document.querySelector('#action').innerHTML='Actualizar';

    var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/apoderados/edit-apoderados.php?idapoderado='+idapoderado;
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
         if(request.readyState == 4 && request.status ==200){
            var data = JSON.parse(request.responseText);
            if(data.status){
                document.querySelector('#idapoderado').value = data.data.apoderado_id;
                document.querySelector('#nombre').value = data.data.nombre_apoderado;
                document.querySelector('#direccion').value = data.data.direccion;
                document.querySelector('#documento').value = data.data.documento;
                document.querySelector('#telefono').value = data.data.telefono;
                document.querySelector('#correo').value = data.data.correo;
                document.querySelector('#listEstado').value = data.data.estado;
                $('#modalApoderado').modal('show');
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

function eliminarApoderado(id){
    var idapoderado = id;
    Swal.fire({
        title: "Eliminar Apoderado",
        text: "Realmente desea eliminar el apoderado?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#00695C",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "No, cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
            var request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/apoderados/delet-apoderados.php';
            request.open('POST',url,true);
            var strData="idapoderado="+idapoderado;
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
                        tableApoderados.ajax.reload();
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