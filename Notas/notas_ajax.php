<?php

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
		include("conexion.php");
		$sTable = "notas";
		$sWhere = " order by id desc";
		
		if (isset($_REQUEST['delete'])){
			$id_nota=intval($_REQUEST['delete']);
			$delete=mysqli_query($link,"delete from $sTable where id='$id_nota'");
		}
		
		if (isset($_REQUEST['actualizar'])){
			$id_nota=intval($_REQUEST['actualizar']);
			$value=intval($_REQUEST['value']);
			if ($value==1){
				$cat='business';
			} else if ($value==2){
				$cat='social';
			} else if ($value==3){
				$cat='important';
			} else {
				$cat='';
			}
			$update=mysqli_query($link,"update $sTable set categoria='$cat' where id='$id_nota'");
		}
		
		$sql="SELECT * FROM  $sTable $sWhere ";
		$query = mysqli_query($link, $sql);
		$num=mysqli_num_rows($query);
		if ($num>0){
			?>
		 <div id="note-full-container" class="note-has-grid row">	
			<?php
			while($row=mysqli_fetch_array($query)){
					?>
			 <div class="col-md-4 single-note-item all-category note-<?=$row['categoria'];?> " style="">
                <div class="card card-body ">
                    <span class="side-stick"></span>
                    <h5 class="note-title text-truncate w-80 mb-0" data-noteheading="<?=$row['titulo'];?>"><?=$row['titulo'];?> <i class="point fa fa-circle ml-1 font-10"></i></h5>
                    <p class="note-date font-12 text-muted"><?=date('d/m/Y',strtotime($row['fecha']));?></p>
                    <div class="note-content">
                        <p class="note-inner-content text-muted" data-notecontent="<?=$row['descripcion'];?>"><?=$row['descripcion'];?></p>
                    </div>
                    <div class="d-flex align-items-center">
                      
                       <a href="#" onclick="eliminar_nota('<?=$row['id'];?>')"> <span class="mr-1"><i class="fa fa-trash text-danger"></i></span></a>
                        <div class="ml-auto">
                            <div class="category-selector btn-group">
                                <a class="nav-link dropdown-toggle category-dropdown label-group p-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                                    <div class="category">
                                        <div class="category-business"></div>
                                        <div class="category-social"></div>
                                        <div class="category-important"></div>
                                        <span class="more-options text-dark"><i class="icon-options-vertical"></i></span>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right category-menu">
                                    <a class="note-business badge-group-item badge-business dropdown-item position-relative category-business text-success" href="javascript:void(0);" onclick="actualizar_categoria('<?=$row['id'];?>','1');">
                                        <i class="mdi mdi-checkbox-blank-circle-outline mr-1" ></i>Cambios
                                    </a>
                                    <a class="note-social badge-group-item badge-social dropdown-item position-relative category-social text-info" href="javascript:void(0);" onclick="actualizar_categoria('<?=$row['id'];?>','2');">
                                        <i class="mdi mdi-checkbox-blank-circle-outline mr-1" ></i> Reparaciones
                                    </a>
                                    <a class="note-important badge-group-item badge-important dropdown-item position-relative category-important text-danger" href="javascript:void(0);" onclick="actualizar_categoria('<?=$row['id'];?>','3');">
                                        <i class="mdi mdi-checkbox-blank-circle-outline mr-1" ></i> Importante
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>		
					<?php
			}
		?>
		</div>
		<?php	
			
		}
		
	}
?>       