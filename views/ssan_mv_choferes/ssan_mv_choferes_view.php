<div class="container mt-5">
    <div class="row">
        <!-- Columna del formulario -->
        <div class="col-md-6">
            <div class="card">
                <form id="driverForm">
                    <div class="header text-center">
                        <h4 class="title">Agregar/Editar Chofer</h4>
                    </div>
                    <div class="content">
                        <div class="form-group">
                            <label for="nombre" class="control-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido" class="control-label">Apellido</label>
                            <input type="text" class="form-control" id="apellido" required>
                        </div>
                        <div class="form-group">
                            <label for="rut" class="control-label">RUT</label>
                            <input type="text" class="form-control" id="rut" required>
                            <div id="error_rut"></div>
                        </div>
                    </div>
                    <div class="footer text-center">
                        <button type="button" class="btn btn-info btn-fill btn-wd" id="save_chofer">Guardar Datos</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Columna de la tabla -->
        <div class="col-md-6">
            <div class="card">
                <div class="header">
                    <h4 class="title">Lista de Choferes</h4>
                    <p class="category">Registro de choferes en el sistema</p>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nombre</th>
                                <th>RUT</th>
                                <th>PATENTE VEHICULO ASIGNADO</th>
                                <th class="text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="driverList">
                            <?php
                            if ($choferes) {
                                foreach ($choferes as $val) {
                            ?>
                                    <tr>
                                        <td class="text-center"><?php echo $val['IDCORREL'] ?></td>
                                        <td><?php echo $val['NOMBRE'] ?></td>
                                        <td><?php echo $val['RUT'] ?></td>
                                        <td><?php echo $val['PATENTE_VEHICULO'] ?></td>
                                        <td class="td-actions text-right">
                                            <?php
                                            if ($val['IND_ESTADO'] == 1) {
                                            ?>
                                                <button type="button" onclick="out_chofer(<?php echo $val['IDCORREL']; ?>);" title="Disponible" class="btn btn-success btn-simple btn-xs">
                                                    <i class="fa fa-user"></i>
                                                </button>
                                                <button type="button" title="Asignar vehículo" class="btn btn-info btn-simple btn-xs" onclick="showAsignarVehiculoModal(<?php echo $val['IDCORREL']; ?>);">
                                                    <i class="fa fa-car"></i>
                                                </button>
                                            <?php
                                            } else {
                                            ?>
                                                <button type="button" onclick="in_chofer(<?php echo $val['IDCORREL']; ?>);" title="No disponible" class="btn btn-warning btn-simple btn-xs">
                                                    <i class="fa fa-user-times"></i>
                                                </button>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="asignarVehiculoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Asignar Vehículo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="asignarVehiculoForm">
                    <input type="hidden" id="choferId" name="choferId">
                    <div class="form-group">
                        <label for="patenteVehiculo">Patente del Vehículo</label>
                        <select class="form-control" id="patenteVehiculo" name="patenteVehiculo">
                            <?php
                            if ($vehiculos) {
                                foreach ($vehiculos as $val) {
                            ?>
                                    <option value="<?php echo $val['PATENTE']; ?>"><?php echo $val['PATENTE']; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="asignarVehiculo()">Guardar</button>
            </div>
        </div>
    </div>
</div>