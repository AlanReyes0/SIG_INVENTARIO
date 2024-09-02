    <div class="modal fade" id="agregarEmpleadoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 titulo_modal">Registrar Remplazo De Equipo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formularioEmpleado" action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Apellido</label>
                            <input type="text" name="apellido" id="apellido" class="form-control" />
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Nomina</label>
                                <input type="number" name="nomina" id="nomina" class="form-control" required />
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Sexo</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sexo" id="sexo_m" value="Masculino" checked>
                                    <label class="form-check-label" for="sexo_m">
                                        Masculino
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sexo" id="sexo_f" value="Femenino">
                                    <label class="form-check-label" for="sexo_f">
                                        Femenino
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="number" name="telefono" id="telefono" class="form-control" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Puesto</label>
                            <input type="text" name="puesto" id="puesto" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Departamento</label>
                            <select name="departamento" class="form-select" required>
                                <option selected value="">Seleccione</option>
                                <?php
                                $departamentos = array(
                                    "Gerencia",
                                    "RH",
                                    "Compras",
                                    "Finanzas",
                                    "Diseño Industrial",
                                    "Produccion",
                                    "Custumor Service",
                                    "Ing. Soldadura",
                                    "Recibos",
                                    "Embarques",
                                    "Sistemas",
                                    "Ingenieria"
                                );
                                foreach ($departamentos as $dep) {
                                    echo "<option value='$dep'>$dep</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3 mt-4">
                            <label class="form-label">Agregar Evidencia</label>
                            <input class="form-control form-control-sm" type="file" name="avatar" accept="image/png, image/jpeg" />
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn_add" onclick="registrarEmpleado(event)">
                                Registrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>