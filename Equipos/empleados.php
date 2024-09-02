<div class="table-responsive">
    <table class="table table-hover" id="table_empleados">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Nomina</th>
                <th scope="col">Fecha</th>
                <th scope="col">Marca</th>
                <th scope="col">Numero De Serie</th>
                <th scope="col">Puesto</th>
                <th scope="col">Departamento</th>
                <th scope="col">Imagen</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
             foreach ($empleados as $empleado) { ?>
                <tr id="empleado_<?php echo $empleado['id']; ?>">
                    <th scope='row'><?php echo $empleado['id']; ?></th>
                    <td><?php echo $empleado['nombre']; ?></td>
                    <td> <?php echo $empleado['apellido']; ?></td>
                    <td> <?php echo $empleado['nomina']; ?></td>
                    <td> <?php echo $empleado['fecha']; ?></td>
                    <td> <?php echo $empleado['marca']; ?></td>
                    <td> <?php echo $empleado['numeroserie']; ?></td>
                    <td> <?php echo $empleado['puesto']; ?></td>
                    <td> <?php echo $empleado['departamento']; ?></td>

                    <td>
                        <?php
                        $avatar = $empleado['avatar'];
                        if ($avatar == '') {
                            $avatar = 'assets/imgs/sin-foto.jpg';
                        } else {
                            $avatar = "acciones/fotos_empleados/" . $avatar;
                        }
                        ?>
                        <img class="rounded-circle" src="<?php echo $avatar; ?>" alt="<?php echo $empleado['nombre']; ?>" width="50" height="50">
                    </td>
                    <td>
                        <a title="Ver detalles del empleado" href="#" onclick="verDetallesEmpleado(<?php echo $empleado['id']; ?>)" class="btn btn-success">
                            <i class="bi bi-binoculars"></i>
                        </a>
                        <a title="Editar datos del empleado" href="#" onclick="editarEmpleado(<?php echo $empleado['id']; ?>)" class="btn btn-warning">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a title="Eliminar datos del empleado" href="#" onclick="eliminarEmpleado(<?php echo $empleado['id']; ?>, '<?php echo $empleado['avatar']; ?>')" class="btn btn-danger">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>