<?php include "Views/Templates/header.php";?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Trafico</li>
</ol>
<form method="post" id="frmBuscaTrafico">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="telefono">Telefono</label>
                <input id="telefono" class="form-control" type="text" name="telefono" placeholder="Telefono">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
            <label for="fechaInicio">Fecha Inicio</label>
                <input id="fechaInicio" class="form-control" type="date" name="fechaInicio">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
            <label for="fechaFin">Fecha Fin</label>
                <input id="fechaFin" class="form-control" type="date" name="fechaFin">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <button class="btn btn-primary" type="button" onclick="btnBuscarTrafico(event);" id="btnBuscar">Buscar</button>
            </div>
        </div>
    </div>
</form>
<table class="table table-light" id="tblTrafico" name="tblTrafico">
    <thead class="thead-dark">
        <tr>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Originador</th>
            <th>Terminador</th>
            <th>Celda Origen</th>
            <th>Celda Destino</th>
            <th>Duración</th>
            <th>Operadora</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<!-- Inicio del Modal -->
<div id="nuevo_Suscriptor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="SuscriptorModal">Nuevo Suscriptor</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <form method="post" id="frmSuscriptor">       

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre del Suscriptor">
                </div>

                <div class="row" id="claves">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="clave">Contraseña</label>
                            <input id="clave" class="form-control" type="password" name="clave" placeholder="Contraseña">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="confirmar">Confirmar Contraseña</label>
                            <input id="confirmar" class="form-control" type="password" name="confirmar" placeholder="Confirmar Contraseña">
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary" type="button" onclick="registrarSuscriptor(event);" id="btnAccion">Registrar</button>
                <button class="btn btn-danger" type="button"  data-dismiss="modal">Cancelar</button>
               </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->


<?php include "Views/Templates/footer.php";?>