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
                        </div>
                        <div class="form-group">
                            <label for="licencia" class="control-label">Licencia</label>
                            <input type="text" class="form-control" id="licencia" required>
                        </div>
                    </div>
                    <div class="footer text-center">
                        <button type="button" class="btn btn-info btn-fill btn-wd">Guardar Chofer</button>
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
                                <th>Apellido</th>
                                <th>RUT</th>
                                <th>Licencia</th>
                                <th class="text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="driverList">
                            <!-- Ejemplo de fila, deberías generar estas filas dinámicamente con JavaScript -->
                            <tr>
                                <td class="text-center">1</td>
                                <td>Juan</td>
                                <td>Pérez</td>
                                <td>12.345.678-9</td>
                                <td>A-1234567</td>
                                <td class="td-actions text-right">
                                    <button type="button" rel="tooltip" title="Activo" class="btn btn-success btn-simple btn-xs">
                                        <i class="fa fa-user"></i>
                                    </button>
                                    <button type="button" rel="tooltip" title="Inactivo" class="btn btn-danger btn-simple btn-xs">
                                        <i class="fa fa-user-times"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>