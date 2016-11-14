$(document).ready(function (){
    $('body #example_length ,.DTTT ').addClass('hidden');  
    $('.proveedores').select2();
    $('#tipoPersona').change(function (){
        $('input[name=prov_tipo]').val($(this).val());
        if($(this).val()=='Personal moral'){
            
            $('.tipo_1').show();
            $('.tipo_2').hide();
        }else if($(this).val()=='Personal fisica'){
            $('.tipo_2').show();
            $('.tipo_1').hide();
        }else{
            $('.tipo_1').hide();
            $('.tipo_2').hide();
        }
    })
    $('.fa-trash-o').click(function (){
        var el=$(this).attr('data-id');
        if(confirm('¿DESEA ELIMINAR ESTE REGISTRO?')){
            $.ajax({
                url: base_url+"conservacion/proveedores/delete_proveedor",
                dataType: 'json',
                type: 'POST',
                data:{'id':el},
                success: function (data) {
                    if(data['accion']=='1'){
                        $('#'+el).remove();
                    }
                },error: function (e) {
                    console.log(e)
                }
            })
        }
    })
})

