    <div class="modal fade" id="editarEmpleadoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 titulo_modal">Actualizar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formularioEmpleadoEdit" onsubmit="actualizarEmpleado(event)" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <input type="hidden" name="id" id="idempleado" />
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Apellido</label>
                            <input type="text" name="apellido" id="apellido" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomina</label>
                            <input type="number" name="nomina" id="nomina" class="form-control" require>
                            </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Fecha</label>
                                <input type="date" id="fecha" name="fecha" required><br>
                                </div>
                    <div class="mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Seleccione estado</label>
                            <select class="form-select" name="estado" id="estado" required>
                                <option selected value="">Seleccione</option>
                                <?php
                                $estado = array(
                                    "Nuevo",
                                    "Usado - Como Nuevo",
                                    "Usado- Buen Estado",
                                    "Usado - Aceptable",
                                    "Usado - Mal Estado"
                                );
                                foreach ($estado as $estados) {
                                    echo "<option value='$estados'>$estados</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipo De Equipo</label>
                        <input type="text" name="equipo" id="equipo" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Seleccione el Cargo</label>
                        <select class="form-select" name="cargo" id="cargo" required>
                            <option selected value="">Seleccione</option>
                            <?php
                            $cargos = array(
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
                            foreach ($cargos as $cargo) {
                                echo "<option value='$cargo'>$cargo</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Check List </label>
                            <input type="checkbox" name="checklist[]" id="checklist"   value="Inspección Física del Equipo"> Inspección Física del Equipo<br>
                            <input type="checkbox" name="checklist[]" id="checklist"  value="Limpieza Interna"> Limpieza Interna<br>
                            <input type="checkbox" name="checklist[]" id="checklist"  value="Chequeo de Conexiones"> Chequeo de Conexiones<br>
                            <input type="checkbox" name="checklist[]" id="checklist"  value="Actualización de Firmware y Drivers"> Actualización de Firmware y Drivers<br>
                            <input type="checkbox" name="checklist[]" id="checklist"  value="Verificación de Seguridad Física"> Verificación de Seguridad Física<br>
                            <input type="checkbox" name="checklist[]" id="checklist"  value="Actualización de Software"> Actualización de Software<br>
                            <input type="checkbox" name="checklist[]" id="checklist"  value="Limpieza de Archivos Temporales y Cache"> Limpieza de Archivos Temporales y Cache<br>
                            <input type="checkbox" name="checklist[]" id="checklist"  value="Optimización del Rendimiento"> Optimización del Rendimiento<br>
                            <input type="checkbox" name="checklist[]" id="checklist"  value="Revisión de Licencias y Cumplimiento"> Revisión de Licencias y Cumplimiento<br>
                            <input type="checkbox" name="checklist[]" id="checklist"  value="Verificación de Copias de Seguridad"> Verificación de Copias de Seguridad<br>
                        </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn_add">
                                        Actualizar datos
                                    </button>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>