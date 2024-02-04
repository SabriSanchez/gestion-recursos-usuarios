<?php
echo "<div class='container'>
    <div class='row'>
        <h3 class='p-3'>Gestionar Reservas</h3>
        <form method='post' action='enrutador.php'>
        <input type='hidden' name='accion' value='borrar_reserva'>
        <div class='table-responsive'>
            <table class='table table-striped text-center' border='1'>
            <thead class='table-primary'><tr><th>NOMBRE</th><th>RECURSO</th><th>TURNO</th><th>SELECCIONAR</th></tr></thead>";
foreach (obtener_resevas() as $fila) {
    extract($fila);
    echo "<tr>
                <td>$nombre</td>
                <td>$recurso</td>
                <td>$turno</td>
                <td><input type='checkbox' name='reservas[]' value='$reserva'></td>
                </tr>";
}
echo "</table></div></div>
<div class='row'>
            <div class='col'>
                <button type='submit' name='borrar_seleccionado' class='btn btn-primary m-2'>Borrar seleccionado</button>
                <button type='submit' name='borrar_todo' class='btn btn-primary m-2'>Borrar todo</button>
            </div>
        </div>
        </form>
    </div>";
