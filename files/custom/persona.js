$(document).on({
    ajaxStart: function() { $('#spinner').show(); },
     ajaxStop: function() {
          $('#spinner').hide(); 
          
          $('#btnGuardar').removeClass('btn-disabled disabled');

        }    
});

$(document).ready(function() {

    var elemsmall = document.querySelector('.js-small');
	var switchery = new Switchery(elemsmall, { color: '#4099ff', jackColor: '#fff', size: 'small' });

    function setSwitchery(switchElement, checkedBool) {
        if((checkedBool && !switchElement.isChecked()) || (!checkedBool && switchElement.isChecked())) {
            switchElement.setPosition(true);
            switchElement.handleOnchange(true);
        }
    }

    $('#spinner').hide();
    $("#msgErrorCard").hide();


    
    
    $('.btnImportar').on('click',function () {

        $('#spinner1').hide();
        $("#msgErrorCard1").hide();

        $('#modalImportar').modal({
            show: true
        })
    });

    $('.btnEditar').on('click',function () {
        $("#msgErrorCard").hide();
        $('#modalTitulo').html('Editar persona');

        var dataId = $(this).data("id");
        
        $.ajax({
            type:"POST",
            url: $("#urlPersonaGet").val()+"/"+dataId,
            success:function (data) {
                console.log("get_data_1", data);
                var result = data.data[0];

                console.log("get_data", result);
                $('#idPersona').val(result.persona_id);
                $('#nombres').val(result.persona_nombre);
                $('#apellidoPaterno').val(result.persona_apellido_paterno);
                $('#apellidoMaterno').val(result.persona_apellido_materno);
                $('#tipoDocumento').val(result.persona_tipo_documento_id);
                $('#nroDocumento').val(result.persona_numero_documento);
                $('#estadoCivil').val(result.persona_estado_civil_id);
                $('#fechaNacimiento').val(result.persona_fecha_nacimiento);
                $('#lugarNacimiento').val(result.persona_lugar_nacimiento);
                $('#genero').val(result.persona_genero_id);
                $('#email').val(result.persona_email);
                $('#telefono').val(result.persona_telefono);
                $('#celular').val(result.persona_celular);
                $('#grupo').val(result.grupo_id);
                
                setSwitchery(switchery, result.persona_estado_id == 2);

                $('#modalNuevoEditar').modal({
                    show: true
                })
            }
        }); 

        
    });

    $('.btnNuevo').on('click',function () {
        $("#msgErrorCard").hide();
        $('#modalTitulo').html('Nueva persona');
        $('#idPersona').val(0);
        $('#nombres').val('');
        $('#apellidoPaterno').val('');
        $('#apellidoMaterno').val('');
        $('#tipoDocumento').val('');
        $('#nroDocumento').val('');
        $('#estadoCivil').val('');
        $('#fechaNacimiento').val('');
        $('#lugarNacimiento').val('');
        $('#genero').val('');
        $('#email').val('');
        $('#telefono').val('');
        $('#celular').val('');
        $('#grupo').val('');

        setSwitchery(switchery, true);

        $('#modalNuevoEditar').modal({
            show: true
        })
    });

    $('.btnEliminar').on('click',function () {
        var dataId = $(this).data("id");
        var dataNombre = $(this).data("nombre");
        
        swal({
            title: "¿Está seguro que desea eliminar?",
            text: "Eliminará la persona con nombre " + dataNombre,
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Si, deseo eliminar",
            cancelButtonText: "No, cancelar",
            closeOnConfirm: false
        },
        function(){
            $.ajax({
                type:"POST",
                url: $("#urlPersonaDel").val()+"/"+dataId,
                success:function (data) {
                    console.log("get_data_1", data);
                    location.reload();
                }
            });
            
        });

        
    });


    var table = $('#dom-jqry-persona').dataTable({
        "bInfo" : false,
        "lengthChange": false,
        "language": {
            "search": "Buscar:"
          }
    });

    
    var btnGuardar = $('#btnGuardar');

    btnGuardar.on('click', function() {
        
        $("#msgErrorCard").hide();
        
        if (btnGuardar.hasClass('btn-disabled disabled')) {
            return false;
        } else {
            btnGuardar.addClass('btn-disabled disabled');
        }

        var dataString = $("#frmPersona").serialize();
        console.log(dataString)
        $.ajax({
            type:"POST",
            url: $("#urlPersonaForm").val(),
            data:dataString,
            success:function (data) {
                if(data == "1"){
                    $('#modalNuevoEditar').modal('toggle');
                    location.reload();
                }else{
                    $("#msgCampos").html(data);
                    $("#msgErrorCard").show();
                }
               
            }
        }); 
    });

       
  })