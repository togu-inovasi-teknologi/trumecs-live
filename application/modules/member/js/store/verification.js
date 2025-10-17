$(document).ready(function () {
    
    $('.card-bussiness-type').click(function (e) { 
        e.preventDefault();
        $('.card-bussiness-type').removeClass('card-active');
        $(this).addClass('card-active');
    });

    

    setItemAutocomplete($('#product'), base_url + 'getjson/getjsonallcategory');
    setItemAutocomplete($('#brand'), base_url + 'getjson/getjsonallbrand');


    // val = 1 individual
    // val = 2 company
    $('input[name="jenis_usaha"]').change(function (e) { 
        e.preventDefault();
        var value = $(this).val();

        if(value == 2){
            $('input[name="name"]').attr('placeholder', 'Masukan Nama Perusahaan Anda');
            $('input[name="name"]').labels('name').html('Nama Perusahaan');

            $('input[name="email"]').attr('placeholder', 'Masukan Email Perusahaan Anda');
            $('input[name="email"]').labels('name').html('Email Perusahaan');

            $('input[name="telephone"]').attr('placeholder', 'Masukan Nomor Telepon Perusahaan Anda');
            $('input[name="telephone"]').labels('name').html('Nomor Telepon Perusahaan');

            $('input[name="website"]').attr('placeholder', 'Masukan Alamat Website Perusahaan Anda');
            $('input[name="website"]').labels('name').html('Website Perusahaan');
        }else{
            $('input[name="name"]').attr('placeholder', 'Masukan Nama Anda');
            $('input[name="name"]').labels('name').html('Nama Anda');

            $('input[name="email"]').attr('placeholder', 'Masukan Email Anda');
            $('input[name="email"]').labels('name').html('Email');

            $('input[name="telephone"]').attr('placeholder', 'Masukan Nomor Telepon Anda');
            $('input[name="telephone"]').labels('name').html('Nomor Telepon Anda');

            $('input[name="website"]').attr('placeholder', 'Masukan Alamat Website Anda');
            $('input[name="website"]').labels('name').html('Website Anda');
        }
    });

    $('#form-verification').submit(function (e) { 
        
        var inputs = $(this).serializeArray();

        inputs.forEach(element => {
            var isRequired = $('input[name="'+element.name+'"').attr('required');
            if(element.value === "" && isRequired) {
                console.log(element);
                $('input[name="' + element.name + '"]').parent().append(
                    '<span class="text-danger validate-form">Kolom ini tidak boleh kosong!</span>'
                );
                e.preventDefault();
            }else{
                $('.validate-form').remove();
            }
        });

        
    });
});


function split( val ) {
    return val.split( /,\s*/ );
}
function extractLast( term ) {
    return split( term ).pop();
}

function setItemAutocomplete(element, url){
   

    element.autocomplete({
        source: function(request, response){
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function (data) {
                    if(data.length > 0){
                        var array = $.map(data, function (element, indexOrKey) {
                            return element.name;
                        });

                        response( $.ui.autocomplete.filter(
                            array, extractLast( request.term ) ) );
                    }
                    
                }
            });
        },
        minLength: 3,
        select: function (event, ui) {
            var terms = split( this.value );
            // remove the current input
            terms.pop();
            // add the selected item
            terms.push( ui.item.value );
            // add placeholder to get the comma-and-space at the end
            terms.push( "" );
            this.value = terms.join( ", " );

            return false;
        },
        
    }).autocomplete("instance")._renderItem = function (ul, item) {
        
        label = item.label;
        return $( "<div class='border-sm bg-white f12'>" )
            .append( "<div>" + label + "</div>" )
            .appendTo( ul );
    };
}