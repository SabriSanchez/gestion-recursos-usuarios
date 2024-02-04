<?php
echo "<div class='container'><h3 class='p-2'>Crear Reserva</h3>
	<form method='post' action='enrutador.php'>
	<input type='hidden' name='accion' value='crear_reserva'>
	<div class='input-group mb-3'>
	<label for='pista' class='input-group-text'>Seleccionar recurso</label>
    <select name='recurso' id='recurso' class='form-select'>";
foreach (obtener_recursos() as $fila) {
	extract($fila);
	echo "<option value='$id_recurso'>$nombre</option>";
}
echo "</select></div>
	<div class='input-group mb-3 has-validation'>
		<span class='input-group-text' id='turno'>Indicar Turno</span>
  		<input type='int' class='form-control' name='turno' required>
		<div class='invalid-feedback'>
	  		Se requiere completar el turno
		</div>
	</div>
	<button type='submit' name='submit' class='btn btn-primary'>Crear</button></form></div>";
