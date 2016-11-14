$(document).ready(function (){
    $('.btn-no-login').click(function (){
        $('.row-login').removeClass('hide');
        $('.row-no-login').addClass('hide');
    })
    var show_hide_pass=0;
    $('.show-hide-pass').click(function (){
        show_hide_pass=show_hide_pass+1;
        if(show_hide_pass==1){
            $('#txtpassword').attr('type','text');
            $(this).removeClass('fa-eye').addClass('fa-eye-slash');
        }else{
            $('#txtpassword').attr('type','password');
            $(this).addClass('fa-eye').removeClass('fa-eye-slash');
            show_hide_pass=0;
        }
    })
    $('.tip').tooltip()
    $('.login-form').submit(function (e){
        var el=$(this);
        e.preventDefault();
        $.ajax({
            url: base_url+"login/login_user",
            dataType: 'json',
            type: 'POST',
            data:{
                'csrf_token':   $.cookie('csrf_cookie'),
                'username':$('input[name=username]').val(),
                'password':$('input[name=password]').val()
            }
            ,beforeSend: function (xhr) {
                el.find('button[type=submit]').html('<i class="fa fa-spinner fa-spin"></i> Espere por favor...').attr('disabled',true);
                el.find('input[type=text]').attr('readonly',true);
                el.find('input[type=password]').attr('readonly',true)
            },success:function (data){
                console.log(data)
                if(data['accion']==1){
                   location.href=base_url+'inicio';
                    //location.replace('principal');
                }else{
                    el.find('button[type=submit]').html('Acceder').removeAttr('disabled');
                    el.find('input[type=text]').removeAttr('readonly');
                    el.find('input[type=password]').removeAttr('readonly')
                    $('.row-login').addClass('hide');
                    $('.row-no-login').removeClass('hide');
                }
            },error: function (e) {
                console.log(e)
            }
        })
    })
})

