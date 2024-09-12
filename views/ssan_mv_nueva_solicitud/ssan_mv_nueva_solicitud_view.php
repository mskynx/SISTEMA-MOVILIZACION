<div class="container">
    <div class="form-group">
        <label for="fecha">Fecha de salida: </label>
        <input type="date" name="fecha" id="fecha" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="hora">Hora de salida:</label>
        <input type="text" name="hora" id="hora" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="comienzo">Lugar de salida:</label>
        <input type="text" name="comienzo" id="comienzo" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="destino">Destino: </label>
        <input type="text" name="destino" id="destino" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="motivo">Motivo: </label>
        <input type="text" name="motivo" id="motivo" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="nombre">Nombre solicitante: </label>
        <input type="text" name="nombre" id="nombre" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="correo">Correo: </label>
        <input type="text" name="correo" id="correo" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="n_personas">Cantidad de personas que viajan: </label>
        <input type="text" name="n_personas" id="n_personas" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="nombres">Nombres personas que viajan: </label>
        <textarea name="nombres" id="nombres" class="form-control" rows="4" placeholder="ingrese los nombres separados por coma (,)"></textarea>
    </div>

    <button type="button" class="btn btn-primary" id="send_solicitud">Solicitar Movil</button>
</div>