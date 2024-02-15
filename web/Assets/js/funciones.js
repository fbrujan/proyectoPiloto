let tblUsuarios, tblSuscriptores, tblTrafico;

document.addEventListener("DOMContentLoaded",function(){
    tblUsuarios =  $('#tblUsuarios').DataTable( {
            ajax: {
                url: base_url + 'usuarios/listar',
                dataSrc: ''
            },
            columns: [
                 {'data' : 'id'}
                ,{'data' : 'usuario' }
                ,{'data' : 'nombre'}
                ,{'data' : 'estado' } 
                ,{'data' : 'acciones' } 
            
            ]
    } );
    // Fin tblUsuarios

});


//////

function btnBuscarSuscriptor(e) {    
    e.preventDefault();
    const suscriptor       = document.getElementById('suscriptor');    

    if (suscriptor.value == "" || suscriptor.value.length < 5 ) {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Debe proveer al menos 5 dígitos del número',
            showConfirmButton: false,
            timer: 3000
        })
    }else{
        const subsc = suscriptor.value;
        //console.log(subsc);
        
        tblSuscriptores =  $('#tblSuscriptores').DataTable( {
            destroy: true,
            ajax: {
                url: base_url + 'suscriptores/listar/' + subsc,
                dataSrc: ''
            },
            columns: [
                {'data' : 'nro_telefonico'}
                ,{'data' : 'operadora'}
                ,{'data' : 'tipo_documento' } 
                ,{'data' : 'nro_documento' }
                ,{'data' : 'nombre' }
                ,{'data' : 'acciones' } 
            
            ]
        } );
    
    // Fin tblSuscriptores
    }
}
//////

function frmUsuario() {
    document.getElementById("usuarioModal").innerHTML = "Nuevo Usuario";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById('claves').classList.remove("d-none");
    document.getElementById('frmUsuario').reset(); // con el reset evito tener que limpiar cada campo del formulario uno por uno
    document.getElementById('id_usuario').value = ""; // pero los elementos hidden no son afectados por el reset y hay que hacerlo individualmente
    $("#nuevo_usuario").modal("show");
}
function registrarUsuario(e) {
    e.preventDefault();
    const usuario       = document.getElementById('usuario');
    const nombre        = document.getElementById('nombre');
    if (usuario.value == "" || nombre.value == "" ) {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Debe llenar todos los campos',
            showConfirmButton: false,
            timer: 3000
        })
    }else{
        const url = base_url + 'usuarios/registrar';
        const frm = document.getElementById('frmUsuario');
        const http = new XMLHttpRequest();
        http.open("POST",url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function (){
            //console.log(this.status);
            if(this.readyState == 4 && this.status == 200){
                //console.log(this.responseText);
                const res = JSON.parse(this.responseText);

                if (res == "OK") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Usuario Registrado con éxito',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    frm.reset();
                    $("#nuevo_usuario").modal("hide");
                    tblUsuarios.ajax.reload();
                }else if (res == "Actualizado") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Usuario Modificado con éxito',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    $("#nuevo_usuario").modal("hide");
                    tblUsuarios.ajax.reload();
                }else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                    })
                }

                
            }
        }
    }
}
function btnEditarUsuario(id) {
    document.getElementById("usuarioModal").innerHTML = "Actualizar Usuario";
    document.getElementById("btnAccion").innerHTML = "Actualizar";
    const url = base_url + 'usuarios/editar/' + id;
    const http = new XMLHttpRequest();
    http.open("GET",url, true);
    http.send();
    http.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
           // console.log(this.responseText);
            const res = JSON.parse(this.responseText);  
            const id_usuario = res.id;

            document.getElementById('nombre').value = res.nombre;
            document.getElementById('usuario').value = res.usuario;
            document.getElementById('id_usuario').value =res.id;
            document.getElementById('claves').classList.add("d-none");
            $("#nuevo_usuario").modal("show");
                  
        }
    }
}
function btnEliminarUsuario(id) {
    Swal.fire({ // alerta de sweetalert2
        title: 'Está seguro de eliminar?',
        text: "El usuario no se eliminará de forma permanente, sólo cambiará su estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Proceder!',
        cancelButtonText: 'No, Abortar!'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + 'usuarios/eliminar/' + id;
            const http = new XMLHttpRequest();
            http.open("GET",url, true);
            http.send();
            http.onreadystatechange = function (){
                if(this.readyState == 4 && this.status == 200){
                  //  console.log(this.responseText);                 
                    res = JSON.parse(this.responseText);

                    if (res == "OK") {
                        Swal.fire(
                            'Mensaje!',
                            'El usuario ha sido eliminado.',
                            'success'
                        )
                        tblUsuarios.ajax.reload();
                    } else {
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'error'
                        )
                    }
                }
            }
            
        }
      })
}
function btnReingresarUsuario(id) {
    Swal.fire({ // alerta de sweetalert2
        title: 'Está seguro de Habilitar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Proceder!',
        cancelButtonText: 'No, Abortar!'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + 'usuarios/reingresar/' + id;
            const http = new XMLHttpRequest();
            http.open("GET",url, true);
            http.send();
            http.onreadystatechange = function (){
                if(this.readyState == 4 && this.status == 200){
                    //console.log(this.responseText);                 
                    res = JSON.parse(this.responseText);

                    if (res == "OK") {
                        Swal.fire(
                            'Mensaje!',
                            'El usuario ha sido habilitado.',
                            'success'
                        )
                        tblUsuarios.ajax.reload();
                    } else {
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'error'
                        )
                    }
                }
            }
            
        }
    })
}
// Fin Usuarios

//////

function btnBuscarTrafico(e) {    
    e.preventDefault();
    const suscriptor       = document.getElementById('telefono');
    const fechaIni       = document.getElementById('fechaInicio');
    const fechaFin       = document.getElementById('fechaFin');    

    if (suscriptor.value == "" || suscriptor.value.length < 5 ) {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Debe proveer al menos 5 dígitos del número',
            showConfirmButton: false,
            timer: 3000
        })
    }else{
        const subsc = suscriptor.value;
        //console.log(subsc);
        
        tblTrafico =  $('#tblTrafico').DataTable( {
            destroy: true,
            ajax: {
                url: base_url + 'trafico/listar/' + subsc,
                dataSrc: ''
            },
            columns: [
                {'data' : 'fecha'}
                ,{'data' : 'hora'}
                ,{'data' : 'telefono_a' } 
                ,{'data' : 'telefono_b' }
                ,{'data' : 'cellsite_origen' }
                ,{'data' : 'cellsite_destino' }
                ,{'data' : 'duracion' }
                ,{'data' : 'operadora' }
                ,{'data' : 'acciones' } 
            
            ]
        } );
    
    // Fin tblTrafico
    }
}
//////

