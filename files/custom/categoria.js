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

    $('.btnEditar').on('click',function () {
        $("#msgErrorCard").hide();
        $('#modalTitulo').html('Editar categoria');

        var dataId = $(this).data("id");
        
        $.ajax({
            type:"POST",
            url: $("#urlGrupoGet").val()+"/"+dataId,
            success:function (data) {
                console.log("get_data_1", data);
                var result = data.data[0];

                console.log("get_data", result);
                $('#idGrupo').val(result.categoria_id);
                $('#nombreGrupo').val(result.categoria_nombre);
                //$('#state').prop('checked', false).click();
                setSwitchery(switchery, result.categoria_estado_id == 2);

                $('#modalNuevoEditar').modal({
                    show: true
                })
            }
        }); 

        
    });

    $('.btnNuevo').on('click',function () {
        $("#msgErrorCard").hide();
        $('#modalTitulo').html('Nueva categoria');
        $('#idGrupo').val(0);
        $('#nombreGrupo').val('');
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
            text: "Eliminará el grupo con nombre " + dataNombre,
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
                url: $("#urlGrupoDel").val()+"/"+dataId,
                success:function (data) {
                    console.log("get_data_1", data);
                    location.reload();
                }
            });
            
        });

        
    });


    var table = $('#dom-jqry-grupo').dataTable({
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

        var dataString = $("#frmGrupo").serialize();
		console.log('dataString', dataString);
        $.ajax({
            type:"POST",
            url: $("#urlGrupoForm").val(),
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
