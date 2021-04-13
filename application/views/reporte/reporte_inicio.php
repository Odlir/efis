<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="row">
	<div class="col-sm-12">
		<!-- DOM/Jquery table start -->
		<div class="card">
			<div class="card-header">
				<h5>Reporte de encuesta</h5>
			</div>
			<div class="card-block">

                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" id="urlGrupoForm" value="<?=site_url('grupo/grupo_create')?>">
                        <form id="frmGrupo">
                            <input type="hidden" id="idGrupo" name="idGrupo">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Persona <small>opcional</small></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nombreGrupo" id="nombreGrupo" placeholder="Ingresar nombre del grupo">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Grupo</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nombreGrupo" id="nombreGrupo" placeholder="Ingresar nombre del grupo">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Encuesta</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nombreGrupo" id="nombreGrupo" placeholder="Ingresar nombre del grupo">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Fecha desde</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="nombreGrupo" id="nombreGrupo" placeholder="Ingresar nombre del grupo">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Fecha hasta</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="nombreGrupo" id="nombreGrupo" placeholder="Ingresar nombre del grupo">
                                </div>
                            </div>
                            
                        </form>

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button class="btn waves-effect waves-light btn-primary"><i class="icofont icofont-ui-search"></i>Buscar</button>
                        <button class="btn waves-effect waves-light btn-success"><i class="icofont icofont-file-text"></i>Exportar XLSX</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive dt-responsive">
                            <table id="dom-jqry-reporte" class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th>Persona</th>
                                        <th>Grupo</th>
                                        <th>Encuesta</th>
                                        <th>Estado</th>
                                        <th>Fecha de envío</th>
                                        <th>Fecha de última alerta</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $d) { ?>
                                    <tr>
                                        <td><?php echo $d->persona_nombre_completo; ?></td>
                                        <td><?php echo $d->grupo_estado_str; ?></td>
                                        <td><?php echo $d->grupo_fecha_creacion; ?></td>
                                        <td><?php echo $d->grupo_fecha_modificacion; ?></td>
                                        <td><?php echo $d->grupo_fecha_modificacion; ?></td>
                                        <td><?php echo $d->grupo_fecha_modificacion; ?></td>
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
