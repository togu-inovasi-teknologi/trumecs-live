$( document ).ready(function() {
    var base_url= $("body").attr("baseurl");
    var id_shipping_province=$("select[name=shipping_province]").attr("id");
    var id_shipping_city=$("select[name=shipping_city]").attr("id");
    var id_shipping_districts=$("select[name=shipping_districts]").attr("id");
    var id_shipping_village=$("select[name=shipping_village]").attr("id");
    $("select[name=shipping_province]").val(id_shipping_province);

    $.ajax({url: base_url+ "general/getwilayahrigences_json?id="+id_shipping_province,dataType: "JSON",
            success: function(json){
                $("select[name=shipping_city]").html("");
                for (i in json)
                    {	
                        var str_select="";
                        if (id_shipping_city==json[i].id) {str_select="selected"};
                        $("select[name=shipping_city]").append('<option value="'+json[i].id+'" '+str_select+'>'+json[i].name+'</option>');
                    }
                    $.ajax({url: base_url+ "general/getwilayahdistricts_json?id="+id_shipping_city,dataType: "JSON",
                            success: function(json){
                                $("select[name=shipping_districts]").html("");
                                for (i in json)
                                    {	
                                        var str_select="";
                                        if (id_shipping_districts==json[i].id) {str_select="selected"};
                                        $("select[name=shipping_districts]").append('<option value="'+json[i].id+'" '+str_select+'>'+json[i].name+'</option>');
                                    }
                                $(".resultjneservice").load(base_url+"general/getservice_trumecsdelivery?id="+id_shipping_city+"&id_kab="+$("select[name=shipping_city]").val(),function() {
                                    $(".loader").fadeOut();
                                });
                                $.ajax({url: base_url+ "general/getwilayahvillages_json?id="+id_shipping_districts,dataType: "JSON",
                                    success: function(json){
                                        $("select[name=shipping_village]").html("");
                                        for (i in json)
                                            {	
                                                var str_select="";
                                                if (id_shipping_village==json[i].id) {str_select="selected"};
                                                $("select[name=shipping_village]").append('<option value="'+json[i].id+'" '+str_select+'>'+json[i].name+'</option>');
                                            }
                                    }
                                })
                            }
                    })
            }
    })

    $(document).on("change","select[name=shipping_province]",function() {
            var id = $(this).val();
            $.ajax({url: base_url+ "general/getwilayahrigences_json?id="+id,dataType: "JSON",
                    success: function(json){
                        $("select[name=shipping_city]").html("<option>Pilih Kabupaten</option>");
                        $("select[name=shipping_districts]").html("<option>-sedang mengambil data...-</option>");
                        $("select[name=shipping_village]").html("<option>-sedang mengambil data...-</option>");

                        for (i in json)
                            {	
                                var str_select="";
                                $("select[name=shipping_city]").append('<option value="'+json[i].id+'" '+str_select+'>'+json[i].name+'</option>');
                            }
                    }
            })
    });

    $(document).on("change","select[name=shipping_city]",function() {
            var id = $(this).val();
            $.ajax({url: base_url+ "general/getwilayahdistricts_json?id="+id,dataType: "JSON",
                    success: function(json){
                        $("select[name=shipping_districts]").html("<option>Pilih Kecamatan</option>");
                        $("select[name=shipping_village]").html("<option>-sedang mengambil data...-</option>");
                        for (i in json)
                            {	
                                var str_select="";
                                $("select[name=shipping_districts]").append('<option value="'+json[i].id+'" '+str_select+'>'+json[i].name+'</option>');
                            }
                    }
            })
    });

    $(document).on("change","select[name=shipping_districts]",function() {
            var id = $(this).val();
            var id_kab= $("select[name=shipping_city]").val();
            $(".loadernewaddress").fadeIn();
            $.ajax({url: base_url+ "general/getwilayahvillages_json?id="+id,dataType: "JSON",
                    success: function(json){
                        $("select[name=shipping_village]").html("<option>Pilih Desa</option>");
                        for (i in json)
                            {	
                                var str_select="";
                                $("select[name=shipping_village]").append('<option value="'+json[i].id+'" '+str_select+'>'+json[i].name+'</option>');
                            }
                        $(".resultjneservice").load(base_url+"general/getservice_trumecsdelivery?id="+id+"&id_kab="+id_kab,function() {
                            $(".loadernewaddress").fadeOut();
                        });
                    }
            })
    });

    $(document).on('click','.btn-switch-register',function(){
        $('.login-form').hide();
        $('.register-form').show();
    });

    $(document).on('click','.btn-switch-login',function(){
        $('.login-form').show();
        $('.register-form').hide();
    });

    $(document).on('click','.btn-alamat',function(){
        $('.alamat-placeholder').html('');
        $('.alamat-nama').html($('input[name="alamat_name"]').val());
        $('.alamat-phone').html($('input[name="alamat_phone"]').val() != ''? ' - '+$('input[name="alamat_phone"]').val():'');
        $('.alamat-company').html($('input[name="alamat_company"]').val());
        $('.alamat-jalan').html($('textarea[name="shipping_address"]').val());
        $('.alamat-provinsi').html(jQuery.isNumeric($('select[name="shipping_province"]').val()) ? ', '+$('select[name="shipping_province"] option:selected').text():'');
        $('.alamat-kabupaten').html(jQuery.isNumeric($('select[name="shipping_city"]').val()) ? ', '+$('select[name="shipping_city"] option:selected').text():'');
        $('.alamat-kecamatan').html(jQuery.isNumeric($('select[name="shipping_districts"]').val()) ? ', '+$('select[name="shipping_districts"] option:selected').text():'');
        $('.alamat-kelurahan').html(jQuery.isNumeric($('select[name="shipping_village"]').val()) ? ', '+$('select[name="shipping_village"] option:selected').text():'');
        $('.alamat-kodepos').html($('input[name="shipping_kodepos"]').val());
        $('.popup_alamat').modal('hide');
    });
    
    $(document).on('click','.btn-catatan',function(){
        $('.text-catatan').html($('textarea[name="bulk_note"]').val());
        $('.popup_catatan').modal('hide');
    });

    var previewNode = document.querySelector("#template");
    previewNode.id = "";
    var previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);
    $("#uploader").dropzone({ 
        url: base_url+"bulk/upload", 
        parallelUploads: 3,
        previewTemplate: previewTemplate,
        autoQueue: true, 
        maxFiles:3,
        previewsContainer: "#previews",
        acceptedFiles:'.xls, .xlsx',
        init: function() {
            this.on("complete", file => {
                $(file).each(function(index, item){
                    response = JSON.parse(item.xhr.response)
                    $("#uploader").append('<input type="hidden" name="files[]" value="'+response.name+'" />');
                });
            })
            this.on("removedfile", file => {
                response = JSON.parse(file.xhr.response)
                filename = response.name;
                $.post(base_url+'bulk/remove',{filename:filename},function(data){
                    $('input[value="'+filename+'"]').remove();
                });
            });
        }
    });

    $(document).on('submit', '#form-login', function(data){
        $.post(base_url+'bulk/login',{
            email:$('#form-login input[name="email"]').val(),
            password:$('#form-login input[name="password"]').val()
        },function(data){
            response = JSON.parse(data)
            if(response.status == 'success') {
                $('#uploader').submit();
            }else{

            }
        });
        return false;
    });

    $(document).on('submit', '#form-signup', function(data){
        $.post(base_url+'bulk/signup',{
            email:$('#form-signup input[name="email"]').val(),
            password:$('#form-signup input[name="password"]').val(),
            phone:$('#form-signup input[name="phone"]').val(),
            name:$('#form-signup input[name="name"]').val(),
        },function(data){
            response = JSON.parse(data)
            if(response.status == 'success') {
                $('#uploader').submit();
            }else{

            }
        });
        return false;
    });


});