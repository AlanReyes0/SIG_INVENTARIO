<?php include_once "menu.html" ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Notas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="note-has-grid">
            <ul class="nav nav-pills p-3 bg-white mb-3 rounded-pill align-items-center">
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center px-2 px-md-3 mr-0 mr-md-2 active" id="all-category">
                        <i class="bi bi-layers mr-1"></i><span class="d-none d-md-block">Todas las notas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center px-2 px-md-3 mr-0 mr-md-2" id="note-business">
                        <i class="bi bi-briefcase mr-1"></i><span class="d-none d-md-block">Cambios</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center px-2 px-md-3 mr-0 mr-md-2" id="note-social">
                        <i class="bi bi-share mr-1"></i><span class="d-none d-md-block">Reparación</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center px-2 px-md-3 mr-0 mr-md-2" id="note-important">
                        <i class="bi bi-tag mr-1"></i><span class="d-none d-md-block">Importante</span>
                    </a>
                </li>
                <li class="nav-item ml-auto">
                    <a href="javascript:void(0)" class="nav-link btn-info rounded-pill d-flex align-items-center px-3" id="add-notes">
                        <i class="bi bi-plus-lg m-1"></i><span class="d-none d-md-block font-14">Agregar nota</span>
                    </a>
                </li>
            </ul>
            <div class="position-absolute">
                <div id="cargador"></div>
            </div>
            <div id="resultados_ajax"></div>
            <div class="tab-content bg-transparent"></div>
            <form name="guardar_nota" id="guardar_nota" method="post">
                <!-- Modal Añadir notas -->
                <div class="modal fade" id="addnotesmodal" tabindex="-1" role="dialog" aria-labelledby="addnotesmodalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content border-0">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title text-white">Agregar nota</h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="note-box">
                                    <div class="note-content">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <div class="note-title">
                                                    <label>Título</label>
                                                    <input type="text" id="note-has-title" name="note-has-title" class="form-control" minlength="10" placeholder="Título" required />
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="note-description">
                                                    <label>Descripción</label>
                                                    <textarea id="note-has-description" name="note-has-description" class="form-control" minlength="30" placeholder="Descripción" required rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                <button id="btn-n-add" class="btn btn-info" type="submit">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="app.js"></script>
</body>
</html>
