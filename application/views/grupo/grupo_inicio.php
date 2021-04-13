<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="row">
	<div class="col-sm-12">
		<!-- DOM/Jquery table start -->
		<div class="card">
			<div class="card-header">
				<h5>Lista de grupos</h5>
			</div>
			<div class="card-block">

                <div class="row">
                    <div class="col-sm-12">
                        <button class="btn waves-effect waves-light btn-primary btn-outline-primary btnNuevo"><i class="icofont icofont-ui-add"></i>Nuevo grupo</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive dt-responsive">
                            <table id="dom-jqry-grupo" class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th>Nombre del grupo</th>
                                        <th>Estado</th>
                                        <th>Fecha de Creación</th>
                                        <th>Fecha de Modificación</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $d) { ?>
                                    <tr>
                                        <td><?php echo $d->grupo_nombre; ?></td>
                                        <td><?php echo $d->grupo_estado_str; ?></td>
                                        <td><?php echo $d->grupo_fecha_creacion; ?></td>
                                        <td><?php echo $d->grupo_fecha_modificacion; ?></td>
                                        <td>
                                        <div class="icon-btn">
                                            <!--<button class="btn waves-effect waves-dark btn-success btn-outline-success btn-icon btnVer" data-id="<?php echo $d->grupo_id; ?>"><i class="icofont icofont-eye-alt"></i></button>-->
                                            <button class="btn waves-effect waves-dark btn-primary btn-outline-primary btn-icon btnEditar" data-id="<?php echo $d->grupo_id; ?>"><i class="icofont icofont-ui-edit"></i></button>
                                            <button class="btn waves-effect waves-dark btn-danger btn-outline-danger btn-icon btnEliminar" data-nombre="<?php echo $d->grupo_nombre; ?>" data-id="<?php echo $d->grupo_id; ?>"><i class="icofont icofont-ui-delete"></i></button>
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
                        <input type="hidden" id="urlGrupoForm" value="<?=site_url('grupo/grupo_create')?>">
                        <input type="hidden" id="urlGrupoGet" value="<?=site_url('grupo/grupo_get')?>">
                        <input type="hidden" id="urlGrupoDel" value="<?=site_url('grupo/grupo_eliminar')?>">
                        <form id="frmGrupo">
                            <input type="hidden" id="idGrupo" name="idGrupo">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nombreGrupo" id="nombreGrupo" placeholder="Ingresar nombre del grupo">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Estado</label>
                                <div class="col-sm-10">
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
