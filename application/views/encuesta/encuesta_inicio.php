<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="row">
	<div class="col-sm-12">
		<!-- DOM/Jquery table start -->
		<div class="card">
			<div class="card-header">
				<h5>Lista de micro hábitos</h5>
			</div>
			<div class="card-block">

                <div class="row">
                    <div class="col-sm-12">
                        <button class="btn waves-effect waves-light btn-primary btn-outline-primary btnNuevo"><i class="icofont icofont-ui-add"></i>Nuevo micro hábito</button>
						<input type="hidden" id="urlEncuestaForm" value="<?=site_url('encuesta/encuesta_create')?>">
						<input type="hidden" id="urlEncuestaGet" value="<?=site_url('encuesta/encuesta_get')?>">
						<input type="hidden" id="urlEncuestaDel" value="<?=site_url('encuesta/encuesta_eliminar')?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive dt-responsive">
                            <table id="dom-jqry-encuesta" class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
										<th>Micro hábito</th>
										<th>Tiempo de alerta (hrs)</th>
										<th>Última notificación</th>
										<th>Estado</th>
										<th>Fecha de Creación</th>
										<th>Fecha de Modificación</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $d) { ?>
                                    <tr>
										<td><?php echo $d->encuesta_nombre; ?></td>
										<td><?php echo $d->encuesta_tiempo_alerta_horas; ?></td>
										<td><?php echo $d->encuesta_fecha_notificacion; ?></td>
										<td><?php echo $d->encuesta_estado_str; ?></td>
										<td><?php echo $d->encuesta_fecha_creacion; ?></td>
										<td><?php echo $d->encuesta_fecha_modificacion; ?></td>
                                        <td>
											<div class="icon-btn">
												<button class="btn waves-effect waves-dark btn-primary btn-outline-primary btn-icon btnEditar" data-id="<?php echo $d->encuesta_id; ?>"><i class="icofont icofont-ui-edit"></i></button>
												<button class="btn waves-effect waves-dark btn-danger btn-outline-danger btn-icon btnEliminar" data-nombre="<?php echo $d->encuesta_nombre; ?>" data-id="<?php echo $d->encuesta_id; ?>"><i class="icofont icofont-ui-delete"></i></button>
											</div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

				
			</div>
		</div>
	</div>
	<!-- Form components Validation card end -->

	<!--Nuevo / Editar-->
	<div class="modal fade" id="modalNuevoEditar">
		<div class="modal-dialog modal-xlg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modalTitulo">Modal</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="container"></div>
				<div class="modal-body">
					<!-- Row start -->
					<div class="row">
						<div class="col-sm-12">
							<!-- Other card start -->
							<div class="card">
								<div class="card-header">
									<h5>Micro hábito</h5>
								</div>
								<div class="card-block">
									<div class="row">
										<div class="col-sm-12">
											<form id="frmEncuesta">
												<input type="hidden" id="idEncuesta" name="idEncuesta">
												<div class="form-group row">
													<label class="col-sm-3 col-form-label">Nombre</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" name="nombre_encuesta" id="nombre_encuesta" placeholder="Ingresar nombre del micro hábito">
													</div>
												</div>
												
												<div class="form-group row" style="display:none;">
													<label class="col-sm-3 col-form-label">Tiempo alerta (Horas)</label>
													<div class="col-sm-9">
														<input type="hidden" class="form-control" name="tiempo_alerta" id="tiempo_alerta" placeholder="Ingresar tiempo de alerta en horas">
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-sm-3 col-form-label">Estado</label>
													<div class="col-sm-9">
														<input type="checkbox" id="estadoEncuesta" name="estadoEncuesta" class="js-small" checked/>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<!-- Other card end -->
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12">
							<!-- Other card start -->
							<div class="card">
								<div class="card-header">
									<h5>Programación</h5>
								</div>
								<div class="card-block">
									<div class="row">
										<div class="col-sm-12">
											<form id="frmProgramacion">
												<input type="hidden" id="idProgramacion" name="idProgramacion">
												<div class="form-group row">
													<label class="col-sm-3 col-form-label">Fecha inicio</label>
													<div class="col-sm-9">
														<input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-sm-3 col-form-label">Fecha fin</label>
													<div class="col-sm-9">
														<input type="date" class="form-control" name="fecha_fin" id="fecha_fin" >
													</div>
												</div>

												<div class="form-group row">
													<label class="col-sm-3 col-form-label">Tipo de notificacion</label>
													<div class="col-sm-9">
														<select class="form-control" name="tipo_notifi" id="tipo_notifi">
															<option value="">- Seleccionar -</option>
															<?php foreach ($comboProgramacion as $d) { ?>
																<option value="<?php echo $d->valor; ?>"><?php echo $d->texto; ?></option>
															<?php }?>
														</select>
													</div>
												</div>

												<div class="form-group row">
													<label class="col-sm-3 col-form-label">Repetición</label>
													<div class="col-sm-9">
														<div class="form-check form-check-inline">
															<input class="form-check-input" type="checkbox" id="cLunes">
															<label class="form-check-label" for="cLunes">Lunes</label>
														</div>
														<div class="form-check form-check-inline">
															<input class="form-check-input" type="checkbox" id="cMartes">
															<label class="form-check-label" for="cMartes">Martes</label>
														</div>
														<div class="form-check form-check-inline">
															<input class="form-check-input" type="checkbox" id="cMiercoles">
															<label class="form-check-label" for="cMiercoles">Miércoles</label>
														</div>
														<div class="form-check form-check-inline">
															<input class="form-check-input" type="checkbox" id="cJueves">
															<label class="form-check-label" for="cJueves">Jueves</label>
														</div>
														<div class="form-check form-check-inline">
															<input class="form-check-input" type="checkbox" id="cViernes">
															<label class="form-check-label" for="cViernes">Viernes</label>
														</div>
														<div class="form-check form-check-inline">
															<input class="form-check-input" type="checkbox" id="cSabado">
															<label class="form-check-label" for="cSabado">Sábado</label>
														</div>
														<div class="form-check form-check-inline">
															<input class="form-check-input" type="checkbox" id="cDomingo">
															<label class="form-check-label" for="cDomingo">Domingo</label>
														</div>
													</div>
												</div>

												
											</form>
										</div>
									</div>
								</div>
							</div>
							<!-- Other card end -->
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12">
							<!-- Other card start -->
							<div class="card">
								<div class="card-header">
									<h5>Preguntas</h5>
								</div>
								<div class="card-block">
									
									<div class="row">
										<div class="col-sm-12">
											<form id="frmPregunta">
												<div class="form-group row">
													<label class="col-sm-3 col-form-label">Pregunta</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" name="nombre_pregunta" id="nombre_pregunta" placeholder="Ingresar la pregunta">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-3 col-form-label">Tipo de pregunta</label>
													<div class="col-sm-9">
														<select class="form-control" name="tipo_pregunta" id="tipo_pregunta">
															<option value="">- Seleccionar -</option>
															<?php foreach ($comboRespuesta as $d) { ?>
																<option value="<?php echo $d->valor; ?>"><?php echo $d->texto; ?></option>
															<?php }?>
														</select>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-3 col-form-label">Estado</label>
													<div class="col-sm-9">
														<input type="checkbox" id="estadoPregunta" name="estadoPregunta" class="js-small" checked/>
													</div>
												</div>
											</form>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<button class="btn waves-effect waves-light btn-primary btn-outline-primary btnAddPregunta"><i class="icofont icofont-ui-add"></i>Agregar pregunta</button>
											<button class="btn waves-effect waves-light btn-success btn-outline-success btnGuardarPregunta"><i class="icofont icofont-save"></i>Guardar</button>
											<button class="btn waves-effect waves-light btn-inverse btn-outline-inverse btnCancelarPregunta"><i class="icofont icofont-save"></i>Cancelar</button>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<div class="table-responsive dt-responsive">
												<table id="dom-jqry-pregunta" class="table table-striped table-bordered nowrap">
													<thead>
														<tr>
															<th>Id</th>
															<th>Pregunta</th>
															<th>Tipo de pregunta</th>
															<th>Estado</th>
															<th>Fecha de Creación</th>
															<th>Fecha de Modificación</th>
															<th>Acciones</th>
														</tr>
													</thead>
													<tbody>
														
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Other card end -->
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12">
							<!-- Other card start -->
							<div class="card">
								<div class="card-header">
									<h5>Grupos</h5>
								</div>
								<div class="card-block">
									<div class="row">
										<div class="col-sm-12">
											<form id="frmGrupo">
												<div class="form-group row">
													<label class="col-sm-3 col-form-label">Grupo</label>
													<div class="col-sm-9">
														<select class="form-control" name="encuesta_grupo" id="encuesta_grupo">
															<option value="">- Seleccionar -</option>
															<?php foreach ($comboGrupo as $d) { ?>
																<option value="<?php echo $d->valor; ?>"><?php echo $d->texto; ?></option>
															<?php }?>
														</select>
													</div>
												</div>
											</form>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<button class="btn waves-effect waves-light btn-primary btn-outline-primary btnAddGrupo"><i class="icofont icofont-ui-add"></i>Asignar grupo</button>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<div class="table-responsive dt-responsive">
												<table id="dom-jqry-grupo" class="table table-striped table-bordered nowrap">
													<thead>
														<tr>
															<th>Id</th>
															<th>Grupo</th>
															<th>Fecha de Asignación</th>
															<th>Acciones</th>
														</tr>
													</thead>
													<tbody>
														
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Other card end -->
						</div>
					</div>
					<!-- Row end -->
					<div class="row">
						<div class="col-sm-12">
							<div id="spinner" class="preloader3 loader-block">
								<div class="circ1 loader-default"></div>
								<div class="circ2 loader-default"></div>
								<div class="circ3 loader-default"></div>
								<div class="circ4 loader-default"></div>
							</div>
							<div id="msgErrorCard" class="card text-white card-danger">
								<div class="card-header">Error</div>
								<div class="card-body">
									<p class="card-text" id="msgCampos"></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<a href="#" data-dismiss="modal" class="btn">Cancelar</a>
					<button id="btnGuardar" class="btn btn-primary">Guardar</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!--Respuesta-->
<div class="modal fade" id="modalVer">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Respuestas</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="container"></div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">
						<form id="frmRespuesta">
							
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Respuesta</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="nombre_respuesta" id="nombre_respuesta" placeholder="Ingresar la respuesta">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Estado</label>
								<div class="col-sm-9">
									<input type="checkbox" id="estadoRespuesta" name="estadoRespuesta" class="js-small" checked/>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<button class="btn waves-effect waves-light btn-primary btn-outline-primary btnAddRespuesta"><i class="icofont icofont-ui-add"></i>Agregar Respuesta</button>
						<button class="btn waves-effect waves-light btn-success btn-outline-success btnGuardarRespuesta"><i class="icofont icofont-save"></i>Guardar</button>
						<button class="btn waves-effect waves-light btn-inverse btn-outline-inverse btnCancelarRespuesta"><i class="icofont icofont-save"></i>Cancelar</button>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="table-responsive dt-responsive">
							<table id="dom-jqry-respuesta" class="table table-striped table-bordered nowrap">
								<thead>
									<tr>
										<th>Id</th>
										<th>Respuesta</th>
										<th>Estado</th>
										<th>Fecha de Creación</th>
										<th>Fecha de Modificación</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<a href="#" data-dismiss="modal" class="btn">Cerrar</a>
			</div>
		</div>
	</div>
</div>