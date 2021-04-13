<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="row">
	<div class="col-sm-12">
		<!-- DOM/Jquery table start -->
		<div class="card">
			<div class="card-header">
				<h5>Lista de personas</h5>
			</div>
			<div class="card-block">

                <div class="row">
                    <div class="col-sm-12">
                        <button class="btn waves-effect waves-light btn-primary btn-outline-primary btnNuevo"><i class="icofont icofont-ui-add"></i>Nueva persona</button>
                        <button class="btn waves-effect waves-light btn-inverse btn-outline-inverse btnImportar"><i class="icofont icofont-people"></i>Importar personas</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive dt-responsive">
                            <table id="dom-jqry-persona" class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
										<th>Nombres</th>
										<th>Email</th>
										<th>Grupo</th>
										<th>Estado</th>
										<th>Fecha de Creación</th>
										<th>Fecha de Modificación</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $d) { ?>
                                    <tr>
										<td><?php echo $d->persona_nombre_completo; ?></td>
										<td><?php echo $d->persona_email; ?></td>
										<td><?php echo $d->grupo_nombre; ?></td>
										<td><?php echo $d->persona_estado_str; ?></td>
										<td><?php echo $d->persona_fecha_creacion; ?></td>
										<td><?php echo $d->persona_fecha_modificacion; ?></td>
                                        <td>
											<div class="icon-btn">
												<!--<button class="btn waves-effect waves-dark btn-success btn-outline-success btn-icon btnVer" data-id="<?php echo $d->persona_id; ?>"><i class="icofont icofont-eye-alt"></i></button>-->
												<button class="btn waves-effect waves-dark btn-primary btn-outline-primary btn-icon btnEditar" data-id="<?php echo $d->persona_id; ?>"><i class="icofont icofont-ui-edit"></i></button>
												<button class="btn waves-effect waves-dark btn-danger btn-outline-danger btn-icon btnEliminar" data-nombre="<?php echo $d->persona_nombre_completo; ?>" data-id="<?php echo $d->persona_id; ?>"><i class="icofont icofont-ui-delete"></i></button>
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
</div>

<!--Nuevo / Editar-->
<div class="modal fade" id="modalNuevoEditar">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modalTitulo">Modal</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="container"></div>
			<div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" id="urlPersonaForm" value="<?=site_url('persona/persona_create')?>">
                        <input type="hidden" id="urlPersonaGet" value="<?=site_url('persona/persona_get')?>">
                        <input type="hidden" id="urlPersonaDel" value="<?=site_url('persona/persona_eliminar')?>">
                        <form id="frmPersona">
                            <input type="hidden" id="idPersona" name="idPersona">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nombres</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Ingresar nombres">
                                </div>
                            </div>
							<div class="form-group row">
                                <label class="col-sm-3 col-form-label">Apellido paterno</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="apellidoPaterno" id="apellidoPaterno" placeholder="Ingresar apellido paterno">
                                </div>
                            </div>
							<div class="form-group row">
                                <label class="col-sm-3 col-form-label">Apellido materno</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="apellidoMaterno" id="apellidoMaterno" placeholder="Ingresar apellido materno">
                                </div>
                            </div>
							<div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tipo de documento</label>
                                <div class="col-sm-9">
									<select class="form-control" name="tipoDocumento" id="tipoDocumento">
										<option value="">- Seleccionar -</option>
										<?php foreach ($comboDocumento as $d) { ?>
											<option value="<?php echo $d->valor; ?>"><?php echo $d->texto; ?></option>
										<?php }?>
									</select>
                                </div>
                            </div>
							<div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nro. Documento</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nroDocumento" id="nroDocumento" placeholder="Ingresar número de documento">
                                </div>
                            </div>
							<div class="form-group row">
                                <label class="col-sm-3 col-form-label">Estado civil</label>
                                <div class="col-sm-9">
									<select class="form-control" name="estadoCivil" id="estadoCivil">
										<option value="">- Seleccionar -</option>
										<?php foreach ($comboEstadoCivil as $d) { ?>
											<option value="<?php echo $d->valor; ?>"><?php echo $d->texto; ?></option>
										<?php }?>
									</select>
                                </div>
                            </div>
							<div class="form-group row">
                                <label class="col-sm-3 col-form-label">Fecha de nacimiento</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" name="fechaNacimiento" id="fechaNacimiento">
                                </div>
                            </div>
							<div class="form-group row">
                                <label class="col-sm-3 col-form-label">Lugar de nacimiento</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="lugarNacimiento" id="lugarNacimiento" placeholder="Ingresar lugar de nacimiento">
                                </div>
                            </div>
							<div class="form-group row">
                                <label class="col-sm-3 col-form-label">Género</label>
                                <div class="col-sm-9">
									<select class="form-control" name="genero" id="genero">
										<option value="">- Seleccionar -</option>
										<?php foreach ($comboGenero as $d) { ?>
											<option value="<?php echo $d->valor; ?>"><?php echo $d->texto; ?></option>
										<?php }?>
									</select>
                                </div>
                            </div>
							<div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Ingresar correo electrónico">
                                </div>
                            </div>
							<div class="form-group row">
                                <label class="col-sm-3 col-form-label">Teléfono</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Ingresar número de teléfono">
                                </div>
                            </div>
							<div class="form-group row">
                                <label class="col-sm-3 col-form-label">Celular</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="celular" id="celular" placeholder="Ingresar número de celular">
                                </div>
                            </div>
							<div class="form-group row">
                                <label class="col-sm-3 col-form-label">Grupo</label>
                                <div class="col-sm-9">
									<select class="form-control" name="grupo" id="grupo">
										<option value="">- Seleccionar -</option>
										<?php foreach ($comboGrupo as $d) { ?>
											<option value="<?php echo $d->valor; ?>"><?php echo $d->texto; ?></option>
										<?php }?>
									</select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Estado</label>
                                <div class="col-sm-9">
                                    <input type="checkbox" id="state" name="state" class="js-small" checked/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
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


<!--Nuevo / Editar-->
<div class="modal fade" id="modalImportar">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modalTituloImportar">Importar personas</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="container"></div>
			<div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="file" name="files[]" id="filer_input1" multiple="multiple">
                    </div>
                </div>
                
			</div>
			<div class="modal-footer">
				<a href="#" data-dismiss="modal" class="btn">Cerrar</a>
			</div>
		</div>
	</div>
</div>
