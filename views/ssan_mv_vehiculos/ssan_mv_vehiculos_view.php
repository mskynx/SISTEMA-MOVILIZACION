<div class="container mt-8">
    <h1 class="mb-4">Mantenedor de Vehículos</h1>

    <div class="row">
        <!-- Columna del formulario -->
        <div class="col-md-6">
            <div class="card">
                <form id="vehicleForm">
                    <div class="header text-center">Agregar/Editar Vehículo</div>
                    <div class="content">
                        <div class="form-group">
                            <label for="marca" class="control-label">Marca</label>
                            <input type="text" class="form-control" id="marca" required>
                        </div>
                        <div class="form-group">
                            <label for="modelo" class="control-label">Modelo</label>
                            <input type="text" class="form-control" id="modelo" required>
                        </div>
                        <div class="form-group">
                            <label for="anio" class="control-label">Año</label>
                            <input type="number" class="form-control" id="anio" required>
                        </div>
                        <div class="form-group">
                            <label for="cant_asientos" class="control-label">Cantidad Asientos</label>
                            <input type="number" class="form-control" id="cant_asientos" required>
                        </div>
                        <div class="form-group">
                            <label for="patente" class="control-label">Patente</label>
                            <input type="text" class="form-control" id="patente" required>
                        </div>
                    </div>
                    <div class="footer text-center">
                        <button type="button" id="save_vehiculo" class="btn btn-info btn-fill btn-wd">Guardar Vehículo</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Columna de la tabla -->
        <div class="col-md-6">
            <div class="card">
                <div class="header">
                    <h4 class="title">Lista de Vehículos</h4>
                    <p class="category">Registro de vehículos en el sistema</p>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Año</th>
                                <th>Patente</th>
                                <th>Cantidad Asientos</th>
                                <th class="text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="vehicleList">
                            <?php
                            if ($vehiculos) {
                                foreach ($vehiculos as $val) {
                            ?>
                                    <tr>
                                        <td class="text-center"><?php echo $val['IDCORREL'] ?></td>
                                        <td><?php echo $val['MARCA'] ?></td>
                                        <td><?php echo $val['MODELO'] ?></td>
                                        <td><?php echo $val['ANIO'] ?></td>
                                        <td><?php echo $val['PATENTE'] ?></td>
                                        <td><?php echo $val['CANT_ASIENTOS'] ?></td>
                                        <td class="td-actions text-right">
                                            <?php
                                            if ($val['IND_ESTADO'] == 1) {
                                            ?>
                                                <button type="button" onclick="out_vehiculo(<?php echo $val['IDCORREL']; ?>);" title="Operativo" class="btn btn-success btn-simple btn-xs">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                            <?php
                                            } else {
                                            ?>
                                                <button type="button" onclick="in_vehiculo(<?php echo $val['IDCORREL']; ?>);" title="En taller" class="btn btn-warning btn-simple btn-xs">
                                                    <i class="fa fa-wrench"></i>
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