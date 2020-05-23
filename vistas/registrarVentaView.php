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
	if($_SESSION['admin'] == 1 || $_SESSION['normal'] == 1)
	{
?>

		<div class="content-wrapper">        
			<section class="content">
				<div class="row">
					<div class="col-md-12">
						<div class="box">
							<div class="box-header with-border">

								<!-- GUARDAR NUEVO -->
								<div class="panel-body" style="height: auto;" id="divNuevo">
									<form name="formulario" id="formulario" method="POST">
										<div class="panel panel-info col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="panel-heading">Registrar una Venta</div>
											<div>
												<label>&nbsp;</label>
												<input type="hidden" name="descripcionHidden" id="descripcionHidden"> </input>
												<input type="hidden" name="marcaHidden" id="marcaHidden"> </input>
												<input type="hidden" name="modeloHidden" id="modeloHidden"> </input>
												<input type="hidden" name="cantidadHidden" id="cantidadHidden"> </input>
												<input type="hidden" name="precioHidden" id="precioHidden"> </input>
												<input type="hidden" name="existenciaHidden" id="existenciaHidden"> </input>
											</div>
											<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
												<label> Cliente: </label>
												<select name="cliente" id="cliente" class="form-control selectpicker" data-live-search="true">
												</select>
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label> Articulo: </label>
												<select name="articulo" id="articulo" class="form-control selectpicker" data-live-search="true">
												</select>
											</div>
											<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
												<label> Cantidad: </label>
												<input type="text" class="form-control" name="cantidad" id="cantidad" maxlength="10" placeholder="Cantidad" required>
											</div>

											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
												<button class="btn btn-success" onclick="guardarArticulo(); return false" id="btnAgregar"><i class="fa fa-plus-square"></i> . Agregar </button>
											</div>

											<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<table id="tbllistado" class="display" style="width:100%">
													<thead>
											            <tr>
											            	<th></th>
											                <th>Codigo</th>
											                <th>Marca</th>
											                <th>Descripción</th>
											                <th>Cant</th>
											                <th>Precio</th>
											                <th>Importe</th>
											            </tr>
											        </thead>
												</table>
											</div>
										</div>
									</form>
								</div>

								<div class="panel-body" style="height: auto;" id="divCupon">
									<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
										<input type="text" class="form-control" name="cupon" id="cupon" maxlength="10" placeholder="Cupon">
									</div>
									<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
										<button class="btn btn-info" onclick="aplicarCupon()"> Aplicar </button>
									</div>
								</div>

								<!-- TOTALES -->
								<div id="divTotales">
									<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<h1 class="text-info" style="font-size:14px;"><b>Importe:</b> <small class="text-danger" style="font-size:15px;" id='importeInfo'></small></h1>
										<h1 class="text-info" style="font-size:14px;"><b>IVA:</b> <small class="text-danger" style="font-size:15px;" id='ivaInfo'></small></h1>
										<h1 class="text-info" style="font-size:14px;"><b>Desc:</b> <small class="text-danger" style="font-size:15px;" id='descInfo'></small></h1>
										<h1 class="text-info" style="font-size:14px;"><b>Total:</b> <small class="text-danger" style="font-size:15px;" id='totalInfo'></small></h1>
									</div>
								</div>

								<div class="panel-body" id="divBotones1">
									<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<button class="btn btn-primary" onclick="redirigirListadoVentas()"><i class="fa fa-arrow-left"></i> Regresar </button>
										<button class="btn btn-success" onclick="siguiente()">Siguiente <i class="fa fa-arrow-right"></i></button>
									</div>
								</div>

								<div class="panel-body" id="divBotones2">
									<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<button class="btn btn-primary" onclick="regresar()"><i class="fa fa-arrow-left"></i> Regresar </button>
										<button class="btn btn-success" onclick="finalizar()"> Finalizar <i class="fa fa-arrow-right"></i></button>
									</div>
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

<script type="text/javascript" src="scripts/registrarVentasJS.js"></script>

<?php
} 
ob_end_flush();
?>