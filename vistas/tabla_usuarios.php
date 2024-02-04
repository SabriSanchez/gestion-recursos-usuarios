<?php
echo "<div class='container'><div class='row'><h3 class='p-3'>Eliminar Usuarios</h3>
<form method='post' action='enrutador.php'>
<input type='hidden' name='accion' value='gestionar_usuarios'>
<div class='table-responsive'><table class='table table-striped text-center' border='1'>
<thead class='table-primary'><tr><th>NOMBRE</th><th>TIPO</th><th>SELECCIONAR</th></tr></thead>";
foreach (obtener_usuarios() as $fila) {
    extract($fila);
    echo "<tr>
        <td>$nombre</td>
        <td>";
    if ($tipo == 0) {
        echo "Administrador";
    } else if ($tipo == 1) {
        echo "Usuario";
    }
    echo "</td>
        <td><input type='radio' name='usuario' value='$id_usuario'></td>
    </tr>";
}
echo "</table></div></div>
<div class='row'><div class='col'><button type='submit' name='borrar' class='btn btn-primary m-2'>Borrar</button></div>
<div class='row text-danger'><p class='fst-italic'>Advertencia: Borrar un usuario con reservar borrará también las reservas que tenga</p></div></div>
<div class='row'><div class='col'><h3 class='p-2'>Crear o modificar usuarios</h3></div>
<div class='row'>
    <div class='col'>
        <div class='input-group mb-3 has-validation'>
            <span class='input-group-text' id='nuevo_nombre'>Nombre</span>
            <input type='text' class='form-control' name='nuevo_nombre' required>
            <div class='invalid-feedback'>
	  		    Se requiere completar el nombre de usuario
		    </div>
        </div>
    </div>    
</div>
<div class='row'>
    <div class='col'>
        <div class='input-group mb-3 has-validation'>
            <span class='input-group-text' id='nuevo_pass'>Contraseña</span>
            <input type='text' class='form-control' name='nueva_contrasena' required>
            <div class='invalid-feedback'>
	  		    Se requiere completar la contraseña
		    </div>
        </div>
    </div>    
</div>
<div class='row'>
    <div class='col'>
        <div class='input-group mb-3'>
            <label for='nuevo_tipo' class='input-group-text'>Tipo</label>
            <select name='nuevo_tipo' id='nuevo_tipo' class='form-select'>
                <option value='1'>Usuario</option>
                <option value='0'>Administrador</option>
            </select>
        </div>
    </div>
</div>
</div>
<div class='row'>
            <div class='col'>
                <button type='submit' name='modificar' class='btn btn-primary m-2'>Modificar usuario seleccionado</button>
                <button type='submit' name='alta' class='btn btn-primary m-2'>Nueva alta</button>
            </div>
</div>
</form></div>";
