<div class="table-responsive">
    <table class="table table-hover" id="table_empleados">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Nomina</th>
                <th scope="col">Fecha</th>
                <th scope="col">Estado</th>
                <th scope="col">Tipo De Equipo</th>
                <th scope="col">Cargo</th>
                <th scope="col">CheckList</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($empleados as $empleado) { ?>
                <tr id="empleado_<?php echo $empleado['id']; ?>">
                    <th scope='row'><?php echo $empleado['id']; ?></th>
                    <td><?php echo $empleado['nombre']; ?></td>
                    <td><?php echo $empleado['apellido']; ?></td>
                    <td><?php echo $empleado['nomina']; ?></td>
                    <td><?php echo $empleado['fecha']; ?></td>
                    <td><?php echo $empleado['estado']; ?></td>
                    <td><?php echo $empleado['equipo']; ?></td>
                    <td><?php echo $empleado['cargo']; ?></td>
                    <td><?php echo $empleado['checklist']; ?></td>

                    <td>
                        <a title="Ver detalles del empleado" href="#" onclick="verDetallesEmpleado(<?php echo $empleado['id']; ?>)" class="btn btn-success">
                            <i class="bi bi-binoculars"></i>
                        </a>
                        <a title="Editar datos del empleado" href="#" onclick="editarEmpleado(<?php echo $empleado['id']; ?>)" class="btn btn-warning">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a title="Eliminar datos del empleado" href="#" onclick="eliminarEmpleado(<?php echo $empleado['id']; ?>)" class="btn btn-danger">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>