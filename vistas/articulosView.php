<?php

//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["usuario"]))
{
	header("Location: login.html");
}
else
{
	require 'header.php';
	//print_r($_SESSION); 
	if($_SESSION['admin'] == 1 || $_SESSION['normal'] == 1)
	{
?>

		<!--Contenido-->
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">        
			<!-- Main content -->
			<section class="content">
				<div class="row">
					<div class="col-md-12">
						<div class="box">
							<div class="box-header with-border">
								<div class="box-header with-border">
									<h1 id="titulo"></h1>
								</div>
								<!-- GRID -->
								<div class="panel-body table-responsive" id="divListado">
									<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
										<thead>
											<th>Acciones</th>
											<th>Codigo</th>
											<th>Marca</th>
											<th>Modelo</th>
											<th>Descripción</th>
											<th>Precio</th>
											<th>Existencia</th>
										</thead>
										<tbody>                            
										</tbody>
									</table>
									<button class="btn btn-primary" type="submit" id="btnAgregar" onclick="mostrarDivNuevo()"><i class="fa fa-plus-square"></i> - Dar de Alta un Nuevo Articulo</button>
								</div>

								<!-- GUARDAR NUEVO -->
								<div class="panel-body" style="height: auto;" id="divNuevo">
									<form name="formulario" id="formulario" method="POST">
										<div class="panel panel-info col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="panel-heading">Información General</div>
											<div>
												<label>&nbsp;</label>
												<input type="hidden" name="estaActualizando" id="estaActualizando"> </input>
												<input type="hidden" name="articuloId" id="articuloId"> </input>
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label> Marca: *</label>
												<input type="text" class="form-control" name="marca" id="marca" maxlength="256" placeholder="Marca del Articulo" required>
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label> Modelo: *</label>
												<input type="text" class="form-control" name="modelo" id="modelo" maxlength="256" placeholder="Modelo del Articulo" required>
											</div>
											<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<label> Descripción: </label>
												<input type="text" class="form-control" name="descripcion" id="descripcion" maxlength="256" placeholder="Descripción del Articulo">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label> Precio: </label>
												<input type="text" class="form-control" name="precio" id="precio" maxlength="256" placeholder="Precio del Articulo">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label> Cantidad en Existencia: </label>
												<input type="text" class="form-control" name="existencia" id="existencia" maxlength="256" placeholder="Cuantos Productos Hay en Existencia">
											</div>
										</div>

										<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
											<button class="btn btn-danger" id="btnCancelar" onclick="mostrarDivListado()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
										</div>
									</form>
								</div>
							</div><!-- /.box -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</section><!-- /.content -->

			</div><!-- /.content-wrapper -->
			<!--Fin-Contenido-->

<?php
	}
	else
	{
		require 'noAccesoView.php';
	}
	require 'footer.php';
?>

<script type="text/javascript" src="scripts/articulosJS.js"></script>

<?php
} 
ob_end_flush();
?>