<div class="container">
    <div class="card">
        <div class="header">
            <!--<h4 class="title">Tabs & Icons</h4>
                                <p class="category">Tabs with icons and full width</p>-->
        </div>
        <div class="content content-full-width">
            <ul role="tablist" class="nav nav-tabs">
                <li role="presentation" class="active">
                    <a href="#pendientes" data-toggle="tab"><i class="fa fa-info"></i> Pendientes</a>
                </li>
                <li>
                    <a href="#aceptadas" data-toggle="tab"><i class="fa fa-check"></i> Aceptadas</a>
                </li>
                <li>
                    <a href="#rechazadas" data-toggle="tab"><i class="fa fa-times"></i> Rechazadas</a>
                </li>
                <li>
                    <a href="#calendario" data-toggle="tab"><i class="fa fa-calendar"></i> Calendario</a>
                </li>
            </ul>

            <div class="tab-content">
                <div id="pendientes" class="tab-pane active">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>SOLICITANTE</th>
                                <th>FECHA</th>
                                <th>DESTINO</th>
                                <th>MOTIVO</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($solicitudes as $val) :
                                if ($val['IND_ESTADO'] == 1) : ?>
                                    <tr>
                                        <td><?php echo $val['IDCORREL']; ?></td>
                                        <td> <?php echo "Nombre: " . $val['NOMBRE']; ?></td>
                                        <td><?php echo $val['FECHA']; ?></td>
                                        <td><?php echo $val['DESTINO']; ?></td>
                                        <td><?php echo $val['MOTIVO']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-warning" onclick="confirm_movil(<?php echo $val['IDCORREL']; ?>, '<?php echo $val['FECHA']; ?>', '<?php echo $val['NOMBRE']; ?>','<?php echo $val['DESTINO']; ?>')">Confirmar</button>
                                            <button type="button" class="btn btn-danger" onclick="rejectmovil(<?php echo $val['IDCORREL']; ?>)">Rechazar</button>
                                        </td>
                                    </tr>
                            <?php endif;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div id="aceptadas" class="tab-pane">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>SOLICITANTE</th>
                                <th>FECHA</th>
                                <th>DESTINO</th>
                                <th>MOTIVO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($solicitudes as $val) :
                                if ($val['IND_ESTADO'] == 2) : ?>
                                    <tr>
                                        <td><?php echo $val['IDCORREL']; ?></td>
                                        <td> <?php echo "Nombre: " . $val['NOMBRE']; ?></td>
                                        <td><?php echo $val['FECHA']; ?></td>
                                        <td><?php echo $val['DESTINO']; ?></td>
                                        <td><?php echo $val['MOTIVO']; ?></td>
                                    </tr>
                            <?php endif;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div id="rechazadas" class="tab-pane">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>SOLICITANTE</th>
                                <th>FECHA</th>
                                <th>DESTINO</th>
                                <th>MOTIVO</th>
                                <th>OBSERVACION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($solicitudes as $val) :
                                if ($val['IND_ESTADO'] == 3) : ?>
                                    <tr>
                                        <td><?php echo $val['IDCORREL']; ?></td>
                                        <td> <?php echo "Nombre: " . $val['NOMBRE']; ?></td>
                                        <td><?php echo $val['FECHA']; ?></td>
                                        <td><?php echo $val['DESTINO']; ?></td>
                                        <td><?php echo $val['MOTIVO']; ?></td>
                                        <td><?php echo $val['OBSERVACIONES']; ?></td>
                                    </tr>
                            <?php endif;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div id="calendario" class="tab-pane">
                    <div class="container mt-4">
                        <div class="form-group">
                            <label for="fecha">Selecciona la fecha:</label>
                            <input type="date" id="fecha" class="form-control">
                            <button class="btn btn-primary mt-2" onclick="loadTable()">Buscar</button>
                        </div>
                        <div id="resultado">
                            <!-- La tabla se cargará aquí -->
                        </div>
                    </div>
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
                    <input type="hidden" id="solicitanteid" name="solicitanteid">
                    <input type="hidden" id="fecha" name="fecha">
                    <input type="hidden" id="destino" name="destino">
                    <input type="hidden" id="nombre" name="nombre">
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