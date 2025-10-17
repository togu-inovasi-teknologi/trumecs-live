var itemsRfq = [];


$( document ).ready(function() {
    var base_url= $("body").attr("baseurl");
    var id_shipping_province=$("select[name=shipping_province]").attr("id");
    var id_shipping_city=$("select[name=shipping_city]").attr("id");
    var id_shipping_districts=$("select[name=shipping_districts]").attr("id");
    var id_shipping_village=$("select[name=shipping_village]").attr("id");
    $("select[name=shipping_province]").val(id_shipping_province);

    var previewNode = document.querySelector("#template");
    previewNode.id = "";
    var previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);
    $("#uploader").dropzone({ 
            url: base_url+"bulk/upload", 
            parallelUploads: 3,
            clickable: ".btn-upload",
            previewTemplate: previewTemplate,
            autoQueue: true, 
            maxFiles: 3,
            previewsContainer: "#previews",
            acceptedFiles:'.xls, .xlsx, .png, .jpg, .jpeg,',
            init: function () {
            this.on("dragenter", function() {
                $("#uploader").addClass("drag-enter");
            });
            this.on("dragleave", function() {
                $("#uploader").removeClass("drag-enter");
            });
            this.on("complete", file => {
                $(file).each(function(index, item){
                    response = JSON.parse(item.xhr.response)
                    $("#uploader").removeClass("drag-enter");
                    $("#uploader").append('<input type="hidden" name="files[]" value="' + response.name + '" />');
                    setTimeout(function(){
                        $(item.previewElement).find('.progress').fadeOut(1000);
                    },500);
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


    $(document).on('click', '.nav-contact',function (e) { 
        
        e.preventDefault();
        $('.nav-contact').removeClass('active');
        $(this).addClass('active');
        
    });

    

    $('textarea[name="text_rfq"').keyup(function (e) { 
        var value = $(this).val();
        
        // getLastValue(value);
        // if(getLastValue(value).includes("@")){
        //     setItemAutocomplete(getLastValue(value).replace('@', ''));
        // }else{
        //     try {
        //         $('textarea[name="text_rfq"').autocomplete( "destroy" );
        //     } catch (error) {
                
        //     }
        // }
    });



    $('#show-address-list').click(function (e) { 
        e.preventDefault();
        setTimeout(datatableAddress, 2000);
    });

    $(document).on('click', '#modal-address-close',function (e) { 
        e.preventDefault();
        $('#datatable-address').DataTable().destroy();
    });

    $(document).on('click','.btn-address-datatable',function (e) { 
        e.preventDefault();
    
        var id = $(this).data('id');

        $('input[name="village_id"]').val(id);

        $.ajax({
            type: "POST",
            url: base_url + 'bulk/getAddressDetail',
            data: {
                village_id: id,
            },
            dataType: "json",
            success: function (response) {
                

                $('#location').html(`<div class="alert alert-info" role="alert">
                                <i class="fa fa-fw fa-map-marker"></i>${response.village}, ${response.district}, ${response.regencies}, ${response.province}
                            </div>`);
            }
        });
        $('#datatable-address').DataTable().destroy();
    });
    

    $(document).on('click','.delete-button', function (e) { 
        e.preventDefault();

        var id = $(this).data('id');

        $(this).closest('.item-selected-rfq').remove();

        $.each(itemsRfq, function (i, value) { 
             if(value.id == id){
                itemsRfq.splice(i, 1);
                var currentValue = $('input[name="item_keyword"]').val();
                var newValue = currentValue.replace(value.tittle, '');
                $('input[name="item_keyword"]').val(newValue);
             }
        });
        
    });



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
        $('.alamat-phone').html($('input[name="alamat_phone"]').val() != ''? ' ( '+$('input[name="alamat_phone"]').val()+' )':'');
        $('.alamat-company').html($('input[name="alamat_company"]').val());
        $('.alamat-jalan').html($('textarea[name="shipping_address"]').val());
        $('.alamat-provinsi').html(jQuery.isNumeric($('select[name="shipping_province"]').val()) ? $('select[name="shipping_province"] option:selected').text()+' ':'');
        $('.alamat-kabupaten').html(jQuery.isNumeric($('select[name="shipping_city"]').val()) ? $('select[name="shipping_city"] option:selected').text():'');
        $('.alamat-kecamatan').html(jQuery.isNumeric($('select[name="shipping_districts"]').val()) ? $('select[name="shipping_districts"] option:selected').text()+' ':'');
        $('.alamat-kelurahan').html(jQuery.isNumeric($('select[name="shipping_village"]').val()) ? ' '+$('select[name="shipping_village"] option:selected').text():'');
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
        clickable: ".btn-upload",
        previewTemplate: previewTemplate,
        autoQueue: true, 
        maxFiles:3,
        previewsContainer: "#previews",
        acceptedFiles:'.xls, .xlsx',
        init: function () {
            this.on("dragenter", function() {
            $("#uploader").addClass("drag-enter");
        });
        this.on("dragleave", function() {
            $("#uploader").removeClass("drag-enter");
        });
            this.on("complete", file => {
                $(file).each(function(index, item){
                    response = JSON.parse(item.xhr.response)
            $("#uploader").removeClass("drag-enter");
                    $("#uploader").append('<input type="hidden" name="files[]" value="' + response.name + '" />');
					setTimeout(function(){
           				$(item.previewElement).find('.progress').fadeOut(1000);
      				},500);
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
                $('#form-upload').submit();
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
                $('#form-upload').submit();
            }else{

            }
        });
        return false;
    });

    

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});

});

function existShortcut(value){
    var term = value.split('\n');
    
    if(term.length > 1){
        for (let i = 0; i < term.length; i++) {
            if (term[i].includes('@')) { 
                return term[i]; 
                break;
            }
        }
    }else if(term.length == 1){
        var term = value.split(' ');
        for (let i = 0; i < term.length; i++) {
            if (term[i].includes('@')) { 
                return term[i]; 
                break;
            }
        }
    }

    

    return null;
}

function extractValue(value, newValue){
    var term = value.split(' ');
    
    for (let i = 0; i < term.length; i++) {
        if (term[i].includes('@')) { 
            term[i] = `@${newValue}`; 
          
        }
    }
    
    return term;
}



function setItemAutocomplete(value){
    $('textarea[name="text_rfq"').autocomplete({
        source: function(request, response){
           
            $.ajax({
                type: "POST",
                url: base_url + '/bulk/getAutocompleteProduct/',
                data: {
                    keyword: value,
                },
                dataType: "json",
                success: function (data) {
                    if(data.length > 0){
                        response(data);
                    }
                    
                }
            });
        },
        minLength: 3,
        select: function (event, ui) {

            // itemsRfq.push(ui.item);

            // var tags = $('#items-autocomplete-selected');

            // var currentValue = `${$('textarea[name="item_keyword"]').val()} ${ui.item.tittle}`;

            // $('textarea[name="item_keyword"]').val(currentValue);
            
            // tags.append(`<li class="item-selected-rfq" data-id="${ui.item.id}"><span>${ui.item.tittle}</span><button data-id="${ui.item.id}" class="delete-button"><i class="fa fw fa-close"></i></button></li>`);


            // this.value = this.value.replace(existShortcut(this.value), '');
            


            
            this.value = extractValue(this.value, ui.item.tittle).join(" ");

            $('textarea[name="text_rfq"').autocomplete( "destroy" );

            return false;
        },
        
    }).autocomplete("instance")._renderItem = function (ul, item) {
        
        term = $('textarea[name="text_rfq"').val();
        var upperCaseTerm = term.toUpperCase() ;
        var re = new RegExp(term, 'gi'); 
        label = item.tittle;
        return $( "<div class='p-a-1 bg-white f12'>" )
            .append( "<div>" + label + "</div>" )
            .appendTo( ul );
    };
}


function datatableAddress(){
    $('#datatable-address').DataTable({
        
        ajax:{  
            url: base_url + '/bulk/fetchAddress',
            type:"POST",
            crossDomain: true,
            // data: dataToRequest,
        },
        'bSort': false,
        processing: true,
        serverSide: true
    });
}

function split( val ) {
    var split = val.split( /,\s*/ );
    
    return split;

}
function extractLast( term ) {
    return split( term ).pop();
}

function getLastValue(term){
    var linelength = term.split('\n');
    
    $.each(linelength, function (i, value) { 
        var lengthSplitSpace = value.split(' ');
        console.log(`line ${i} value : ${value}`);
        $.each(lengthSplitSpace, function (n, valueOfSplitSpace) { 
            console.log(`line ${i} space ${n} value : ${valueOfSplitSpace}`);
            //  console.log(valueOfSplitSpace);
        });
    });


    // if(split.length == 1 && split[0].includes('\n')){
    //     split = term.split('\n');
    // }
    // return split[split.length -1];
}

function changeElementInputToSearchAutocomplete() {
    $('#input-element-container').html('');
    $('#input-element-container').css('margin-bottom', '80px');
    $('#input-element-container').append('<textarea class="form-control border-none shadow" name="text_rfq" placeholder="ketikan nama barang" type="text"></textarea>');
    $('textarea[name="text_rfq"]').focus();
   
}