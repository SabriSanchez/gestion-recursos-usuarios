<?php

echo "<div class='container'><div class='row'><h3 class='p-3'>Gestionar Recursos</h3>
<form method='post' action='enrutador.php'>
<input type='hidden' name='accion' value='gestionar_recursos'>
<div class='table-responsive'><table class='table table-striped text-center' border='1'>
<thead class='table-primary'><tr><th>NOMBRE</th><th>SELECCIONAR</th></tr></thead>";
foreach (obtener_recursos() as $fila) {
    extract($fila);
    echo "<tr>
        <td>$nombre</td>
        <td><input type='radio' name='recurso' value='$id_recurso'></td>
    </tr>";
}
echo "</table></div></div>
<div class='row'>
    <div class='col'><button type='submit' name='borrar' class='btn btn-primary m-2'>Borrar</button></div>
    <div class='row text-danger'><p class='fst-italic'>Advertencia: Borrar un recurso con reserva borrará también las reservas que tenga<p></div>
</div>
<div class='row p-2'>
    <h3 class='p-2'>Crear o modificar recurso</h3>
        <div class='row'>
            <div class='col'>
                <div class='input-group mb-3 has-validation'>
                    <span class='input-group-text' id='nuevo_nombre'>Nombre</span>
                    <input type='text' class='form-control' name='nuevo_nombre' required>
                    <div class='invalid-feedback'>
	  		            Se requiere completar el nombre del recurso
		            </div>
                </div>
            </div>    
        </div>
        <div class='row'>
            <div class='col'>
                <button type='submit' name='modificar' class='btn btn-primary m-2'>Modificar recurso seleccionado</button>
                <button type='submit' name='alta' class='btn btn-primary m-2'>Nuevo recurso</button>
            </div>
        </div>
</div>
</form></div>";
